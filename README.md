# _Pokedex_

#### _{Brief description of application}, 03/11/2016_

#### By _**Ben Ronda, Connor Belvin, Bri Popson, Afton Downey**_

## Description

_{This is a detailed description of your application. Its purpose and usage.  Give as much detail as needed to explain what the application does, and any other information you want users or other developers to have. }_

## Setup/Installation Requirements

* _Fork or clone from GitHub_
* _Please create a separate branch if you cloned_
* _Open the folder in a text editor like Atom to view the code_
* _In your terminal for the site to work, use the command "composer update"_
* _To see the page displayed on the front end, within the terminal navigate to the web folder to initialize a local server_
* _Type in the command "php -S localhost:8000" to start the server_
* _Use localhost:8000 in your web browser to view the page_

* MySQL Commands
1. create database pokedex;
2. use pokedex;
3. create table pokemon (name text, id serial primary key);
4. create table types (name text, id serial primary key);
5. create table users (name varchar, password varchar, id serial primary key)
5. create table pokemon_types (pokemon_id int, type_id int, id serial primary key);
6. create table pokemon_users (pokemon_id int, user_id int, id serial primary key);


_See Type_list file for a list of data used in database._

## Known Bugs

_{Are there issues that have not yet been resolved that you want to let users know you know?  Outline any issues that would impact use of your application.  Share any workarounds that are in place. }_

## Support and contact details

_{Let people know what to do if they run into any issues or have questions, ideas or concerns.  Encourage them to contact you or make a contribution to the code.}_

## Technologies Used

_This app was built in PHP, using Silex and Twig. The database was created with MySQL using PHPMyAdmin as a database manager._

### License

*MIT License*

Copyright (c) 2016 **_Ben Ronda, Connor Belvin, Bri Popson, Afton Downey_**
