<?php
declare(strict_types=1);

namespace App\Service\WeatherService\Helpers;

use App\Service\WeatherService\ModelObject\ForecastObject;

class ForecastObjectFactory
{
    public function build(array $apiData): ForecastObject
    {
        return $this->createObjectFromApiData($apiData);
    }

    private function createObjectFromApiData(array $apiData): ForecastObject
    {
        $currentDate = new \DateTimeImmutable();

        $forecastDate = $currentDate->format('Y-m-d');
        $forecastLocation = $apiData['name'];
        $forecastPressure = $apiData['main']['pressure'];
        $forecastHumidity = $apiData['main']['humidity'];
        $forecastWindSpeed = round($apiData['wind']['speed'], 1);
        $forecastTemperature = round($apiData['main']['temp'], 1);
        $forecastWeatherDescription = $apiData['weather'][0]['main'];
        $forecastCountryCode = $apiData['sys']['country'];

        return new ForecastObject(
            $forecastDate,
            $forecastLocation,
            $forecastWeatherDescription,
            $forecastCountryCode,
            $forecastPressure,
            $forecastHumidity,
            $forecastWindSpeed,
            $forecastTemperature
        );
    }
}
