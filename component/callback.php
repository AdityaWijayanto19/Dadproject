<?php 
    require_once '../vendor/autoload.php';

    $clientId = '604996192430-ikartd622ff98pt83fsi9lf5446142ib.apps.googleusercontent.com';
    $clientSecret = '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';
    $redirectUri = 'http://localhost/DadProject/component/login.php';

    $client = new Google_Client();
    $client->setClientId($clientId);
    $client->setClientSecret($clientSecret);
    $client->setRedirectUri($redirectUri);
    $client->addScope('profile');
    $client->addScope('email');
?>