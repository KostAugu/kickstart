<?php


namespace App\Age;

/**
 * Class AdultIdentifier
 * @package App\Age
 */
class AdultIdentifier
{
    /**
     * @param int $age
     * @return bool
     */
    public function identify(int $age): bool
    {
        $isAdult = false;
        if ($age >= 18) {
            $isAdult = true;
        }
        return $isAdult;
    }
}