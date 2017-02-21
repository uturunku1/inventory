<?php
    class Item
    {
        private $item_name;
        private $category;

        function __construct($item_name, $category, $storage_id, $id=null)
        {
            $this->item_name = $item_name;
            $this->category = $category;
            $this->storage_id=$storage_id;
            $this->id= $id;
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
        function getId()
        {
            return $this->id;
        }
        function getStorageId()
        {
            return $this->storage_id;
        }

        function getCategory()
        {
            return $this->category;
        }

        function save()
        {
            $GLOBALS['DB']-> exec("INSERT INTO items(item_name,category,storage_id) VALUES('{$this->getItemName()}','{$this->getCategory()}', {$this->getStorageId()});");
            $this->id = $GLOBALS['DB']->lastInsertId();

        }

        static function getAll()
        {
          $returned_items = $GLOBALS['DB']->query("select * FROM items;");
          $items = array();
          foreach($returned_items as $item)
          {
            $item_name = $item['item_name'];
            $category = $item['category'];
            $storage_id = $item['storage_id'];
            $id = $item['id'];
            $new_item = new Item($item_name,$category,$storage_id, $id);
            array_push($items,$new_item);
          }
          return $items;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM items;");
        }
        static function find($search_id)
        {
          $found_item= null;
          $items= Item::getAll();
          foreach ($items as $item) {
            $item_id= $item->getId();
            if ($item_id== $search_id){
              $found_item=$item;
            }
          }
          return $found_item;
        }


    }
?>
