<?php

/**
 * This file is part of Lepus.
 *
 * (c) Sascha Schimke <sascha@schimke.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lepus;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

class LepusContext implements Context
{
    private $host;
    private $port;
    private $user;
    private $password;
    private $vhost;

    public function __construct()
    {
        var_dump(__METHOD__);
    }

    public function __destruct()
    {
        var_dump(__METHOD__);
    }

    public function init($host, $port, $user, $password, $vhost)
    {
        var_dump(__METHOD__);
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
        $this->vhost = $vhost;
    }

    /**
     * @BeforeSuite
     */
    public static function beforeSuite()
    {
        //var_dump(__METHOD__);
    }

    /**
     * @AfterSuite
     */
    public static function afterSuite()
    {
        //var_dump(__METHOD__);
    }

    /**
     * @BeforeScenario
     */
    public function beforeScenario()
    {
        //var_dump(__METHOD__);
    }

    /**
     * @AfterScenario
     */
    public function afterScenario()
    {
        //var_dump(__METHOD__);
    }

    /**
     * @BeforeFeature
     */
    public static function beforeFeature()
    {
        //var_dump(__METHOD__);
    }

    /**
     * @AfterFeature
     */
    public static function afterFeature()
    {
        //var_dump(__METHOD__);
    }

    /**
     * @BeforeStep
     */
    public function beforeStep()
    {
        //var_dump(__METHOD__);
    }

    /**
     * @AfterStep
     */
    public function afterStep()
    {
        //var_dump(__METHOD__);
    }

    /**
     * @Then /^there is a new "([^"]*)"$/
     */
    public function thereIsANew($arg1)
    {
    }
}