# Projekt Web 1
[![Build Status](https://travis-ci.org/icedaq/web1.svg?branch=master)](https://travis-ci.org/icedaq/web1)

## CI/CD

[Github](https://github.com/icedaq/web1) -> [Travis CI](https://travis-ci.org/icedaq/web1) -> [Heroku](https://projweb1.herokuapp.com/)

## Local Development

Use docker-compose to run a MySQL and PHP7/Apache container.

```bash
$ docker-compose up
$ curl localhost:8080
Hello World!
```

Requires docker and docker-compose (>= 1.6).

Tests can be run locally using:
```
$ docker exec -ti web1_web_1 runTests
```

The database in the dev environment can be accessed using:
```
docker exec -ti web1_mysql_1 mysql -u root -p
```
