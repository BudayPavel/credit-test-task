<?php

declare(strict_types=1);

namespace App\Service\CommandHandler;

/**
 * @template C of CommandInterface
 */
interface CommandHandlerInterface
{
    /**
     * @psalm-param C $command
     */
    public function handle(CommandInterface $command): void;
}
