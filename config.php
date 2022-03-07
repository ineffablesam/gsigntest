

<?php

session_start();
##### DB Configuration #####
$servername = "localhost";
$username = "samuelphilip_samuelphilip";
$password = "zHGmN-1UJiB_";
$db = "samuelphilip_vprojectside";

##### Google App Configuration #####
$googleappid = "433884122087-o0ge9nln3lpkqrs531kk9q469amli2b3.apps.googleusercontent.com"; 
$googleappsecret = "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"; 
// $redirectURL = "http://localhost:81/LoginwithGoogle/authenticate.php"; 
$redirectURL = "https://vprojects.samuelphilip.in/authenticate.php"; 

##### Create connection #####
$conn = new mysqli($servername, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
##### Required Library #####
include_once 'src/Google/Google_Client.php';
include_once 'src/Google/contrib/Google_Oauth2Service.php';

$googleClient = new Google_Client();
$googleClient->setApplicationName('Login to Vprojects');
$googleClient->setClientId($googleappid);
$googleClient->setClientSecret($googleappsecret);
$googleClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($googleClient);

?>



