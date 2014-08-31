<?php
session_start();
require_once 'Instagram.php';

$config = array(
    'client_id' => '', // Your client id
    'client_secret' => '', // Your client secret
    'grant_type' => 'authorization_code',
    'redirect_uri' => 'http://sarnsuwan.com/narongdej/instacheck/callback.php', // The redirect URI you provided when signed up for the service
);