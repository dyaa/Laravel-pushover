<?php namespace Dyaa\Pushover;

use Illuminate\Config\Repository;

class Pushover
{
    const API_URL = 'https://api.pushover.net/1/messages.json';

    public $config;

    private $callback;
    private $sound;
    private $device;
    private $timestamp;
    private $url;
    private $urlTitle;
    private $debug;
    private $priority;
    private $retry;
    private $expire;
    private $title;
    private $msg;

    public function __construct(Repository $config)
    {
        // Fetch the config data and set up the required url´s
        $this->config = $config;
        $this->token = $this->config->get('pushover.token');
        $this->user_key = $this->config->get('pushover.user_key');
    }

    public function config($token, $user_key)
    {
        // in case you want to dynamically update the token/user key
        $this->token = $token;
        $this->user_key = $user_key;
    }

    public function push($title, $msg)
    {
        $this->title = $title;
        $this->msg = $msg;
    }

    public function url($url, $title)
    {
        $this->urlTitle = $title;
        $this->url = $url;
    }

    public function callback($callback)
    {
        $this->callback = $callback;
    }

    public function sound($sound)
    {
        $this->sound = $sound;
    }

    public function debug($debug = null)
    {
        if ($debug == null) {
            $this->debug = false;
        } else {
            $this->debug = $debug;
        }
    }

    public function device($device)
    {
        $this->device = $device;
    }

    public function timestamp($timestamp = null)
    {
        if ($timestamp == null) {
            $timestamp = time();
        }
        $this->timestamp = $timestamp;
    }

    public function priority($priority = 0, $retry = 60, $expire = 365)
    {
        $this->priority = $priority;
        $this->retry = $retry;
        $this->expire = $expire;
    }
    
    public function user($user_key)
    {
        $this->user_key = $user_key;
    }

    public function send()
    {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, self::API_URL);
        curl_setopt($c, CURLOPT_HEADER, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, array(
            'token'     => $this->token,
            'user'      => $this->user_key,
            'title'     => $this->title,
            'message'   => $this->msg,
            'device'    => $this->device,
            'timestamp' => $this->timestamp,
            'callback'  => $this->callback,
            'sound'     => $this->sound,
            'url'       => $this->url,
            'url_title' => $this->urlTitle,
            'priority'  => $this->priority,
            'retry'     => $this->retry,
            'expire'    => $this->expire
        ));

        $response = curl_exec($c);

        if ($this->debug) {
            return $response;
        } else {
            $response = json_decode($response);
            return $response->status;
        }
    }

}
