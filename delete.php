<?php

include_once 'configdb.php';
include_once 'dbconnect.php';
include_once 'helpers.php';


$id = $_REQUEST['id'];

$sql = "DELETE from user where id = :id LIMIT 1";

$result = $pdo->prepare($sql);

$result->execute(['id' => $id]);

header("Location: index.php");
