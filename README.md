# EAV - Slim 3 MVC Skeleton

This is a skeleton MVC project based on Entity Attribute Value pattren for Slim 3,
and includes Doctrine, Twig, Flash messages and Monolog.

Base on https://github.com/vhchung/slim3-skeleton-mvc

## Prepare

1. Create your project:

       ```
       $ git clone https://github.com/filipefernandes007/eav-slim3.git`
       $ cd eav-slim3
       $ git composer install

       ```

2. Execute `eav-slim3\sql\eav_slim3_db.sql` to create sample database (MySQL)

### Run it:

1. `$ cd eav-slim3`
2. `$ php -S localhost:8000 -t ./public`
3. Browse to http://localhost:8888

### Doctrine:

You can call doctrine CLI directly with:

`$ php vendor/doctrine/orm/bin/doctrine`

### Notice

Set `logs` and `cache` folder permission to writable when deploy to production environment

## Key directories

* `app`: Application code
* `app/src`: All class files within the `App` namespace
* `app/templates`: Twig template files
* `cache/twig`: Twig's Autocreated cache files
* `log`: Log files
* `public`: Webserver root
* `vendor`: Composer dependencies
* `sql`: sql dump file for sample database

## Key files

* `public/index.php`: Entry point to application
* `app/templates`: Twig template directory
* `app/settings.php`: Configuration
* `app/dependencies.php`: Services for Pimple
* `app/middleware.php`: Application middleware
* `app/routes.php`: All application routes are here
* `app/src/controllers`: Controller class directory
* `app/src/entities`: Entity class directory
* `app/src/repository`: Repository class directory
* `app/src/Core`: Essential code

The EAV Structure:

Application 1
	...
Application N
	Module 1
		...
	Module 2
		...
	Module N
		State 1 is related with Entity 1, and Entity 1 is defined by {'id':1, 'name':'X', 'description':'Blah!'} 
			...
		State N is related with Entity M
			Register N + 1 
				AttributeValue M
				AttributeValue M + 1
				AttributeValue M + 2
			Register N + 2
			...
			Register N + 3
			...
			Register N + N
i must rem
Entity M
	Attribute 1
		Type Int
	Attribute 2
		Type String32
	Attribute 3
		Type String32
	...
	Attribute N
		Type String256

###

Feel free to play with this EAV base, but i must remind you that is not ready for production.




