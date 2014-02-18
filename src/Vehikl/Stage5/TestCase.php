<?php

class TestCase extends \TestCase {

    protected $session;

    public function setUp()
    {
        parent::setUp();
        $driver = new \Behat\Mink\Driver\GoutteDriver();
        $this->session = new \Behat\Mink\Session($driver);
        $this->session->start();
    }

    public function testBasicExample()
    {
        $this->visit('http://robots.thoughtbot.com/rspec-integration-tests-with-capybara');
        $this->shouldSee('RSpec Integration');
    }

    protected function visit($url)
    {
        $this->session->visit($url);
    }

    protected function shouldSee($value)
    {
        $content = $this->session->getPage()->getContent();
        $this->assertContains($value, $content);
    }

}