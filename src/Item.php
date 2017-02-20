<?php
    class Item
    {
        private $item_name;
        private $category;

        function __construct($item_name, $category)
        {
            $this->item_name = $item_name;
            $this->category = $category;
        }

        function setItemName($item_name)
        {
            $this->item_name = (string) $item_name;
        }

        function getItemName()
        {
            return $this->item_name;
        }
        function setCategory($category)
        {
            $this->category = (string) $category;
        }

        function getCategory()
        {
            return $this->category;
        }

        function save()
        {
            $GLOBALS['DB']-> exec("INSERT INTO items(item_name,category) VALUES('{$this->getItemName()}','{$this->getCategory()}');");

        }

        static function getAll()
        {
          $returned_items = $GLOBALS['DB']->query("select * FROM items;");
          $items = array();
          foreach($returned_items as $item)
          {
            $item_name = $item['item_name'];
            $category = $item['category'];
            $new_item = new Item($item_name,$category);
            array_push($items,$new_item);
          }
          return $items;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM items;");
        }


    }
?>
