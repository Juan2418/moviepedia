<?php


namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class ShowCommand extends Command
{
    public function configure()
    {
        $this->setName('sayHelloTo')
            ->setDescription('Offer a greeting')
            ->addArgument(
                'name',
                InputArgument::REQUIRED,
                'Your Name.')
            ->addOption(
                'greeting',
                null,
                InputOption::VALUE_OPTIONAL,
                'Override the default greeting',
                'Hello');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument('name');
        $greeting = $input->getOption('greeting');
        $message = sprintf('%s, %s', $greeting, $name);

        $output->writeln($message);
        return 0;
    }
}