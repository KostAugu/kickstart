<?php
namespace App\Weather;

use App\ExternalApi\WeatherApiInterface;

class ProviderManager
{
    /** @var WeatherApiInterface[] */
    private $weatherProvider;
    /**
     * @param \DateTime $day
     * @return WeatherApiInterface
     */
    public function getWeatherProvider(\DateTime $day): WeatherApiInterface
    {
        $weekday = $day->format('D');
        if ($weekday === 'Sat' || $weekday === 'Sun') {
            $provider = $this->getProviderService('yahoo');
        } else {
            $provider = $this->getProviderService('google');
        }
        return $provider;
    }
    /**
     * @param $providerServiceName
     * @return WeatherApiInterface
     */
    public function getProviderService($providerServiceName): WeatherApiInterface
    {
        if (!isset($this->weatherProvider[$providerServiceName])) {
            throw new \RuntimeException('Provider with name: "' . $providerServiceName . '" does not exist');
        }
        return $this->weatherProvider[$providerServiceName];
    }
    /**
     * @param string              $providerName
     * @param WeatherApiInterface $weatherApiService
     */
    public function addWeatherProvider($providerName, WeatherApiInterface $weatherApiService): void
    {
        $this->weatherProvider[$providerName] = $weatherApiService;
    }
}