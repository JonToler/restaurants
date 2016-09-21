<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Cuisine.php";
    require_once "src/Restaurant.php";

    $server = 'mysql:host=localhost;dbname=best_restaurant_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CuisineTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
          Cuisine::deleteAll();
          Restaurant::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "hamburgers";
            $test_Cuisine = new Cuisine($name);
            //Act
            $result = $test_Cuisine->getName();
            //Assert
            $this->assertEquals($name, $result);
        }


        function test_getId()
        {
            //Arrange
            $name = "Work stuff";
            $id = 1;
            $test_Cuisine = new Cuisine($name, $id);
            //Act
            $result = $test_Cuisine->getId();
            //Assert
            $this->assertEquals(true, is_numeric($result));
        }


        function test_save()
        {
            //Arrange
            $name = "Work stuff";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            //Act
            $result = Cuisine::getAll();
            //Assert
            $this->assertEquals($test_Cuisine, $result[0]);
        }
        function test_getAll()
        {
            //Arrange
            $name = "Work stuff";
            $name2 = "Home stuff";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();
            //Act
            $result = Cuisine::getAll();
            //Assert
            $this->assertEquals([$test_Cuisine, $test_Cuisine2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "Wash the dog";
            $name2 = "Home stuff";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();
            //Act
            Cuisine::deleteAll();
            $result = Cuisine::getAll();
            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Wash the dog";
            $name2 = "Home stuff";
            $test_Cuisine = new Cuisine($name);
            $test_Cuisine->save();
            $test_Cuisine2 = new Cuisine($name2);
            $test_Cuisine2->save();
            //Act
            $result = Cuisine::find($test_Cuisine->getId());
            //Assert
            $this->assertEquals($test_Cuisine, $result);
        }

        function testGetRestaurants()
        {
            //Arrange
            $name = "Hamburgers";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();
            $test_cuisine_id = $test_cuisine->getId();
            $description = "Email client";
            $id = null;
            $location = "whatever";
            $rating = 1.1;
            $name = "name1";
            $test_restaurant = new Restaurant($description, $id, $test_cuisine_id, $location, $rating, $name);
            $test_restaurant->save();
            $description2 = "Meet with boss";
            $id = null;
            $location = "whatever";
            $rating = 1.1;
            $name = "name1";
            $test_restaurant2 = new Restaurant($description2, $id, $test_cuisine_id, $location, $rating, $name);
            $test_restaurant2->save();
            //Act
            $result = $test_cuisine->getRestaurants();
            //Assert
            $this->assertEquals([$test_restaurant, $test_restaurant2], $result);
        }

        function testSingleWordSearch()
        {
            //Arrange
            $name = "Hamburgers";
            $id = null;
            $test_cuisine = new Cuisine($name, $id);
            $test_cuisine->save();
            $test_result = $test_cuisine->findName($test_cuisine->getName());
            //Act
            if($test_result->getName()=="Hamburgers"){
              $result = true;
            }
            //Assert
            $this->assertEquals(true, $result);
        }


    }
 ?>
