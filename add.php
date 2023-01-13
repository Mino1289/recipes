<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="./img/logo.ico" type="image/x-icon">
        <title>Beer Advisor</title>
    </head>
    
    <body>
        <?php
            session_start();

            include 'database.php';
            global $db;

            $types = ["auteur", "category", "livre", "orientation"];
            $err = "";
            if (isset($_GET["type"]) && !empty($_GET["type"])) {
                // check if $_GET["type"] is in $types
                if (in_array($_GET["type"], $types)) {
                    $type = $_SESSION["type"] = $_GET["type"];
                }
            }
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST["new-item"]) && !empty($_POST["new-item"])) {
                    if (!isset($_SESSION["type"]) || empty($_SESSION["type"])) {
                        header("Location: ./add_recipe.php");
                    }

                    $type = $_SESSION["type"];
                    $sql = "INSERT INTO " . $type . " (" . $type . "_name) VALUES (?)";
                    $query = $db->prepare($sql);
                    $query->execute([$_POST["new-item"]]);

                    unset($_SESSION["type"]);
                    unset($_SESSION["id"]);
                    
                    header("Location: ./add_recipe.php");
                }
            }
        ?>
        <div class="box1">
            <h2>Add / update <?php echo $type; ?></h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                <div class="name">
                    <div><i class="fa fa-fw fa-user" id="logosearch"></i></div>
                    <input type="text" name="new-item" required class='input' placeholder="New or update value">
                </div>

                <input type="submit" class="button" value="Add / update">
                <?php echo $err; ?>
            </form>
        </div>

    </body>
</html>