<?php
    include_once 'configdb.php';
    include_once 'dbconnect.php';
    include_once 'helpers.php';

//
//    $sql = "SELECT * FROM pubgapp WHERE id = :id LIMIT 1";
//    $resultpubg = $pdo->prepare($sql);

    $queryResult = $pdo->query("SELECT * FROM user");

dameDato($queryResult)

?>

<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Start Menu</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">

                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>

            </button>
            <a class="navbar-brand" href="#">PubgApp</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="index.php">Inicio</a></li>
                <li><a href="add.php">Add User</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <h1>PUBG Best Players</h1>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Update</th>
            <th>Image</th>
            <th>Username</th>
            <th>Favorite Weapon</th>
            <th>Wins</th>
            <th>Rating</th>
            <th>Most Kills</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
            <?php while( $row = $queryResult->fetch(PDO::FETCH_ASSOC) ): ?>
            <tr>
                <td><a href="update.php?id=<?=$row['id']?>" class="editar">
                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                    </a>
                </td>
                <td><img src="<?=$row['image']?>" alt="Image of <?=$row['username']?>"></td>
                <td><?=$row['username']?></td>
                <td><?=$row['favweapon']?></td>
                <td><?=$row['wins']?></td>
                <td><?=$row['rating']?></td>
                <td><?=$row['mostkills']?></td>
                <td><a href="delete.php?id=<?=$row['id']?>" class="borrar"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
            </tr>
        <?php endwhile; ?>

        </tbody>
    </table>
</div><!-- /.container -->
</body>
</html>

