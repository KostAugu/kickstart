<?php
namespace App\ExternalApi;

use App\Model\Weather;

class YahooApi extends AbstractWeatherService implements WeatherApiInterface
{
    public const PROVIDER_NAME = 'Yahoo';
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