<?php

require_once("../libs/sendgrid-php/sendgrid-php.php");

// Simple class to send email notifications.
class Mailer {

    // First little test.
    public static function sendMail() {

        $request_body = json_decode('{
          "personalizations": [
            {
            "to": [
                {
                "email": "icedaq@bluewin.ch"
                }
            ],
            "subject": "Hello World from the SendGrid PHP Library!"
            }
        ],
        "from": {
            "email": "test@example.com"
        },
        "content": [
            {
            "type": "text/plain",
            "value": "Hello, Email!"
            }
        ]
        }');

        $apiKey = getenv('SENDGRID_API_KEY');
        $sg = new \SendGrid($apiKey);

        $response = $sg->client->mail()->send()->post($request_body);
        echo $response->statusCode();
        echo $response->body();
        echo $response->headers();
    }

}
