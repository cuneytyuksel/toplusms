<?php
/**
 * Created by PhpStorm.
 * User: cagri
 * Date: 17.4.2017
 * Time: 10:03
 */

namespace Topcu\TopluSms;

use Illuminate\Notifications\Notification;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Contracts\Logging\Log as LogContract;

class TopluSmsChannel
{

    /**+
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $sender;

    /**
     * @var bool
     */
    private $pretend;

    /**
     * @var string
     */
    private $url="https://api.iletimerkezi.com/v1/send-sms/get/";
    /**
     * @var LogContract
     */
    private $logger;

    /**
     * Create a new TopluSms channel instance.
     *
     * @param  \GuzzleHttp\Client  $http
     * @return void
     */
    public function __construct(LogContract $logger, HttpClient $http)
    {
        $this->http = $http;
        $this->logger = $logger;
    }

    /**
     * @param $username
     * @param $password
     * @param null $from
     */
    public function setConfig($config){
        $this->username = $config["username"];
        $this->password = $config["password"];
        $this->sender = $config["from"];
        $this->pretend = array_get($config, "pretend", false);
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        if(empty($this->username) || empty($this->password)){
            throw new \InvalidArgumentException("Missing Toplusms credentials");
        }

        if (! $to = $notifiable->routeNotificationFor('sms')) {
            return;
        }
        $message = $notification->toSms($notifiable);

        if (is_string($message)) {
            $message = new SmsMessage($message);
        }

        $params = [
            'query' => [
                'username' => $this->username,
                'password' => $this->password,
                'sender' => $message->sender ?: $this->sender,
                'receipents' => $to,
                'text' => trim($message->content),
            ]
        ];

        if($this->pretend){
            $this->pretend($params);
        }else{
            $response = $this->http->get($this->url, $params);

            $status_code = $response->getStatusCode();
            if(200 !== $status_code){
                throw new Exception($status_code);
            }
        }
    }
    
    public function pretend($params)
    {
        $this->logger->debug("[SMS_API_CALL]: " . $this->url . "?" . http_build_query($params));
    }
}