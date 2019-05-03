<?php
namespace App\ExternalApi;
use App\Model\Weather;

class GoogleApi extends AbstractWeatherService implements WeatherApiInterface
{
    private const PROVIDER_NAME = 'Google';
    /**
     * @param \DateTime $day
     * @return Weather
     * @throws \Exception
     */
    public function getDay(\DateTime $day): Weather
    {
        $today = parent::getDay($day);
        $today->setProviderName(self::PROVIDER_NAME);
        return $today;
    }
}