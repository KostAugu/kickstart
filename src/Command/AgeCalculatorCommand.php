<?php

namespace App\Command;


use App\Age\AgeManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class AgeCalculatorCommand
 * @package App\Command
 */
class AgeCalculatorCommand extends Command
{
    /**
     * @var AgeManager
     */
    private $ageManager;

    /**
     * AgeCalculatorCommand constructor.
     * @param AgeManager $ageManager
     */
    public function __construct(AgeManager $ageManager)
    {
        parent::__construct();
        $this->ageManager = $ageManager;
    }

    /**
     * @var string
     */
    protected static $defaultName = 'app:age:calculator';

    protected function configure()
    {
        $this
            ->setDescription('Calculate age')
            ->addArgument('dateOfBirth', InputArgument::REQUIRED, 'Date of birth')
            ->addOption('adult', 'a', InputOption::VALUE_NONE, 'Check if adult')
            ->setHelp('This command calculates and prints age');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $dateOfBirth = new \DateTime($input->getArgument('dateOfBirth'));
        } catch (\Exception $e) {
            $io->warning("Wrong date format!");
            exit;
        }

        $this->ageManager->printAge($dateOfBirth, $io);

        if ($input->getOption('adult')) {
            $this->ageManager->identifyAdult($io);
        }
    }
}