## Ride Hailing Service Web - Clone Uber

1. Clone the repo

```sh
   git clone https://github.com/ptduy14/ride-hailing-service-web-app.git
```

2. Compose

```sh
   composer install
```

3. Generate Key

```sh
   php artisan key:generate
```

4. Setup Database

Open the file .env
(Assuming wamp or xampp)
Edit values to match your database
Add empty database using phpmyadmin
Include that name in the DB_DATABASE

```sh
  DB_HOST=localhost
  DB_DATABASE=your_db_name
  DB_USERNAME=root
  DB_PASSWORD=
```

5. Get Tables

```sh
  php artisan migrate
```

6. Run the project

```sh
  php artisan serve
```
