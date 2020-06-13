<?php
declare(strict_types=1);

namespace App\Messenger\MessageHandler;

use App\Messenger\Event\ForecastHasBeenDownloaded;
use App\Messenger\Message\GetWeatherForLocation;
use App\Service\WeatherEventStore\WeatherEventStore;
use App\Service\WeatherService\WeatherService;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class GetWeatherForLocationHandler implements MessageHandlerInterface
{
    private WeatherService $weatherService;

    private WeatherEventStore $weatherEventStore;

    private MessageBusInterface $eventBus;

    public function __construct(
        WeatherService $weatherService,
        WeatherEventStore $weatherEventStore,
        MessageBusInterface $eventBus
    )
    {
        $this->weatherService = $weatherService;
        $this->weatherEventStore = $weatherEventStore;
        $this->eventBus = $eventBus;
    }

    public function __invoke(
        GetWeatherForLocation $message
    )
    {
        $forecastObject = $this->weatherService->getForecastForLocation(
            $message->getLocation()
        );
        $this->weatherEventStore->store($forecastObject);
        $this->eventBus->dispatch(new ForecastHasBeenDownloaded($forecastObject));
    }
}
