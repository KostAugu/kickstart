<?php
namespace App\ExternalApi;
use App\Model\Weather;
interface WeatherApiInterface
{
    /**
     * @param \DateTime $day
     * @return Weather
     * @throws \Exception
     */
    public function getDay(\DateTime $day): Weather;
}