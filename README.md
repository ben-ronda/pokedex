# _Pokedex_

#### _A Regional Pokedex for the Kanto region of the Pokemon Franchise, 03/11/2016_

#### By _**Ben Ronda, Connor Belvin, Bri Popson, Afton Downey**_

## Description

_This is a user based site for adding pokemon from the Kanto region you have caught in the games to a user profile. The pokedex also lets you search pokemon types and see there strengths and weaknesses._

## Setup/Installation Requirements

* _Fork or clone from GitHub_
* _Please create a separate branch if you cloned_
* _Open the folder in a text editor like Atom to view the code_
* _In your terminal for the site to work, use the command "composer update"_
* _Open or Install MAMP and press "Run Servers"_
* _In your browser, navigate to localhost:8888/phpmyadmin (the port number can vary depending on how MySQL and Apache are configured on your computer)_
* _Under the "Import" Tab select the pokedex.sql.zip file and press "Go"(This installs the database required for the site)_
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

## Support and contact details

_If you are having difficulty using the app, or you would like to make a suggestion please contact Ben Ronda at bronda95@comcast.net. If you would like to make a contribution feel free to clone the repository and do as you wish._

## Known Bugs

_As of 3/11/2016 if a user is not logged in the profile link in the navbar will throw an error when it brings up the home page. Notice: Undefined index: id in /Users/Guest/Desktop/pokedex/app/app.php on line 110. This error is not visible in this version due to font color for styling purposes._

## Technologies Used

_This app was built in PHP, using Silex and Twig. The database was created with MySQL using PHPMyAdmin as a database manager._

### License

*MIT License*

Copyright (c) 2016 **_Ben Ronda, Connor Belvin, Bri Popson, Afton Downey_**
