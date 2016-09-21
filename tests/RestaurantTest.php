<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once "src/Restaurant.php";
    require_once "src/Cuisine.php";
    $server = 'mysql:host=localhost;dbname=best_restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class RestaurantTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Cuisine::deleteAll();
          Restaurant::deleteAll();
        }
        function test_save()
        {
            //Arrange
            $name = "Hamburgers";
            $id = null;
            $test_cuisine = new Cuisine ($name, $id);
            $test_cuisine->save();

            $description = "Shit on a bun";
            $cuisine_id = $test_cuisine->getId();
            $location = "Everywhere";
            $rating = 0.1;
            $name = "Mcdonalds";
            $test_restaurant = new Restaurant($description, $id, $cuisine_id, $location, $rating, $name);

            //Act
            $test_restaurant->save();
            $result = Restaurant::getAll();

            //Assert
            $this->assertEquals($test_restaurant, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Hamburgers";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();
            $description = "Shit on a bun";
            $cuisine_id = $test_cuisine->getId();
            $location = "Everywhere";
            $rating = 0.1;
            $name = "Mcdonalds";
            $test_restaurant = new Restaurant($description, $id, $cuisine_id, $location, $rating, $name);
            $test_restaurant->save();
            $description2 = "It is like italian but with cardboard for bread";
            $cuisine_id2 = $test_cuisine->getId();
            $location2 = "by the mall";
            $rating2 = 0.2;
            $name2 = "Olive Garden";
            $test_restaurant2 = new Restaurant($description2, $id, $cuisine_id2, $location2, $rating2, $name2);
            $test_restaurant2->save();

            //Act
            $result = Restaurant::getAll();
            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }
        function test_getId()
        {
          //Arrange
          $name = "Hamburgers";
          $id = null;
          $test_cuisine = new Cuisine($name, $id);
          $test_cuisine->save();
          $description = "Shit on a bun";
          $cuisine_id = $test_cuisine->getId();
          $location = "Everywhere";
          $rating = 0.1;
          $name = "Mcdonalds";
          $test_restaurant = new Restaurant($description, $id, $cuisine_id, $location, $rating, $name);
          $test_restaurant->save();
          //Act
          $result = $test_restaurant->getId();
          //Assert
          $this->assertEquals(true, is_numeric($result));
        }

        function test_getCusineId()
        {
            //Arrange
            $name = "Hamburgers";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();
            $description = "Shit on a bun";
            $cuisine_id = $test_cuisine->getId();
            $location = "Everywhere";
            $rating = 0.1;
            $name = "Mcdonalds";
            $test_restaurant = new Restaurant($description, $id, $cuisine_id, $location, $rating, $name);
            $test_restaurant->save();
            //Act
            $result = $test_restaurant->getCuisineId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }
        function test_find()
         {
             //Arrange
             $name = "Hamburgers";
             $id = null;
             $test_cuisine = new Cuisine($name, $id);
             $test_cuisine->save();
             $name = "Italian";
             $id = null;
             $test_cuisine2 = new Cuisine($name, $id);
             $test_cuisine2->save();
             $description = "Shit on a bun";
             $cuisine_id = $test_cuisine->getId();
             $location = "Everywhere";
             $rating = 0.1;
             $name = "Mcdonalds";
             $test_restaurant = new Restaurant($description, $id, $cuisine_id, $location, $rating, $name);
             $test_restaurant->save();
             $description2 = "It is like italian but with cardboard for bread";
             $cuisine_id2 = $test_cuisine2->getId();
             $location2 = "by the mall";
             $rating2 = 0.2;
             $name2 = "Olive Garden";
             $test_restaurant2 = new Restaurant($description2, $id, $cuisine_id2, $location2, $rating2, $name2);
             $test_restaurant2->save();

             $description3 = "truffle shuffle";
             $cuisine_id3 = $test_cuisine->getId();
             $location3 = "Everywhere";
             $rating3 = 0.2;
             $name3 = "Little Big Burger";
             $test_restaurant3 = new Restaurant($description, $id, $cuisine_id, $location, $rating, $name);
             $test_restaurant3->save();
             //Act
             $result = Restaurant::find($test_restaurant->getCuisineId());
             //Assert
             $this->assertEquals([$test_restaurant, $test_restaurant3], $result);
         }
    }

?>
