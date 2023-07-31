<?php

namespace App\Http\Controllers\Google\Workspace\Admin;

use App\Http\Controllers\Controller;
use Google\Client;
use Google\Exception;
use Google\Service\Directory;
use Google\Service\Directory\User;

class GoogleUserController extends Controller
{
    public function listUsers($email = 'it@srcspatna.com')
    {
        $client = new Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject($email);
        $client->addScope('https://www.googleapis.com/auth/admin.directory.user');
        $service = new Directory($client);

        $pageToken = null;
        $optParams = [
            'customer' => 'my_customer',
        ];

        try {
            do {
                if ($pageToken) {
                    $optParams['pageToken'] = $pageToken;
                }

                $results = $service->users->listUsers($optParams);
                $pageToken = $results->getNextPageToken();
                $users = $results->getUsers();

                // return $users;
                dd($users[0]);

            } while ($pageToken);

        } catch (Exception $e) {
            abort(403, 'Something went wrong!');
        }

        // return view('google.workspace.classroom.listCourses')->with(['status' => 'info', 'message' => 'Message', 'courses' => $courses]);
    }

    public function suspended($userId, $email = 'it@srcspatna.com')
    {
        $email = 'it@srcspatna.com';
        $scape = 'https://www.googleapis.com/auth/admin.directory.user';

        $client = self::googleConnection($email, $scape);
        $service = new User($client);

        $results = $service->updateUser();
        $pageToken = $results->getNextPageToken();
        $users = $results->getUsers();

        return $users;
    }

    public function active($userId, $email = 'it@srcspatna.com')
    {

    }

    // Google Connection
    protected function googleConnection($email, $scape)
    {
        $client = new Client();
        $client->useApplicationDefaultCredentials();
        $client->setSubject($email);
        $client->addScope($scape);

        return $client;
    }
}
