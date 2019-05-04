<?php

namespace App\Command;


use DateTime;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AgeCalculatorCommand extends Command
{
    protected static $defaultName = 'app:age:calculator';

    protected function configure()
    {
        $this
            ->setDescription('Calculate age')
            ->addArgument('dateOfBirth', InputArgument::REQUIRED, 'Date of birth')
            ->addOption('adult', 'a', InputOption::VALUE_NONE, 'Check if adult')
            ->addOption('day', 'd', InputOption::VALUE_NONE, 'Calculate age in days')
            ->addOption('second', 's', InputOption::VALUE_NONE, 'Calculate age in seconds')
            ->setHelp('This command calculates and prints age')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $io = new SymfonyStyle($input, $output);

        try {
            $dateOfBirth = new \DateTime($input->getArgument('dateOfBirth'));
            $today = new \Datetime();
            $age = $today->diff($dateOfBirth);
        } catch (\Exception $e) {
            $io->warning("Wrong date format (e.g. 2000-11-10)");
        }

        $options = $input->getOptions();
        if ($options['day'] && $options['second']) {
            $io->warning("Use only one of these options: --day --second");
            exit;
        }

        if ($input->getOption("second")) {
            $seconds = $today->getTimestamp() -$dateOfBirth->getTimestamp();
            $io->note(sprintf("I am %s seconds old", $seconds));

        } elseif ($input->getOption("day")) {
            $io->note(sprintf("I am %s days old", $age->days));
        } else {
            $io->note(sprintf("I am %s years old", $age->y));
        }

        if ($input->getOption("adult")) {
            if ($age->y > 18) {
                $io->success("Am I an adult ?   ----   YES !!!");
            } else {
                $io->warning("Am I an adult ?   ----   NO !!!");
            }
        }
    }
}