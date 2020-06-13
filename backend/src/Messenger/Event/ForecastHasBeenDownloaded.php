<?php
declare(strict_types=1);

namespace App\Messenger\Event;

use App\Service\WeatherService\ModelObject\ForecastObject;

class ForecastHasBeenDownloaded
{
    private ForecastObject $forecastObject;

    public function __construct(
        ForecastObject $forecastObject
    )
    {
        $this->forecastObject = $forecastObject;
    }

    public function getForecastObject(): ForecastObject
    {
        return $this->forecastObject;
    }
}
