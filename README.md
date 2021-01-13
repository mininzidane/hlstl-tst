## Initial steps

1. Run `docker-compose up -d`
    - API is available by http://localhost:8012/
    - run `docker-compose exec php composer i`
2. There are tests for end-points. Execute by: `docker-compose exec php bin/phpunit tests`