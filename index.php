<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Matthew's Recipes</title>
    </head>
    
    <body>
        <h1 id="title"><a href="./index.php">Matthew's recipes</a></h1>
        <div id="nav">
            <a href="./index.php">Home</a>
            <a href="./add_recipe.php">Ajouter une recette</a>
        </div>
        

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="spacing">

            <div id="search">
                <div id=""><i class="fa fa-fw fa-search" id="logosearch"></i></div>
                <input name="value" id="input" type="text" placeholder="Trouver une recette" maxlength="32" autocomplete="off">
                <input type="submit" value="Rechercher" id="submit">
            </div>

            <div id="bordure_separation"></div>
        </form>

        <?php
            include "database.php";
            global $db;
            // define variables and set to empty values
            $value = "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                if (empty($_POST["value"])) {
                    echo "<script> window.location.href='search.php'; </script>";
                } else {
                    $value = $_POST["value"];
                }
            }

            if (empty($value)) {
                return;
            } else {
                $sql = "SELECT * FROM recette 
                INNER JOIN auteur ON recette.ID_auteur = auteur.ID_auteur
                INNER JOIN category ON recette.ID_category = category.ID_category 
                INNER JOIN orientation ON recette.ID_orientation = orientation.ID_orientation 
                INNER JOIN livre ON recette.ID_livre = livre.ID_livre WHERE nom LIKE ?";
            }

            $query = $db->prepare($sql);
            $query->execute(["%".$value."%"]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            echo "<div class='box'>
                <h2>Beers</h2>
                <table>
                    <tr>
                        <th>Name</th>
                    </tr>";
                        foreach ($result as $row) {
                            echo "<tr>";
                            echo "<td><a href='recipe.php?id=".$row["ID_recette"]."'>" . $row["nom"] . "</a></td>";
                            echo "</tr>";
                        }
                echo '</table>
                <br>
                <a href="add_recipe.php" class="button">Ajouter une recette</a>
            </div>';
            ?>

    </body>
</html>
