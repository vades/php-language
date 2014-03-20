Language switch PHP class
============

This class detects the language (from url, session, cookie and browser) and then sets a current one

Usage

1. Download a Language Switch from the git repository
--

2. Include LanguageSwitch.php and config.php into your code
--
(autoload or require_once)

`require_once '../src/Vades/Language/LanguageSwitch.php';`

`$cfg = require_once '../src/Vades/Language/config.php';';`

`use \Vades\Language\LanguageSwitch;`

3. Set values in config file config.php
--

Default language: `'default' => 'en'`

Supported languages: `'supported' => array('en','de','fr','es','it')`

4. Initialize the LanguageSwitch
--
        <?php
        
                $switch = new LanguageSwitch(array(
                    'default' => $cfg['default'],
                    'supported' => $cfg['supported'],
                    'url' => $lang_from_url ,
                    'session' => $lang_from_session,
                    'cookie' => $lang_from_ucookie,
                    'browser' => substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)
                ));

         ?>

5. Use it with method chaining
--

        <?php
        
                $lang = $switch->fromUrl()
                    ->fromSession()
                    ->fromCookie()
                    ->fromBrowser()
                    ->get();

         ?>


6. Code snippet
--

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

         ?>

