<?php

namespace App\Livewire\Meta;

use App\Livewire\Alert\Notification;
use Livewire\Component;

use function PHPUnit\Framework\returnSelf;

class Whatsapp extends Component
{
    public $type;
    public $template;
    public $whatsapp_numbers = '';
    public $whatsapp_message = '';

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.meta.whatsapp');
    }

    public function whatsappMessageSend()
    {
        $api_endpoint = "https://graph.facebook.com/v18.0/190963000769830/messages";
        $api_token = "EAAUT0R9NT8MBOwZBOwwfwexagOtvUIoTMSG2SZC2e18bZBY7at8qIwkG3UR4AyllCk3vs7gzEq4WHn0LQZABLTF8ul9qRl6ebQ87qpxo9fRJDlPvS1FfyoSStLx4t6514Nh3BljceK1Vj7ZAGvkrKrVVLqcQF4x4K2obOOaZAEda7kL1BCakZAjD4UHOVZCKkeloJfXBdy1v8tWH040vMP3g0rmk5kSsAL8CFnMZD";
        $number = $this->whatsapp_numbers; //"+919714396349";
        $message = $this->whatsapp_message; //"https://chat.whatsapp.com/LV03KKA0vG36LYBf0FBvOa";
        $template_name = $this->template;

        $numbers = array_filter(explode(',', str_replace(array("\n", "\r", ",", ".", "|", ":", " ", ",,", "  "), ',', $number)));

        foreach ($numbers as $n) {
            $response = self::send($api_endpoint, $api_token, $n, $template_name, $message);
            dd($response);
        }
        return $response;
    }

    private function send($api_endpoint, $api_token, $whatsapp_number, $template_name, $whatsapp_message)
    {
        $phone_number = $whatsapp_number;
        $message_text = $whatsapp_message;

        $api_endpoint = $api_endpoint;
        $api_token = $api_token;

        $data = [
            "messaging_product" => "whatsapp",
            "to" => $phone_number,
            "type" => $this->type,
            "template" => [
                "name" => $template_name,
                "language" => [
                    "code" => "en_US"
                ]
            ],
            "text" => [
                "preview_url" => false,
                "body" => $this->whatsapp_message
            ]
        ];

        // $data = [
        //     "messaging_product" => "whatsapp",
        //     "recipient_type" => "individual",
        //     "to" => $phone_number,
        //     "type" => "text",
        //     "text" => [
        //         "preview_url" => true,
        //         "body" => $message_text
        //     ]
        // ];

        // dd($data);

        $ch = curl_init($api_endpoint);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', "Authorization: Bearer $api_token"));
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
