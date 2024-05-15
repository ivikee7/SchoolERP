<?php

namespace App\Http\Controllers\Google;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleApiAuth extends Controller
{
    public function googleApi($set_subject, $add_scopes)
    {
        $client = app(\Google\Client::class);
        $client->setAuthConfig(env('GOOGLE_APPLICATION_CREDENTIALS'));
        $client->setSubject($set_subject);
        $client->addScope($add_scopes);

        return $client;
    }
}
