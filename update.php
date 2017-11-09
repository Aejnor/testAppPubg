<?php
    include_once 'configdb.php';
    include_once 'dbconnect.php';
    include_once 'dbhelper.php';
    include_once 'helpers.php';

    $id = $_REQUEST['id'];

    // Recovering data
    $player = getPlayer($id, $pdo);

    if( !$player ){
        header('Location: index.php');
    }

    $errors = array();
    $error = false;


    $username = "";
    $image = "";
    $favWeapon = "";
    $wins = "";
    $rating = "";
    $mostKills = "";

    if ( !empty($_POST) ) {
        $username = htmlspecialchars($_POST['username']);
        $image = htmlspecialchars($_POST['image']);
        $favWeapon = htmlspecialchars($_POST['favWeapon']);
        $wins = htmlspecialchars($_POST['wins']);
        $rating = htmlspecialchars($_POST['rating']);
        $mostKills = htmlspecialchars($_POST['mostKills']);

        // We check if there any empty field.

        if( $username == "" ){
            $errors['username']['required'] = "You need to put an username";
        }

        if( $favWeapon == ""){
            $errors['favweapon']['required'] = "You need to put a favorite weapon";
        }

        if (!is_numeric($wins) || $wins == ""){
            $errors['wins']['required'] = "You need to put a NUMBER of wins";
        }

        if (!is_numeric($rating) || $rating == ""){
            $errors['rating']['required'] = "You need to put a NUMBER of rating";
        }

        if (!is_numeric($mostKills) || $mostKills == ""){
            $errors['mostkills']['required'] = "You need to put a NUMBER of maximum kills";
        }

        if (empty($errors)) {
            // Si no tengo errores
            // Guardo en la base de datos
            $sql = "UPDATE user SET image = :image, username = :username, favweapon = :favWeapon, wins = :wins, 
                    rating = :rating, mostkills = :mostKills WHERE id = :id LIMIT 1";

            $result = $pdo->prepare($sql);

            $result->execute([
                'id'        => $id,
                'image'     => $image,
                'username'  => $username,
                'favWeapon' => $favWeapon,
                'wins'      => $wins,
                'rating'    => $rating,
                'mostKills' => $mostKills
            ]);

            // Mando la aplicación a la página de inicio

            header('Location: index.php');
        }else{
            $error = true;
        }

}

dameDato($player);
?>

<html lang="es">
<head>
    <meta charset="utf-8">
    <title>AddUser</title>

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
    <h1>Update the profile of <?php echo $player['username'] ?></h1>
    <form action="" method="post">
        <div class="form-group <?php echo (isset($errors['username']['required'])?"has-error":""); ?>">
            <label for="inputName">Username</label>
            <input type="text" class="form-control" id="inputUsername" name="username"
                   placeholder="Username"  value="<?=($error?$username:$player['username'])?>">
        </div>
        <?=generarAlert($errors, 'username')?>

        <div class="form-group">
            <label for="inputImage">Image</label>
            <input type="text" class="form-control" id="inputImage" name="image"
                   placeholder="Username Image URL" value="<?=($error?$image:$player['image'])?>">
        </div>

        <div class="form-group <?php echo (isset($errors['favweapon']['required'])?"has-error":""); ?>">
            <label for="inputFavWeapon">Favorite Weapon</label>
            <input type="text" class="form-control" id="inputFavWeapon" name="favWeapon"
                   placeholder="Favorite Weapon" value="<?=($error?$favWeapon:$player['favweapon'])?>">
        </div>
        <?=generarAlert($errors, 'favweapon ')?>

        <div class="form-group <?php echo (isset($errors['wins']['required'])?"has-error":""); ?>">
            <label for="inputWins">Wins</label>
            <input type="text" class="form-control" id="inputWins" name="wins"
                   placeholder="Wins" value="<?=($error?$wins:$player['wins'])?>">
        </div>
        <?=generarAlert($errors, 'wins')?>

        <div class="form-group <?php echo (isset($errors['rating']['required'])?"has-error":""); ?>">
            <label for="inputRating">Rating</label>
            <input type="text" class="form-control" id="inputRating" name="rating"
                   placeholder="User Rating" value="<?=($error?$rating:$player['rating'])?>">
        </div>
        <?=generarAlert($errors, 'rating')?>

        <div class="form-group <?php echo (isset($errors['mostkills']['required'])?"has-error":""); ?>">
            <label for="inputMostKills">Most Kills in Match</label>
            <input type="text" class="form-control" id="inputMostKills" name="mostKills"
                   placeholder="Most Kills in a match" value="<?=($error?$mostKills:$player['mostkills'])?>">
        </div>
        <?=generarAlert($errors, 'mostkills')?>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div><!-- /.container -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
