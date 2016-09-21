<?php
class Restaurant
{
    private $description;
    private $id;
    private $cuisine_id;
    private $location;
    private $rating;
    private $name;

    function __construct($description, $id=null, $cuisine_id, $location, $rating, $name)
    {
        $this->description = $description;
        $this->id = $id;
        $this->cuisine_id = $cuisine_id;
        $this->location = $location;
        $this->rating = $rating;
        $this->name = $name;
    }


    function setRating($new_rating)
    {
        $this->rating = $new_rating;
    }
    function getRating()
    {
        return $this->rating;
    }

    function setDescription($new_description)
    {
        $this->description = $new_description;
    }
    function getDescription()
    {
        return $this->description;
    }

    function setId($new_id)
    {
        $this->id = $new_id;
    }
    function getId()
    {
        return $this->id;
    }

    function setLocation($new_location)
    {
        $this->location = $new_location;
    }
    function getLocation()
    {
        return $this->location;
    }

    function setCuisineId($new_cuisine_id)
    {
        $this->cuisine_id = $new_cuisine_id;
    }
    function getCuisineId()
    {
        return $this->cuisine_id;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }
    function getName()
    {
        return $this->name;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO restaurant (name, cuisine_id, description, location, rating) VALUES ('{$this->getName()}', {$this->getCuisineId()}, '{$this->getDescription()}', '{$this->getLocation()}', {$this->getRating()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM restaurant;");
    }

    static function find($cuisine_id)
    {
        $found_restaurants = array();
        $restaurants = Restaurant::getAll();
        foreach($restaurants as $restaurant) {
            $restaurant_cuisine_id = $restaurant->getCuisineId();
            if ($restaurant_cuisine_id == $cuisine_id) {
              array_push($found_restaurants, $restaurant);
            }
        }
        return $found_restaurants;
    }

    static function getAll()
    {
      $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant;");
      $restaurants = array();
      foreach($returned_restaurants as $restaurant) {
          $description = $restaurant['description'];
          $id = $restaurant['id'];
          $cuisine_id = $restaurant['cuisine_id'];
          $location = $restaurant['location'];
          $rating = $restaurant['rating'];
          $name = $restaurant['name'];
          $new_restaurant = new Restaurant($description, $id, $cuisine_id, $location, $rating, $name);
          array_push($restaurants, $new_restaurant);
      }
      return $restaurants;
    }
  }

 ?>
