<?php
/**
 * Created by PhpStorm.
 * User: moharaja
 * Date: 10/7/2018
 * Time: 4:01 PM
 */

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Mail\TransportManager;

use Closure;
use Mail;
use Config;
use App;

class OverwriteMail
{
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
        /*
            $conf is an array containing the mail configuration,
            a described in config/mail.php. Something like:

            [
                'driver' => 'smtp',
                'host' => 'smtp.mydomain.com',
                'username' => foo',
                'password' => 'bar'
                ...
            ]
        */
        $conf = [
            'driver'    => 'smtp',
            'host'      => get_basic_setting('smtp_host'),
            'username'  => get_basic_setting('smtp_username'),
            'password'  => get_basic_setting('smtp_password'),
            'port'      => get_basic_setting('smtp_port'),
        ];


        Config::set('mail', $conf);

        $app = App::getInstance();
        $app->register('Illuminate\Mail\MailServiceProvider');

        return $next($request);
    }
}