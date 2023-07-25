# Project

## Structure

- `backend`: root application directory
    - `config`: configuration application files
    - `console`: application console files
        - `job`: cron job classes directory
        - `migration`: migration classes directory
    - `controller`: application controller classes
    - `model`: application model classes
    - 'service': application service classes
    - `view`: application view classes
    - `web`: application public files (index.php)
- `docker`: Docker configuration files
    - `db`:  configuration db service
        - `data`: specific configuration directory
    - `nginx`:  configuration nginx service
        - `conf.d`: specific configuration directory
    - `php-fpm`: configuration php service

## Deployment

- `.env.example` to `.env` and configure
- `docker compose up -d` run docker containers
- `docker exec -ti projectenot-php-fpm-1 composer install` run
- `docker exec -ti projectenot-php-fpm-1 php app migrate` run to up migrations or add flag `--rollback` to down
