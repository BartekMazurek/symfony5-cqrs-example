<?php
declare(strict_types=1);

namespace App\Messenger\EventHandler;

use App\Messenger\Event\ForecastHasBeenDownloaded;
use App\Service\WeatherReadModel\WeatherReadProjector;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ForecastHasBeenDownloadedHandler implements MessageHandlerInterface
{
    private WeatherReadProjector $weatherReadProjector;

    public function __construct(WeatherReadProjector $weatherReadProjector)
    {
        $this->weatherReadProjector = $weatherReadProjector;
    }

    public function __invoke(
        ForecastHasBeenDownloaded $event
    )
    {
        $this->weatherReadProjector->makeProjection($event->getForecastObject());
    }
}
