# _Restaurants_

#### _Browse restaurants and add ratings and reviews. 9/21/2016_

#### By _**Jon Toler and Seth Kendall**_

## Description

_A program that can store a page for individual cuisine types with nested pages for individual restaurants which can accept ratings for said restaurants._

## Specifications

_Spec 1: The program will take single word cuisine search input and return a boolean for if that cuisine is present in the database of cuisines._
* _Input: Hamburgers_
* _Output: true_

_Spec 2: The program will take single word cuisine search request and return a listing of restaurants, and details for each restaurant, that serve that type of cuisine._
* _Input: hamburgers_
* _Output: list of hamburger restaurants_

_Spec 3: The program will take single word cuisine search request and return either a listing of restaurants, and details for each restaurant, that serve that type of cuisine or a link to a form to add this type of cuisine._
* _Input: hamburgers_
* _Output: list of hamburger restaurants or add cuisine form_

_Spec 4: The program will take multiple cuisine types separated by commas and return a listing of all restaurants for all cuisine types, or a link to a form to add cuisine type_
* _Input: Hamburgers, Italian, Mexican_
* _Output: listing of all hamburger and Mexican restaurants, Italian not found [link: Add now?]_

_Spec 5: The program will take multiple cuisine types separated by commas and return a sortable listing of all restaurants for all cuisine types, or a link to a form to add cuisine type_
* _Input: Hamburgers, Italian, Mexican_
* _Output: sortable listing of all hamburger and Mexican restaurants, Italian not found [link: Add now?]_

## Setup/Installation Requirements

_Dependencies: Silex, Twig, PHPUnit, Apache, mySQL_

* _Clone repository from github_
* _While in the project directory, run 'composer install' in the terminal._
* _Open terminal and type apachectl start._
* _Navigate in a browser to localhost:8080/phpmyadmin and log in with username: root, password: root._
* _Click Import tab at top of page._
* _Select database zip file from cloned repository._
* _In terminal, navigate to web subfolder of project directory and type in php -S localhost:8000_
* _Navigate to localhost:8000 in browser window._

## Known Bugs

_None_

## Support and contact details

_Contact me via email with any issues_

## Technologies Used

_HTML, PHP, Silex, Twig, mySQL, Apache_

### License

*This program is licensed under the MIT license.*

Copyright (c) 2016 **_Jon Toler, Seth Kendall_**
