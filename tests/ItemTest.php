<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Item.php";
    require_once "src/Storage.php";

    $server= 'mysql:host=localhost:8889;dbname=item_test';
    $username= 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ItemTest extends PHPUnit_Framework_TestCase
    {

      protected function tearDown()
      {
        Item::deleteAll();
        Storage::deleteAll();
      }

        function test_save()
        {
            //Arrange
            $location = "Garage";
            $id = null;
            $test_storage = new Storage($location, $id);
            $test_storage->save();

            $item_name = "Korean Cookbook";
            $category = "Books";
            $storage_id = $test_storage->getId();
            $new_item = new Item($item_name, $category, $storage_id);

            //Act
            $new_item->save();

            //Assert
            $result = Item::getAll();
            $this->assertEquals($new_item, $result[0]);
        }

        function test_getAll()
        {
          // Arrange
          $location = "Garage";
          $id = null;
          $test_storage = new Storage($location, $id);
          $test_storage->save();

          $item_name = 'Korean Cookbook';
          $category = 'Books';
          $item_name2 = 'Think Like a Programmer';
          $category2 = 'Books';
          $storage_id = $test_storage->getId();
          $test_item = new Item($item_name, $category, $storage_id);
          $test_item->save();
          $test_item2 = new Item($item_name2, $category2, $storage_id);
          $test_item2->save();

          // Act
          $result = Item::getAll();

          // Assert
          $this->assertEquals([$test_item,$test_item2],$result);
        }

        function test_deleteAll()
        {
          // Arrange
          $location = "Garage";
          $id = null;
          $test_storage = new Storage($location, $id);
          $test_storage->save();

          $item_name = 'Korean Cookbook';
          $category = 'Books';
          $item_name2 = 'Think Like a Programmer';
          $category2 = 'Books';
          $storage_id = $test_storage->getId();
          $test_item = new Item($item_name, $category, $storage_id);
          $test_item->save();
          $test_item2 = new Item($item_name2, $category2, $storage_id);
          $test_item2->save();

          //Act
          Item::deleteAll();

          //Assert
          $result = Item::getAll();
          $this->assertEquals([], $result);
        }
        function test_getId()
        {
          $location = "Garage";
          $id = null;
          $test_storage = new Storage($location, $id);
          $test_storage->save();

          $item_name = "Korean Cookbook";
          $category = "Books";
          $storage_id = $test_storage->getId();
          $id = 1;
          $test_item = new Item($item_name, $category, $id, $storage_id);

          $result= $test_item->getId();

          $this->assertEquals(1, $result);
        }
        function test_find()
        {
          $location = "Garage";
          $id = null;
          $test_storage = new Storage($location, $id);
          $test_storage->save();

          $item_name = 'Korean Cookbook';
          $category = 'Books';
          $item_name2 = 'Think Like a Programmer';
          $category2 = 'Books';
          $storage_id = $test_storage->getId();
          $test_item = new Item($item_name, $category, $storage_id);
          $test_item->save();
          $test_item2 = new Item($item_name2, $category2, $storage_id);
          $test_item2->save();

          // Act
          $id = $test_item->getId();
          $result = Item::find($id);

          // Assert
          $this->assertEquals($test_item,$result);

        }



    }
?>
