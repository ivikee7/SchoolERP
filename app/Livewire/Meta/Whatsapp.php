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
        $api_endpoint = "https://graph.facebook.com/v18.0/194604707068893/messages";
        $api_token = "EAAUT0R9NT8MBOZCCTuE3EZBzFRW3yWMaYiKb2fKGdLAOb90RVgeZBUfGASPUuCZA23Ikq4j1M76ZAStnNZCsbxsDhsZAKDHqJTm9p1DWZAUigPTmZAZBsnHczfxbKWaA9IjDviLTnReYjswyYXZAAIziNAHWrVX6SYxn5rLuzh93IFwHeCmEu3tgWeZBiOumzok1tE9qoUJB0fAMwjiSbN3SUKIU7ZBf85HOkgMwz74UZD";
        $number = $this->whatsapp_numbers; //"+919714396349";
        $message = $this->whatsapp_message; //"https://chat.whatsapp.com/LV03KKA0vG36LYBf0FBvOa";

        $numbers = array_filter(explode(',', str_replace(array("\n", "\r", ",", ".", "|", ":", " ", ",,", "  "), ',', $number)));

        foreach ($numbers as $n) {
            $response = self::send($api_endpoint, $api_token, $n, $message);
            dd($response);
        }
        return $response;
    }

    private function send($api_endpoint, $api_token, $whatsapp_number, $whatsapp_message)
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
                "name" => "join_our_community_page",
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
