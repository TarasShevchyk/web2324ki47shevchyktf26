<?php

//Include Configuration File
include('googleconfig.php');

// Define an empty string variable to store the login button HTML
$login_button = '';

// This $_GET["code"] variable value is received after the user has logged in to their Google Account and is redirected back to the PHP script.
if(isset($_GET["code"]))
{
    // Attempt to exchange the received code for a valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    // Check if there was no error during the token exchange process.
    if(!isset($token['error']))
    {
        // Set the access token for future requests.
        $google_client->setAccessToken($token['access_token']);

        // Store the access token in the $_SESSION variable for future use.
        $_SESSION['access_token'] = $token['access_token'];

        // Create an instance of the Google_Service_Oauth2 class to access user profile data.
        $google_service = new Google_Service_Oauth2($google_client);

        // Get the user's profile data from Google.
        $data = $google_service->userinfo->get();

        // Store the user's first name, last name, and email in the $_SESSION variables.
        if(!empty($data['given_name']))
        {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if(!empty($data['family_name']))
        {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if(!empty($data['email']))
        {
            $_SESSION['user_email_address'] = $data['email'];
        }
    }
}

// Check if the user is not logged in using a Google account.
if(!isset($_SESSION['access_token']))
{
    // Create a URL to obtain user authorization for Google Sign-In.
    $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="sign-in-with-google.png" /></a>';
}

?>