<?php


namespace Acme;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use GuzzleHttp\ClientInterface;


class ShowCommand extends Command
{
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;

        parent::__construct();
    }

    public function configure()
    {
        $this->setName('show')
            ->setDescription('Provides information about a movie')
            ->addArgument(
                'title',
                InputArgument::REQUIRED,
                'Movie title.');

        /*
            ->addOption(
                'greeting',
                null,
                InputOption::VALUE_OPTIONAL,
                'Override the default greeting',
                'Hello');
        */
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $title = $input->getArgument('title');

        $output->writeln($this->getMovieInformation($title));

        return 0;
    }

    public function getMovieInformation($movieTitle)
    {
        // http://www.omdbapi.com/?t=Saw&apikey=7b144894
        $apiKey = '7b144894';
        $apiUrlToCall = sprintf('http://www.omdbapi.com/?t=%s&apikey=%s', $movieTitle, $apiKey);
        $responseBody = $this->client
            ->get($apiUrlToCall)
            ->getBody();

        return $responseBody;//json_decode($responseBody);
    }
}