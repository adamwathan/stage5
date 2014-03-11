<?php namespace Vehikl\Stage5;

use Behat\Mink\Driver\BrowserKitDriver;

class AcceptanceTest extends \TestCase {

    protected $session;
    protected $scope;
    protected $scopeStack = array();

    public function setUp()
    {
        parent::setUp();
        $driver = new BrowserKitDriver($this->client);
        $this->session = new \Behat\Mink\Session($driver);
        $this->session->start();
    }

    protected function visit($url)
    {
        $this->session->visit($url);
    }

    protected function click($locator)
    {
        $scope = $this->getScope();
        if ($link = $scope->findLink($locator)) {
            return $link->click();
        }
        if ($button = $scope->findButton($locator)) {
            return $button->click();
        }
        throw new ElementNotFoundException("No link or button found matching '{$locator}'");
    }

    protected function clickLink($locator)
    {
        $this->getPage()->clickLink($locator);
    }

    protected function clickButton($locator)
    {
        $this->getPage()->pressButton($locator);
    }

    protected function fillIn($field, $value)
    {
        $this->getPage()->fillField($field, $value);
    }

    protected function getPage()
    {
        return $this->session->getPage();
    }

    protected function getScope()
    {
        return $this->scope ?: $this->scope = $this->getPage();
    }

    protected function shouldSee($value)
    {
        $content = $this->getScope()->getText();
        $this->assertContains($value, $content);
    }

    protected function within($locator, $callback)
    {
        $this->pushScope();
        $this->scope = $this->getScope()->find('css', $locator);
        $callback();
        $this->popScope();
    }

    protected function pushScope()
    {
        array_push($this->scopeStack, $this->scope);
    }

    protected function popScope()
    {
        $this->scope = array_pop($this->scopeStack);
    }
}
