<?php

namespace blink\server;

use blink\core\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Console\Output\ConsoleOutput;

/**
 * Class CliServer
 *
 * CliServer is intended for console commands.
 *
 * @package blink\server
 * @since 0.3
 */
class CliServer extends Server
{
    public function run()
    {
        $app = $this->startApp();

        $runner = new \blink\core\console\Application([
            'name' => 'Blink Command Runner',
            'version' => Application::VERSION,
            'blink' => $app,
        ]);

        foreach ($app->consoleCommands() as $command) {
            if (is_string($command)) {
                $command = ['class' => $command];
            }
            $command['blink'] = $app;

            $runner->add(make($command));
        }

        return $runner->run(
            new ArgvInput(),
            new ConsoleOutput()
        );
    }
}
