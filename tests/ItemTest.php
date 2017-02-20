<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Item.php";

    $server= 'mysql:host=localhost:8889;dbname=item_test';
    $username= 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class ItemTest extends PHPUnit_Framework_TestCase
    {

      protected function tearDown()
      {
        Item::deleteAll();
      }

        function test_save()
        {
            //Arrange
            $item_name = "Korean Cookbook";
            $category = "Books";
            $new_item = new Item($item_name, $category);

            //Act
            $new_item->save();

            //Assert
            $result = Item::getAll();
            $this->assertEquals($new_item, $result[0]);
        }

        function test_getAll()
        {
          // Arrange
          $item_name = 'Korean Cookbook';
          $category = 'Books';
          $item_name2 = 'Think Like a Programmer';
          $category2 = 'Books';
          $test_item = new Item($item_name, $category);
          $test_item->save();
          $test_item2 = new Item($item_name2, $category2);
          $test_item2->save();

          // Act
          $result = Item::getAll();

          // Assert
          $this->assertEquals([$test_item,$test_item2],$result);
        }

        function test_deleteAll()
        {
          // Arrange
          $item_name = 'Korean Cookbook';
          $category = 'Books';
          $item_name2 = 'Think Like a Programmer';
          $category2 = 'Books';
          $test_item = new Item($item_name, $category);
          $test_item->save();
          $test_item2 = new Item($item_name2, $category2);
          $test_item2->save();

          //Act
          Item::deleteAll();

          //Assert
          $result = Item::getAll();
          $this->assertEquals([], $result);
        }

    }
?>
