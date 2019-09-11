<?php


namespace App\Lib\SwiftMailer;

use Illuminate\Mail\TransportManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class SwiftMailer
{
    protected $config = array();

//$configs variable is an array which keep your mail setting config.
    public function __construct()
    {
        $this->getConfigData();
    }

    public function overrideMailerConfig($configs)
    {
        try {

            Config::set('mail.driver', $configs['driver']);
            Config::set('mail.host', $configs['host']);
            Config::set('mail.port', $configs['port']);
            Config::set('mail.username', $configs['username']);
            Config::set('mail.password', $configs['password']);
            Config::set('mail.encryption', $configs['encryption']);
//        Config::set('mail.sendmail', $configs['sendmail']);

            $app = App::getInstance();

            $app->singleton('swift.transport', function ($app) {
                return new TransportManager($app);
            });

            $mailer = new \Swift_Mailer($app['swift.transport']->driver());
            Mail::setSwiftMailer($mailer);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
            // throw new \Exception('Credentials Don\' Match. Please change From Profile');
        }
    }

    public function getConfigData()
    {
        $this->config['driver'] = Config::get('mail.driver');
        $this->config['host'] = Config::get('mail.host');
        $this->config['port'] = Config::get('mail.port');
        $this->config['username'] = Config::get('mail.username');
        $this->config['password'] = Config::get('mail.password');
        $this->config['sendmail'] = Config::get('mail.sendmail');

        return $this;
    }

    public function resetConfig()
    {
        foreach ($this->config as $key => $config) {
            Config::set($key, $config);
        }
    }
}
