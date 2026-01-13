<?php

namespace App\Jobs\Notifications;

use GuzzleHttp\Client;

class FcmHelper
{
    protected $serverKey;

    public function __construct()
    {
        // Your FCM server key
        $this->serverKey = env('FCM_SERVER_KEY');
    }

    /**
     * Send push notification via raw FCM HTTP request.
     *
     * @param string $token Device FCM token
     * @param string $title Notification title
     * @param string $body Notification body
     * @param array $data Optional data payload
     * @param string|null $image Optional image URL
     */
    public function sendNotification($token, $title, $body, $data = [], $image = null)
    {
        $client = new Client();

        $payload = [
            'to' => $token,
            'priority' => 'high', // IMPORTANT for immediate delivery
            'notification' => [
                'title' => $title,
                'body' => $body,
            ],
            'data' => $data,
        ];

        if ($image) {
            $payload['notification']['image'] = $image;
        }

        $response = $client->post('https://fcm.googleapis.com/fcm/send', [
            'headers' => [
                'Authorization' => 'key=' . $this->serverKey,
                'Content-Type' => 'application/json',
            ],
            'json' => $payload,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
