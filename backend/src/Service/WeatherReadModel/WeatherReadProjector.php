<?php
declare(strict_types=1);

namespace App\Service\WeatherReadModel;

use App\Document\Forecast;
use Doctrine\ODM\MongoDB\DocumentManager;
use App\Service\WeatherService\ModelObject\ForecastObject;

class WeatherReadProjector
{
    private DocumentManager $documentManager;

    public function __construct(DocumentManager $documentManager)
    {

        $this->documentManager = $documentManager;
    }

    public function makeProjection(ForecastObject $forecastObject): void
    {
        $forecastProjection = new Forecast();
        $forecastProjection->setDate($forecastObject->getDate());
        $forecastProjection->setLocation($forecastObject->getLocation());
        $forecastProjection->setWeatherDescription($forecastObject->getWeatherDescription());
        $forecastProjection->setCountryCode($forecastObject->getCountryCode());
        $forecastProjection->setPressure($forecastObject->getPressure());
        $forecastProjection->setHumidity($forecastObject->getHumidity());
        $forecastProjection->setWindSpeed($forecastObject->getWindSpeed());
        $forecastProjection->setTemperature($forecastObject->getTemperature());

        $this->documentManager->persist($forecastProjection);
        $this->documentManager->flush();
    }
}
