<?php

namespace App\Livewire\Meta;

use App\Livewire\Alert\Notification;
use Livewire\Component;

use function PHPUnit\Framework\returnSelf;

class Whatsapp extends Component
{
    public $whatsapp_numbers = [];
    public $whatsapp_message = '';

    public $swalData;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.meta.whatsapp');
    }

    public function whatsappMessageSend()
    {
        $params = array(
            'token' => 'EAAUT0R9NT8MBO9YJXrgV1zt0s8szNvYMifPJDcB11jAaiZCi7OZCIZBGMZBuQViGzfctKt6abL48c9eZAinby6kM46Iic6ZB3SKrgddcHQlbqLYZAihxgjKUZCBN94Wbdr0hNJmEhAm4eJtLGqEkeZCvuAm8pfC4xq93wVKCFP7TE6BSz11fXcYMjZAZCUZCENo7ZCUGnN0Hs1Aky0L7XZAq8EZCVkZD',
            "messaging_product" => "whatsapp",
            "to" => $this->whatsapp_numbers,
            'body' => $this->whatsapp_message,
        );
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://graph.facebook.com/v17.0/194604707068893/messages",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($params),
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
            Notification::alert($this, 'error', 'Error', "Error");
            return null;
        } else {
            // echo $response;
            Notification::alert($this, 'success', 'Success!', "Successful!");
            return null;
        }
    }
}
