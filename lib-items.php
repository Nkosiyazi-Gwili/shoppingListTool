<?php
class Items {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo = null;
  private $stmt = null;
  public $error = null;
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt !== null) { $this->stmt = null; }
    if ($this->pdo !== null) { $this->pdo = null; }
  }

  // (C) HELPER FUNCTION - RUN SQL QUERY
  function query ($sql, $data=null) : void {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  // (D) GET ALL ITEMS
  function get () {
    $this->query("SELECT * FROM `items`");
    return $this->stmt->fetchAll();
  }

  // (E) ADD NEW ITEM
  function add ($name, $qty) {
    $this->query("INSERT INTO `items` (`name`, `qty`) VALUES (?,?)", [$name, $qty]);
    return true;
  }

  // (F) UPDATE ITEM STATUS
  function update ($got, $id) {
    $this->query("UPDATE `items` SET `got`=? WHERE `id`=?", [$got, $id]);
    return true;
  }

  // (G) DELETE ITEM
  function delete ($id) {
    $this->query("DELETE FROM `items` WHERE `id`=?", [$id]);
    return true;
  }
}

// (H) DATABASE SETTINGS - CHANGE TO YOUR LOCAL!
define("DB_HOST", "localhost");
define("DB_NAME", "");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (I) NEW ITEMS OBJECT
$_ITEMS = new Items();
