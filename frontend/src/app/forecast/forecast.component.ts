import { Component, OnInit } from '@angular/core';
import { WeatherService } from "../service/weather/weather.service";

@Component({
  selector: 'app-forecast',
  templateUrl: './forecast.component.html',
  styleUrls: ['./forecast.component.css']
})
export class ForecastComponent implements OnInit {

  public weatherList;

  public weatherService: WeatherService;

  constructor(weatherService: WeatherService) {
    this.weatherService = weatherService;
    this.weatherList = [];
  }

  ngOnInit(): void {
    setInterval(() => {
      this.weatherService.getList().subscribe((result) => {
        this.weatherList = result;
      })
    }, 2000);
  }
}
