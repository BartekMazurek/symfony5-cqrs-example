<?php
declare(strict_types=1);

namespace App\Service\WeatherService;

use App\Service\WeatherService\Helpers\ForecastObjectFactory;
use App\Service\WeatherService\ModelObject\ForecastObject;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class WeatherService
{
    const GET = 'GET';

    private string $apiUrl;

    private string $apiKey;

    private string $location;

    private HttpClientInterface $httpClient;

    private ForecastObjectFactory $forecastObjectFactory;

    public function __construct(
        ParameterBagInterface $parameterBag,
        ForecastObjectFactory $forecastObjectFactory
    )
    {
        $this->apiUrl = $parameterBag->get('weather_api_url');
        $this->apiKey = $parameterBag->get('weather_api_key');
        $this->forecastObjectFactory = $forecastObjectFactory;
        $this->httpClient = HttpClient::create();
    }

    public function getForecastForLocation(
        string $location
    ): ?ForecastObject
    {
        $this->setData($location);
        $apiData = $this->getApiData();
        if (empty($apiData)) {
            return null;
        }
        return $this->forecastObjectFactory->build($apiData);
    }

    private function setData(string $location): void
    {
        $this->location = $location;
    }

    private function getApiData(): array
    {
        $response = $this->httpClient->request(
            self::GET, $this->apiUrl . '?q=' . $this->location . '&units=metric&appid=' . $this->apiKey
        );
        $statusCode = $response->getStatusCode();
        switch ($statusCode) {
            case 200:
                return json_decode($response->getContent(), true);
            default:
                return [];
        }
    }
}
