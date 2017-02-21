<?php
/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/


    require_once "src/Item.php";
    require_once "src/Storage.php";
    $server= 'mysql:host=localhost:8889;dbname=item_test';
     $userlocation = 'root';
     $password = 'root';
     $DB = new PDO($server, $userlocation, $password);

     class StorageTest extends PHPUnit_Framework_TestCase
     {
       protected function tearDown()
      {
        Storage::deleteAll();
      }

      function test_getLocation()
      {
          //Arrange
          $location = "Garage";
          $test_Storage = new Storage($location);

          //Act
          $result = $test_Storage->getLocation();

          //Assert
          $this->assertEquals($location, $result);
      }

      function test_getId()
      {
          //Arrange
          $location = "Garage";
          $id = 1;
          $test_Storage = new Storage($location, $id);

          //Act
          $result = $test_Storage->getId();

          //Assert
          $this->assertEquals(true, is_numeric($result));
      }

      function test_save()
      {
          //Arrange
          $location = "Garage";
          $test_Storage = new Storage($location);
          $test_Storage->save();

          //Act
          $result = Storage::getAll();

          //Assert
          $this->assertEquals($test_Storage, $result[0]);
      }

      function test_getAll()
      {
          //Arrange
          $location = "Garage";
          $location2 = "Living Room";
          $test_Storage = new Storage($location);
          $test_Storage->save();
          $test_Storage2 = new Storage($location2);
          $test_Storage2->save();

          //Act
          $result = Storage::getAll();

          //Assert
          $this->assertEquals([$test_Storage, $test_Storage2], $result);
      }

      function test_deleteAll()
      {
          //Arrange
          $location = "Garage";
          $location2 = "Living Room";
          $test_Storage = new Storage($location);
          $test_Storage->save();
          $test_Storage2 = new Storage($location2);
          $test_Storage2->save();

          //Act
          Storage::deleteAll();
          $result = Storage::getAll();

          //Assert
          $this->assertEquals([], $result);
      }

      function test_find()
      {
          //Arrange
          $location = "Garage";
          $location2 = "Living Room";
          $test_Storage = new Storage($location);
          $test_Storage->save();
          $test_Storage2 = new Storage($location2);
          $test_Storage2->save();

          //Act
          $result = Storage::find($test_Storage->getId());

          //Assert
          $this->assertEquals($test_Storage, $result);
      }
  }

 ?>
