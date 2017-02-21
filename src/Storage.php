<?php

class Storage
{
  private $location;
  private $id;

  function __construct($location, $id=null)
  {
    $this->location= $location;
    $this->id= $id;
  }
  function getLocation()
  {
    return $this->location;
  }
  function getId()
  {
    return $this->id;
  }
  function save()
  {
    $GLOBALS['DB']->exec("INSERT INTO storage_location(location)VALUES('{$this->getLocation()}')");
    $this->id = $GLOBALS['DB']->lastInsertId();
  }
  static function getAll()
  {
    $returned_storages = $GLOBALS['DB']->query("SELECT * FROM storage_location;");
    $storages = array();
    foreach ($returned_storages as $storage) {
      $location = $storage['location'];
      $id= $storage['id'];
      $new_storage= new Storage($location, $id);
      array_push($storages, $new_storage);
    }
    return $storages;
  }

  static function deleteAll()
  {
    $GLOBALS['DB']->exec("DELETE FROM storage_location;");
  }

  static function find($search_id)
  {
    $found_storage = null;
    $storages = Storage::getAll();
    foreach ($storages as $storage)
    {
      $storage_id = $storage->getId();
      if ($storage_id == $search_id)
      {
        $found_storage = $storage;
      }
    }
    return $found_storage;
  }
}

 ?>
