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
use Behat\Behat\Context\Initializer\ContextInitializer;

class LepusInitializer implements ContextInitializer
{
    /** @var array */
    private $config;

    /**
     * LepusInitializer constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Initializes provided context.
     *
     * @param Context $context
     */
    public function initializeContext(Context $context)
    {
        if ($context instanceof LepusContext) {
            $context->init(
                $this->config['host'],
                $this->config['port'],
                $this->config['user'],
                $this->config['password'],
                $this->config['vhost']
            );
        }
    }
}
