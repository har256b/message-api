# Mailbox API

Simple RESTful API using Laravel 5.5 

## Environment Setup

1. Clone repository on you local development machine and navigate in to cloned directory
2. Install dependencies by running following command `composer install`
3. Initialize **[Homestead](https://laravel.com/docs/5.5/homestead)** `php vendor/bin/homestead make`
4. Open `Homestead.yaml` file make any necessory changes
5. Create `.env` file (or copy from `.env.example`) and make desired changes i.e. database credentials etc.
6. Set additional property in `.env` file for pagination limit `PAGE_LIMIT=3` or any other desired number
7. Start you homestead machine `vagrant up`
8. SSH into your homestead machine and run `cd code && php artisan migrate && php artisan db:seed`
9. Yaay... API is up and running at **homestead.test** or as specified in step 4

## Usage

API is tiny and slim with only one resource (messages), following are the endpoints available

- **[GET]** `[site-url]/api/messages`
- **[GET]** `[site-url]/api/messages/archive`
- **[GET]** `[site-url]/api/messages/{id}` where id is valid message id
- **[POST]** `[site-url]/api/messages/{id}/read` where id is valid message id
- **[POST]** `[site-url]/api/messages/{id}/archive` where id is valid message id

API is protected with Basic HTTP Authentication. Users for basic auth are:

- `har256b/har256b`
