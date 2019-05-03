<?php
namespace App\Weather;
use App\Model\Weather;
use DateTime;
use Exception;
use Symfony\Component\Cache\Simple\FilesystemCache;
class LoaderService
{
    /** @var ProviderManager */
    private $providerManager;
    /** @var FilesystemCache */
    private $cacheService;
    /**
     * LoaderService constructor.
     * @param ProviderManager $providerManager
     * @param FilesystemCache $cacheService
     */
    public function __construct(ProviderManager $providerManager, FilesystemCache $cacheService)
    {
        $this->providerManager = $providerManager;
        $this->cacheService = $cacheService;
    }
    /**
     * @param DateTime $day
     * @return Weather
     * @throws Exception
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function loadWeatherByDay(DateTime $day): Weather
    {
        $cacheKey = $this->getCacheKey($day);
        if ($this->cacheService->has($cacheKey)) {
            echo 'From cache <br>';
            $weather = $this->cacheService->get($cacheKey);
        } else {
            echo 'load from API and save to cache <br>';
            $weather = $this->providerManager->getWeatherProvider($day)->getDay($day);
            $this->cacheService->set($cacheKey, $weather);
        }
        return $weather;
    }
    /**
     * @param DateTime $day
     * @return string
     */
    private function getCacheKey(DateTime $day): string
    {
        return $day->format('Y-m-d');
    }
}