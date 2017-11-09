<?php

include_once 'config.php';
include_once 'connectdb.php';
include_once 'helpers.php';


$id = $_REQUEST['id'];

$sql = "DELETE from distro where id = :id LIMIT 1";

$result = $pdo->prepare($sql);

$result->execute(['id' => $id]);

header("Location: index.php");
