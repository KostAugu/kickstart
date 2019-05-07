<?php


namespace App\Age;


use Symfony\Component\Console\Style\SymfonyStyle;

class AgeManager
{
    /**
     * @var AgeCalculator
     */
    private $ageCalculator;

    /**
     * @var AdultIdentifier
     */
    private $adultIdentifier;

    /**
     * @var int
     */
    private $age;

    /**
     * AgeManager constructor.
     * @param AgeCalculator $ageCalculator
     * @param AdultIdentifier $adultIdentifier
     */
    public function __construct(AgeCalculator $ageCalculator, AdultIdentifier $adultIdentifier)
    {
        $this->adultIdentifier = $adultIdentifier;
        $this->ageCalculator = $ageCalculator;
    }

    /**
     * @param \DateTime $birthDay
     * @param SymfonyStyle $io
     */
    public function printAge(\DateTime $birthDay, SymfonyStyle $io)
    {
        $this->age = $this->ageCalculator->getAge($birthDay);
        $io->note(sprintf("I am %s years old", $this->age));
    }

    /**
     * @param SymfonyStyle $io
     */
    public function identifyAdult(SymfonyStyle $io)
    {
        if ($this->adultIdentifier->identify($this->age)) {
            $io->success("Am I an adult ?   ----   YES !!!");
        } else {
            $io->warning("Am I an adult ?   ----   NO !!!");
        }
    }
}