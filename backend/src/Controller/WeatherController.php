<?php
declare(strict_types=1);

namespace App\Controller;

use App\Messenger\Message\GetWeatherForLocation;
use App\Messenger\Query\GetForecastList;
use App\Service\WeatherQuery\WeatherQueryParser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WeatherController extends AbstractController
{
    private MessageBusInterface $messageBus;

    private MessageBusInterface $queryBus;

    private SerializerInterface $serializer;

    public function __construct(
        MessageBusInterface $messageBus,
        MessageBusInterface $queryBus,
        SerializerInterface $serializer
    )
    {
        $this->messageBus = $messageBus;
        $this->queryBus = $queryBus;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/weather", name="get_list")
     */
    public function getForecastList()
    {
        $envelope = $this->queryBus->dispatch(new GetForecastList());
        $handled = $envelope->last(HandledStamp::class);
        return new JsonResponse(WeatherQueryParser::parseResult($handled->getResult()));
    }

    /**
     * @Route("/weather/{location}", name="get_weather")
     */
    public function getWeatherForecast(
        string $location
    )
    {
        try {
            $this->messageBus->dispatch(
                new GetWeatherForLocation(strtolower($location))
            );
            return new Response('ok', 204);
        } catch (\Exception $exception) {
            return new Response('error', 400);
        }
    }
}
