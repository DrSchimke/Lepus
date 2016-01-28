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
    /**
     * Initializes provided context.
     *
     * @param Context $context
     */
    public function initializeContext(Context $context)
    {
        if ($context instanceof LepusContext) {
            $context->init(1, 2, 3, 4, 5);
        }
    }
}