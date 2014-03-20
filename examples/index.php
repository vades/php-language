<?php
require_once '../src/Vades/Language/LanguageSwitch.php';
use \Vades\Language\LanguageSwitch;

$cfg = require_once '../src/Vades/Language/config.php';

// Start session
if (strlen(session_id()) < 1) {
    session_start();
    $_SESSION['lang'] = 'de';
}
// Set cookie
setcookie('lang', 'fr', time()+60);

// Initialize the language switch
$switch = new LanguageSwitch(array(
    'default' => $cfg['default'],
    'supported' => $cfg['supported'],
    'url' => (isset($_GET['lang']) ? $_GET['lang'] : null) ,
    'session' => (isset($_SESSION['lang']) ? $_SESSION['lang'] : null),
    'cookie' => (isset($_COOKIE['lang']) ? $_COOKIE['lang'] : null),
    // Extract the two digit language code from the http headers 
   'browser' => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)
));
$lang = $switch->fromUrl()
        ->fromSession()
        ->fromCookie()
        ->fromBrowser()
        ->get();
var_dump($switch,$lang);

