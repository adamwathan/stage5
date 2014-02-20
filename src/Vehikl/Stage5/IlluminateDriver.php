<?php namespace Vehikl\Stage5;

use Illuminate\Foundation\Testing\Client;
use Behat\Mink\Driver\BrowserKitDriver;

class IlluminateDriver extends BrowserKitDriver
{
    /**
     * Initializes Goutte driver.
     *
     * @param Client $client HttpKernel client instance
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
    }
}