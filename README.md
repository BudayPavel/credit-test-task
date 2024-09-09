# README #

This README would normally document whatever steps are necessary to get your application up and running.

Installation using Docker
------------
This article describe installation of web application using docker.
**This installation way does not require pre-installed software (such as web-server, PHP, MySQL etc.)** - just do next steps!

1. Install [Git](https://git-scm.com/downloads)
2. Clone [repository](https://bitbucket.org/ismdigitalia/kaliti-web/)
3. Install [Docker](https://docker.com)
4. Create `.env` file and configure this file
 ```
 $ cp .env.dist .env
 ```
5. Run project
 ```
 $ make init
 ```

#####Database credentials:

Connect to local database **credit-test-postgres** is:
* hostname: localhost
* port: 54321
* username: user
* password: password
* database: db

### Check code-style and static analyze ###

make ckeck

or

composer cs-check
bin/console do:schema:validate
bin/deptrac.phar analyze bin/deeptrac.yaml
bin/deptrac.phar analyze bin/deeptrac-layers.yaml
vendor/bin/rector process src --dry-run

### Unit and functional tests ###

Run bin/console do:fixtures:load -n to load fixtures and vendor/bin/codecept run
