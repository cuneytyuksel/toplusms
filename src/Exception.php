<?php
/**
 * Created by PhpStorm.
 * User: cagri
 * Date: 18.4.2017
 * Time: 09:58
 */

namespace Sms\TopluSms;
/**
 * Class Exception
 * @package Topcu\TopluSms
 *
 */
class Exception extends \RuntimeException
{
    public $messages = [
        110 => "Mesaj gönderiliyor",
        111 => "Mesaj gönderildi",
        112 => "Mesaj gönderilemedi",
        113 => "Siparişin gönderimi devam ediyor",
        114 => "Siparişin gönderimi tamamlandı",
        115 => "Sipariş gönderilemedi",
        200 => "İşlem başarılı",
        400 => "İstek çözümlenemedi",
        401 => "üyelik bilgileri hatalı",
        402 => "Bakiye yetersiz",
        404 => "API istek yapılan yönteme sahip değil",
        450 => "Gönderilen başlık kullanıma uygun değil",
        451 => "Tekrar eden sipariş",
        452 => "Mesaj alıcıları hatalı",
        453 => "Sipariş boyutu aşıldı",
        454 => "Mesaj metni boş",
        455 => "Sipariş bulunamadı",
        456 => "Sipariş gönderim tarihi henüz gelmedi",
        457 => "Mesaj gönderim tarihinin formatı hatalı",
        503 => "Sunucu geçici olarak servis dışı",
    ];

    public function __construct($statusCode, $message = null, \Exception $previous = null, $code = 0)
    {
        if(is_null($message)){
            $message = isset($this->messages[$statusCode]) ? $this->messages[$statusCode] : "TopluSms Unknown Error: $statusCode";
        }
        parent::__construct($message, $code, $previous);
    }

}
