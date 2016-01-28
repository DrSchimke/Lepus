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
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPConnection;

class LepusContext implements Context
{
    /** @var AMQPConnection */
    private $connection;

    /** @var AMQPChannel */
    private $channel;

    /**
     * @param string $host
     * @param int $port
     * @param string $user
     * @param string $password
     * @param string $vhost
     */
    public function init($host, $port, $user, $password, $vhost)
    {
        $this->connection = new AMQPConnection($host, $port, $user, $password, $vhost);
        $this->channel = $this->connection->channel();
    }
    /**
     * @Then there a queue :queue
     */
    public function thereAQueue($queue)
    {
        $this->channel->queue_declare($queue);
    }
}
