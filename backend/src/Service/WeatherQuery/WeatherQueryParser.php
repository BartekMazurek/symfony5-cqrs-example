<?php
declare(strict_types=1);

namespace App\Service\WeatherQuery;

class WeatherQueryParser
{
    public static function parseResult(array $queryResult): array
    {
        $i = 0 ;
        $resultArray = [];
        foreach ($queryResult as $result) {
            $resultArray[$i]['date']                = $result->getDate();
            $resultArray[$i]['location']            = $result->getLocation();
            $resultArray[$i]['weatherDescription']  = $result->getWeatherDescription();
            $resultArray[$i]['countryCode']         = $result->getCountryCode();
            $resultArray[$i]['pressure']            = $result->getPressure();
            $resultArray[$i]['humidity']            = $result->getHumidity();
            $resultArray[$i]['windSpeed']           = $result->getWindSpeed();
            $resultArray[$i]['temperature']         = $result->getTemperature();
            $i++;
        }
        return $resultArray;
    }
}
