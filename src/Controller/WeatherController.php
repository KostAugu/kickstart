<?php
namespace App\Controller;
use App\Model\NullWeather;
use App\Weather\LoaderService;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class WeatherController extends AbstractController
{
    /**
     * @param           $day
     * @param LoaderService $loaderService
     * @return Response
     */
    public function index($day, LoaderService $loaderService): Response
    {
        try {
            $weather = $loaderService->loadWeatherByDay(new DateTime($day));
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }
        return $this->render('weather/index.html.twig', [
            'weatherData'     => [
                'date'      => $weather->getDate()->format('Y-m-d'),
                'dayTemp'   => $weather->getDayTemp(),
                'nightTemp' => $weather->getNightTemp(),
                'sky'       => $weather->getSky(),
                'provider'  => $weather->getProviderName()
            ]
        ]);
    }
}