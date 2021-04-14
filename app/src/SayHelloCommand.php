<?php


namespace Acme;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SayHelloCommand extends Command
{
    public function configure()
    {
        $this->setName('sayHelloTo')
            ->setDescription('Offer a greeting')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Your Name.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $output->writeln('hello ' . $name);
        return 0;
    }
}