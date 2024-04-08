<?php

//googleconfig.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('433401274885-ocaprm4tcvnqtdmmrs2mrspf0n113lo9.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://tarasshevchyk.hhos.net');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
session_start();

?>