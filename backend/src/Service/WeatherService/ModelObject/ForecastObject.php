<?php
declare(strict_types=1);

namespace App\Service\WeatherService\ModelObject;

class ForecastObject
{
    private string $date;

    private string $location;

    private string $weatherDescription;

    private string $countryCode;

    private int $pressure;

    private int $humidity;

    private float $windSpeed;

    private float $temperature;

    public function __construct(
        string $date,
        string $location,
        string $weatherDescription,
        string $countryCode,
        int $pressure,
        int $humidity,
        float $windSpeed,
        float $temperature
    )
    {
        $this->date = $date;
        $this->location = $location;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
        $this->windSpeed = $windSpeed;
        $this->temperature = $temperature;
        $this->weatherDescription = $weatherDescription;
        $this->countryCode = $countryCode;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function getWeatherDescription(): string
    {
        return $this->weatherDescription;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }
}
