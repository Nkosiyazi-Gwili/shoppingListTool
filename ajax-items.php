<?php
if ($_POST["req"]) {
  require "lib-items.php";
  switch ($_POST["req"]) {
  // (A) GET ALL ITEMS
  case "get":
    echo json_encode($_ITEMS->get());
    break;

  // (B) ADD ITEM
  case "add":
    $_ITEMS->add($_POST["name"], $_POST["qty"]);
    echo "OK";
    break;

  // (C) UPDATE ITEM STATUS
  case "update":
    $_ITEMS->update($_POST["got"], $_POST["id"]);
    echo "OK";
    break;

  // (D) DELETE ITEM
  case "delete":
    $_ITEMS->delete($_POST["id"]);
    echo "OK";
    break;
}}