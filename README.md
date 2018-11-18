# list-rest-api

## Backend recruitment task for Chiliz

### Tech Stack for list-rest-api
- PHP 7
- Symfony 4 (https://symfony.com/)
- MariaDb
- Docker

### Purpose of the task
This micro-service is producing a simple API endpoint at
`
http://localhost:8005/api/v1/partners
`
 
1. The candidate needs to create a consumer micro-service (instructions for this service can be found here : https://github.com/chiliz/consumer-service-2) that consumes this list-rest-api endpoint and stores the partners of the endpoint in a database.
The endpoint to consume is 
`
http://localhost:8005/api/v1/partners?status=active
`
and we need to store all the partners with active surveys. The expected correct result is to store the partners with name 
```
partner_name_3,
partner_name_4,
partner_name_5
```

2. We are aware that the `list-rest-api` micro-service has bugs. We are expecting the candidate to solve them without changing the business logic 
3. We are aware that the `list-rest-api` does not follow the REST principles and we are expecting the candidate to refactor the code.
4. Some unit or functional tests should be written.

### Build
In order to build this micro-service you need to have docker installed and a command line to run the below commands. 
```
# build and start docker containers
docker-compose up --build -d

# install dependencies
./bin/composer install

# run the migrations
./bin/sf d:m:m

# load the fixtures
./bin/sf doctrine:fixtures:load -n

```

### Commit your code
- Extract your code to your local machine.
- Append your code/changes.
- Send back a zipped file with your changes.

## Questions
In case you have any questions about the task do not hesitate to contact us and ask for more information at
`christos@chiliz.com`
