# Job Search

![Airline](./public/img/Airline.jpg)

## About

Airline is a flight booking website that lets you manage your bookings the way you want. Sign in to enjoy all the features the app offers.

### Characeristics

* Book and cancel flight reservations.
* A search bar to filter available flights.
* A dashboard to view all your future and past bookings.

![Homepage](public/img/homepage.png)
![Bookings](public/img/bookings.png)

## installation

### Pre-requisites

* PHP 8.0 or above
* Composer
* Relational database engine (Mysql/Sqlite)
* Node.js

### Steps

1. Clone the git repository:

```
git clone https://github.com/DinGo21/Airline.git
```

2. Enter inside the folder and install all dependencies by running the next command:

```
composer install && npm install
```

3. Copy and paste the '.env.example' file and rename it to '.env', then uncomment the lines ranging from 25 to 29.

![enviroment](public/img/env1.png)

4. Change the variable `DB_CONNECTION` to the database engine you are currently using, and also name your main database inside `DB_DATABASE`.

5. generate the encryption key to get access to the database:

```
php artisan key:generate
```

6. Migrate the database and tables:

```
php artisan migrate
```

7. Last thing is to initialize the server to begin using the website by running the line below:

```
npm run build && composer run dev
```

## Languages and Tools Used

<div align="left">
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" height="40" alt="laravel logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" height="40" alt="php logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" height="40" alt="javascript logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" height="40" alt="html5 logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" height="40" alt="css3 logo"  />
  <img width="12" />
  <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" height="40" alt="mysql logo"  />
  <img width="12" />
</div>


## Authors

* Diego Santamaria: 

<div align="left">
  <a href="www.linkedin.com/in/diegosm21" target="_blank">
    <img src="https://raw.githubusercontent.com/maurodesouza/profile-readme-generator/master/src/assets/icons/social/linkedin/default.svg" width="52" height="40" alt="linkedin logo"  />
  </a>
</div>