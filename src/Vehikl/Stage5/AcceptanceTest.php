<?php namespace Vehikl\Stage5;

class AcceptanceTest extends \TestCase {

    protected $session;

    public function setUp()
    {
        parent::setUp();
        $driver = new IlluminateDriver($this->client);
        $this->session = new \Behat\Mink\Session($driver);
        $this->session->start();
    }

    protected function visit($url)
    {
        $this->session->visit($url);
    }

    protected function click($linkText)
    {
        $page = $this->session->getPage();
        $el = $page->findLink($linkText);
        $el->click();
    }

    protected function shouldSee($value)
    {
        $content = $this->session->getPage()->getContent();
        $this->assertContains($value, $content);
    }

}