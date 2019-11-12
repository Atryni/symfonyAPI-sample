Sample Symfony Framework API project
==============

This is a complete stack for running Symfony 4 (latest version: Flex) into Docker containers using docker-compose tool.

# Installation

First, clone this repository:

```bash
git clone git@github.com:Atryni/symfonyAPI-sample.git
```

Prepare docker-compose ports and network name by modifying default `.env` file parameters

```dotenv
### docker-compose
# Ports
DATABASE_PORT=5444:5432
NGINX_PORT=8111:80
MAILCATCHER_PORT=80

# Network
COMPOSE_PROJECT_NAME='docker_symfony'
``` 

Then, run:

```bash
make build
```

You are done, you can visit your Symfony application on the following URL: `http://localhost:$NGINX_PORT`

## Project Description

We'd like you to build simple REST API for us - a basic movie database interacting with external API. Here's full specification of endpoints that we'd like it to have

#### POST /api/movies

Request body should contain only movie title, and its presence should be validated.
Based on passed title, other movie details should be fetched from http://www.omdbapi.com/ (or other similar, public movie database) - and saved to application database.
Request response should include full movie object, along with all data fetched from external API

#### GET /api/movies

​Should fetch list of all movies already present in application database.
Additional filtering, sorting is fully optional - but some implementation is a bonus

#### POST /api/comments

​Request body should contain ID of movie already present in database, and comment text body.
Comment should be saved to application database and returned in request response

#### GET /api/comments

​Should fetch list of all comments present in application database.
Should allow filtering comments by associated movie, by passing its ID

#### GET /api/movies/top

​Should return top movies already present in the database ranking based on a number of comments added to the movie (as in the example) in the specified date range. The response should include the ID of the movie, position in rank and total number of comments (in the specified date range).
Movies with the same number of comments should have the same position in the ranking.
Should require specifying a date range for which statistics should be generated

#### Example response

```json
[
    {
        "movie_id": 2,
        "total_comments": 4,
        "rank": 1
    },
    {
        "movie_id": 3,
        "total_comments": 2,
        "rank": 2
    },
    {
        "movie_id": 4,
        "total_comments": 2,
        "rank": 2
    },
    {
        "movie_id": 1,
        "total_comments": 0,
        "rank": 3
    }
]
```

#### Rules & hints

​Your goal is to implement REST API in PHP, however you're free to use any third-party libraries and database of your choice, but please share your reasoning behind choosing them.
At least basic tests of endpoints and their functionality are obligatory. Their exact scope and form is left up to you.
The application's code should be kept in a public repository so that anyone could read it, pull it and build it themselves. Remember to include README file or at least basic notes on application requirements and setup - user should be able to easily and quickly get it running.
Please dockerize your application and use docker-compose or similar solution.
Written application should be hosted and publicly available online