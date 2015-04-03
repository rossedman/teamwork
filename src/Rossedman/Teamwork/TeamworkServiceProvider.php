<?php namespace Rossedman\Teamwork;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Support\ServiceProvider;

class TeamworkServiceProvider extends ServiceProvider {

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['rossedman.teamwork'] = $this->app->share(function($app)
        {
            $client = new \Rossedman\Teamwork\Client(new Guzzle,
                $app['config']->get('services.teamwork.key'),
                $app['config']->get('services.teamwork.url')
            );

            return new \Rossedman\Teamwork\Factory($client);
        });

        $this->app->bind('Rossedman\Teamwork\Factory', 'rossedman.teamwork');
    }

}