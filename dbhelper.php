<?php

function getPlayer($id, $pdo){
    $sql = "SELECT * FROM user WHERE id = :id";
    $result = $pdo->prepare($sql);

    $result->execute(['id' => $id]);

    return $result->fetch(PDO::FETCH_ASSOC);
}