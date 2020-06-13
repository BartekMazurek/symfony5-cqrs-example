# weatherApp (Angular 9 + Symfony 5 + MySQL 5.7 + MongoDB 4.2)
WeatherApp is a simple prototype application based on Symfony 5 Messenger Component & CQRS architectural approach (You can find more information about CQRS here - https://martinfowler.com/bliki/CQRS.html). Type any location in the search bar and you'll get forecast data from OpenWeatherApi for the current day.

![S5_CQRS](http://bartekblog.prv.pl/s5_cqrs/1.png)
![S5_CQRS](http://bartekblog.prv.pl/s5_cqrs/2.png)
![S5_CQRS](http://bartekblog.prv.pl/s5_cqrs/3.png)
![S5_CQRS](http://bartekblog.prv.pl/s5_cqrs/4.png)

# Requirements
- Composer
- Symfony CLI
- PHP 7.4
- MySQL 5.7
- NPM 6.x
- Node.js 10.x
- Angular 9+
- MongoDB 4.2

# How to setup
- Download project files (frontend & backend folder).
- Install all dependencies (**composer install** in 'backend' folder & **npm install --save** in 'frontend' folder)
- In 'backend' folder edit **.env** file and set proper configuration for **MONGODB_URL & MONGODB_DB** & **DATABASE_URL** parameters
- In 'frontend' folder find **environment.ts** file (src -> environments -> environment.ts) and set proper path to 'backend' folder on your WWW server - it's necessary for the frontend and the backend to communicate with each other
- Make sure MongoDB is running (ex. run in terminal **sudo systemctl start mongod** - in Debian/Ubuntu distros)
- Create database from terminal in backend folder - **php bin/console doctrine:database:create**
- Run database migration in 'backend' folder - **php bin/console doctrine:migrations:migrate**
- Start development WWW server (**symfony serve** for 'backend' & **ng serve** for 'frontend')
- Run Messenger Component consumer class in backend folder - **php bin/console messenger:consume weather_queue -vv**
- To get weather forecast type location in searchbar and click "Get forecast" button

# How it works
- After search bar form submission, frontend will call /weather/{searchValue} route in backend app
- **GetWeatherForLocation** message will be sent into command bus - message will be processed **asynchronously** by doctrine transport (check configuration in **messenger.yaml** file)
- Message will be handled by **GetWeatherForLocationHandler**
- After downloading api data & storing it in database, a **ForecastHasBeenDownloaded** event will be thrown
- **ForecastHasBeenDownloadedHandler** is responsible for calling the service to synchronize MySQL database(write) with MongoDB storage(read) after downloading api data
- Frontend app will get stored data from MongoDB storage by calling backend **/weather** route
- **GetForecastList** message will be sent into query bus to read forecast data