<?php

namespace Vades\Language;

/**
 * Switch between detected languages and set a current one
 *
 * @version 1.0
 * @author Martin Vach
 */
class LanguageSwitch {
    /**
     * Language property
     * @var string
     */
    protected $language;
    
    /**
     * Default language
     * @var string 
     */
    protected $default;
    
    /**
     * Supported languages
     * @var type 
     */
    protected $supported = array();
    
    /**
     * Language from url
     * @var string 
     */
    protected $url;
    
    /**
     * Language from session
     * @var string 
     */
    protected $session;
    
    /**
     * Language from cookie
     * @var string 
     */
    protected $cookie;
    
    /**
     * Language from browser
     * @var string 
     */
    protected $browser;

    /**
     * Inject the config into constructor
     * 
     * @param array $config
     * @return void
     */
    public function __construct($config = array()) {
        $this->init($config);
    }

    /**
     * Init class properties
     * 
     * @param array $config
     * @return void
     */
    public function init($config) {
        foreach ($config as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Get language
     * 
     * @return string
     */
    public function get() {
        if (!$this->language) {
            $this->language = $this->getDefault();
        }
        return $this->language;
    }

    /**
     * Set language
     * 
     * @return string
     */
    public function setLanguage($language) {
        if ($this->isSupported($language)) {
            $this->language = $language;
        }
    }
    
    /**
     * Get default language
     * 
     * @return string
     */
    public function getDefault() {
        return $this->default;
    }
    /**
     * Get supported languages
     * 
     * @return array
     */
    public function getSupported() {
        return (array)$this->supported;
    }
    
    /**
     * Check if language is supported
     * 
     * @param string $language
     * @return boolean
     */
    public function isSupported($language) {
        if (!in_array($language, $this->getSupported())) {
            return false;
        }
        return true;
    }

    /**
     * Detect language from url
     * 
     * @param string $language
     * @return \Vades\Language\LanguageSwitch
     */
    public function fromUrl($language = null) {
        $language = $language ? $language : $this->url;
        $this->setLanguage($language);
        return $this;
    }

    /**
     * Detect language from session
     * 
     * @param string $language
     * @return \Vades\Language\LanguageSwitch
     */
    public function fromSession($language = null) {
        $language = $language ? $language : $this->session;
        $this->setLanguage($language);
        return $this;
    }

    /**
     * Detect language from cookie
     * 
     * @param string $language
     * @return \Vades\Language\LanguageSwitch
     */
    public function fromCookie($language = null) {
        $language = $language ? $language : $this->cookie;
        $this->setLanguage($language);
        return $this;
    }

    /**
     * Get language from browser
     * 
     * @param string $language
     * @return \Vades\Language\LanguageSwitch
     */
    public function fromBrowser($language = null) {
        $language = $language ? $language : $this->browser;
        $this->setLanguage($language);
        return $this;
    }
}
