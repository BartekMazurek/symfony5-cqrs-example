<?php
declare(strict_types=1);

namespace App\Service\WeatherEventStore;

use App\Entity\ForecastWrite;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\WeatherService\ModelObject\ForecastObject;

class WeatherEventStore
{
    private EntityManagerInterface $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->entityManager = $entityManager;
    }

    public function store(ForecastObject $forecastObject): void
    {
        $entityToPersist = $this->getEntityToPersist($forecastObject);
        $this->entityManager->persist($entityToPersist);
        $this->entityManager->flush();
    }

    private function getEntityToPersist(ForecastObject $forecastObject): ForecastWrite
    {
        $forecast = new ForecastWrite();
        $forecast->setDate(new \DateTimeImmutable($forecastObject->getDate()));
        $forecast->setLocation($forecastObject->getLocation());
        $forecast->setHumidity($forecastObject->getHumidity());
        $forecast->setPressure($forecastObject->getPressure());
        $forecast->setTemperature($forecastObject->getTemperature());
        $forecast->setWindSpeed($forecastObject->getWindSpeed());
        $forecast->setWeatherDescription($forecastObject->getWeatherDescription());
        $forecast->setCountryCode($forecastObject->getCountryCode());
        $forecast->setCreatedAt(new \DateTimeImmutable());
        return $forecast;
    }
}
