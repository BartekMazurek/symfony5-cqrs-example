<?php
declare(strict_types=1);

namespace App\Messenger\QueryHandler;

use App\Document\Forecast;
use App\Messenger\Query\GetForecastList;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class GetForecastListHandler implements MessageHandlerInterface
{
    private DocumentManager $documentManager;

    public function __construct(
        DocumentManager $documentManager
    )
    {
        $this->documentManager = $documentManager;
    }

    public function __invoke(
        GetForecastList $message
    )
    {
        $forecastRepository = $this->documentManager->getRepository(Forecast::class);
        return $forecastRepository->findAll();
    }
}
