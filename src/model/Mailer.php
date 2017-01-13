<?php
require_once("libs/sendgrid-php/sendgrid-php.php");

// Simple class to send email notifications.
class Mailer {

    public static function sendMail($clientAddress, $body) {
        $request_body = json_decode('{
          "personalizations": [
            {
            "to": [
                {
                "email": "'.$clientAddress.'"
                }
            ],
            "cc": [
                {
                "email": "icedaq@bluewin.ch"
                }
            ],
            "subject": "Your order!"
            }
        ],
        "from": {
            "email": "noreply@projweb1.herokuapp.com"
        },
        "content": [
            {
            "type": "text/plain",
            "value": "'.$body.'"
            }
        ]
        }');

        if (Mailer::getWeb1Env() == "PROD")
        {
            $apiKey = getenv('SENDGRID_API');
            $sg = new \SendGrid($apiKey);

            $response = $sg->client->mail()->send()->post($request_body);
            
            // DEBUG
            //echo $request_body."\n";
            //echo $response->statusCode();
            //echo $response->headers();
            //echo $response->body();
            return $response->statusCode();
        } else {
            // We do not send mails in dev and test.
            // Maybe print some debug output here.
        }
    }

    private static function getWeb1Env() {
        $env = getenv('WEB1_ENV');
        if ( $env != "") {
            return $env;
        } else {
            die("WEB1_ENV environment variable is not set!");
        }
    }
}
