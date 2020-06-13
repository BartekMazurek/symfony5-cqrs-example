import { Injectable } from '@angular/core';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { environment } from "../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class WeatherService {

  private httpClient: HttpClient;

  constructor(private client: HttpClient) {
    this.httpClient = client;
  }

  getList() {
    return this.httpClient.get(environment.weatherListEndpoint);
  }

  getForecastForLocation(location: string) {
    return this.httpClient.get(environment.weatherListEndpoint + '/' + location);
  }
}
