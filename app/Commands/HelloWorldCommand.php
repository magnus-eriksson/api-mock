<?php namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloWorldCommand extends Command
{
    protected function configure()
    {
        $this->setName('hello-world')
            ->setDescription('Example command')
            ->setHelp('An example command');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello world!');
    }
}
