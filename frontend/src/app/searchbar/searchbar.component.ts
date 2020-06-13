import { Component, OnInit } from '@angular/core';
import { FormBuilder } from '@angular/forms';
import {WeatherService} from "../service/weather/weather.service";

@Component({
  selector: 'app-searchbar',
  templateUrl: './searchbar.component.html',
  styleUrls: ['./searchbar.component.css']
})
export class SearchbarComponent implements OnInit {

  public error: boolean;

  public location: string;

  private service: WeatherService;

  constructor(weatherService: WeatherService) {
    this.error = false;
    this.service = weatherService;
  }

  ngOnInit(): void {
  }

  getWeatherForLocation() {
    this.service.getForecastForLocation(this.location).subscribe((result) => {
    }, error => {
      if (error) {
        this.showErrorMsg();
      }
    });
    this.unsetSearchbar();
  }

  unsetSearchbar() {
    this.location = '';
  }

  showErrorMsg() {
    this.error = true;
    setTimeout(() => {
      this.error = false;
    }, 3000)
  }
}
