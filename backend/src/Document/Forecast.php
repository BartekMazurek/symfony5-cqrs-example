<?php
declare(strict_types=1);

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Forecast
{
    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $date;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $location;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $weatherDescription;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $countryCode;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $pressure;

    /**
     * @MongoDB\Field(type="integer")
     */
    protected $humidity;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $windSpeed;

    /**
     * @MongoDB\Field(type="float")
     */
    protected $temperature;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getWeatherDescription(): string
    {
        return $this->weatherDescription;
    }

    public function setWeatherDescription(string $weatherDescription): void
    {
        $this->weatherDescription = $weatherDescription;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function setPressure(int $pressure): void
    {
        $this->pressure = $pressure;
    }

    public function getHumidity(): int
    {
        return $this->humidity;
    }

    public function setHumidity(int $humidity): void
    {
        $this->humidity = $humidity;
    }

    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    public function setWindSpeed(float $windSpeed): void
    {
        $this->windSpeed = $windSpeed;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setTemperature(float $temperature): void
    {
        $this->temperature = $temperature;
    }
}
