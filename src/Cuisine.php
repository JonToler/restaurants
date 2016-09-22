<?php
    class Cuisine
    {
        private $name;
        private $id;

        function __construct($name, $id = null)
        {
            $this->name = $name;
            $this->id = $id;
        }
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }
        function getName()
        {
            return $this->name;
        }
        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO cuisine (name) VALUES ('{$this->getName()}')");
            $this->id= $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_cuisine = $GLOBALS['DB']->query("SELECT * FROM cuisine;");
            $cuisine = array();
            foreach($returned_cuisine as $cuisine1) {
                $name = $cuisine1['name'];
                $id = $cuisine1['id'];
                $new_cuisine = new Cuisine($name, $id);
                array_push($cuisine, $new_cuisine);
            }
            return $cuisine;
        }

        static function deleteAll()
        {
          $GLOBALS['DB']->exec("DELETE FROM cuisine;");
        }

        static function find($search_id)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_id = $cuisine->getId();
                if ($cuisine_id == $search_id) {
                  $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }
        static function findName($name)
        {
            $found_cuisine = null;
            $cuisines = Cuisine::getAll();
            foreach($cuisines as $cuisine) {
                $cuisine_name = $cuisine->getName();
                if ($cuisine_name == $name) {
                  $found_cuisine = $cuisine;
                }
            }
            return $found_cuisine;
        }

        function getRestaurants()
        {
            $restaurants = Array();
            $returned_restaurants = $GLOBALS['DB']->query("SELECT * FROM restaurant WHERE cuisine_id = {$this->getId()} ;");
            foreach($returned_restaurants as $restaurant) {
                $description = $restaurant['description'];
                $id = $restaurant['id'];
                $name = $restaurant['name'];
                $cuisine_id = $restaurant['cuisine_id'];
                $location = $restaurant['location'];
                $rating = $restaurant['rating'];
                $new_restaurant = new Restaurant($description, $id, $cuisine_id, $location, $rating, $name);
                array_push($restaurants, $new_restaurant);
            }
            return $restaurants;
        }

    }

 ?>
