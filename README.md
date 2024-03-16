# Requirements 
- Docker Engine v3.^

# .env configs

- set `DB_HOST` to `mysql` 
- set `REDIS_HOST` to `redis`
- you can set `PHPMYADMIN_PORT` to specify the port , the default is `8090`



# installation

at the first you must run this command `docker compose up -d` ( if you're using older version of docker 
you must enter `docker-compose` instead of `docker compose` ) 

it installs vendor and vite dependency and then do the migration



## for testing routes you can import [api_test export](./api_test.postman_collection.json) to your postman and test it

## for authentication use `Bearer Token`
