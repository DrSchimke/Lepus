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
use Behat\Gherkin\Node\PyStringNode;
use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPConnection;
use PhpAmqpLib\Message\AMQPMessage;
use Sci\Assert\Assert;

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
     * @Given there is a queue :queue
     */
    public function thereIsAQueue($queue)
    {
        $this->channel->queue_declare($queue);
    }

    /**
     * @Given there is an exchange :exchange
     */
    public function thereIsAnExchange($exchange)
    {
        $this->channel->exchange_declare($exchange, 'direct');
    }

    /**
     * @Given the queue :queue is empty
     */
    public function theQueueIsEmpty($queue)
    {
    }

    /**
     * @When I send a message to queue :queue
     */
    public function iSendAMessageToQueue($queue, PyStringNode $string)
    {
        $message = new AMQPMessage($string->getRaw());

        $this->channel->basic_publish($message, '', $queue);
    }

    /**
     * @Then there should be a message in queue :queue
     *
     * @param              $queue
     * @param PyStringNode $string
     */
    public function thereShouldBeAMessageInQueue($queue, PyStringNode $string = null)
    {
        $expected = $string ? $string->getRaw() : null;

        if (null === $expected) {
            $this->channel->basic_consume($queue);
        } else {
            $consumer = function (AMQPMessage $message) use ($expected) {
                $this->channel->basic_ack($message->delivery_info['delivery_tag']);

                Assert::that($message->body)->equal($expected);
            };
            $this->channel->basic_consume($queue, '', false, false, false, false, $consumer);
        }
        $this->channel->wait(null, false, 4);
    }
}
