<?php


namespace App\Age;


use DateTime;

/**
 * Class AgeCalculator
 * @package App\Age
 */
class AgeCalculator
{
    /**
     * AgeCalculator constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->today = new Datetime();
    }

    /**
     * @var DateTime
     */
    private $today;

    /**
     * @param DateTime $birthDay
     * @return int
     */
    public function getAge(\DateTime $birthDay): int
    {
        $age = $this->today->diff($birthDay)->y;
        return $age;
    }
}