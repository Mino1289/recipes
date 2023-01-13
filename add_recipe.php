<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/add_beer.scss">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="./img/logo.ico" type="image/x-icon">
    <title>Beer Advisor | Add a beer</title>
</head>

<body>

    <script>
        function validate(input)
        {
            document.getElementsByName(input)[0].classList.add("error");
        }
    </script>

    <?php

        include 'database.php';

        global $db;


        $nameErr = $pageErr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $nom = $_POST["nom"];
            $livre = $_POST["livre"];
            $page = $_POST["page"];
            $auteur = $_POST["auteur"];
            $category = $_POST["category"];
            $orientation = $_POST["orientation"];
            
            
            if ($livre == "0") {
                $livre = "1";
            } 
            if ($auteur  == "0") {
                $auteur = "1";
            } 
            if ($category == "0") {
                $category = "1";
            }
            if ($orientation == "0") {
                $orientation = "1";
            }
            if (empty($nameErr) && empty($pageErr)) {
                // add a beer
                $sql = "INSERT INTO recette 
                (nom, ID_livre, page, ID_auteur, ID_category, ID_orientation) 
                VALUES (?, ?, ?, ?, ?, ?)";

                $query = $db->prepare($sql);
                $query->execute([$nom, $livre, $page, $auteur, $category, $orientation]);

                $id=$db->lastInsertId();
                if (empty($id)) {
                    echo "Error";
                } else {
                    echo "<script> window.location.href='recipe.php?id=".$id."'; </script>";
                }                
            }    
        }
    ?>

    <h1 id="title"><a href="./add_beer.php">Ajoutez une recette</a></h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">

        <div class="spacing"></div>

        <div id="add_beer_form">

            <div id="boiteD">
            
                <div class="conteneur" name="name_box">
                    <div><i class="fa fa-fw fa-tag" id="logosearch"></i></div>
                    <input required class='input' placeholder="Nom" type="text" name="nom">
                </div>  

                <?php echo $nameErr ?>

                <div class="conteneur">
                    <div><i class="fa fa-fw fa-map-marker" id="logosearch"></i></div>
                    <input class='input' placeholder="N° de page" type="text" name="page">
                </div>
                
                <?php echo $pageErr ?>

                <div class="conteneur" name="color_box">

                    <div><i class="fa fa-fw fa-book" id="logosearch"></i></div>
                    <select name="livre" class="select_options">

                        <option value="0">Choisissez un livre</option>
                        
                        <?php
                            $sql = "SELECT * FROM livre";
                            $query = $db->prepare($sql);
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $livre) {
                                echo "<option value='" . $livre['ID_livre'] . "'>" . $livre['livre_name'] . "</option>";
                            }
                        ?>

                    </select>
                    <a href="./add.php?type=livre">Ajouter un livre</a>
                    
                </div>
               
            </div>

            <div id="boiteG">
                <div class="conteneur" name="color_box">

                    <div><i class="fa fa-fw fa-tint" id="logosearch"></i></div>
                    <select name="auteur" class="select_options">

                        <option value="0">Choisissez un auteur</option>
                        
                        <?php
                            $sql = "SELECT * FROM auteur";
                            $query = $db->prepare($sql);
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $auteur) {
                                echo "<option value='" . $auteur['ID_auteur'] . "'>" . $auteur['auteur_name'] . "</option>";
                            }
                        ?>

                    </select>
                    <a href="./add.php?type=auteur">Ajouter un auteur</a>


                </div>

                <div class="conteneur" name="category_box">

                    <div><i class="fa fa-fw fa-folder" id="logosearch"></i></div>
                    <select name="category" class="select_options">

                        <option value="0">Choisissez une categorie</option>
                        
                        <?php
                            $sql = "SELECT * FROM category";
                            $query = $db->prepare($sql);
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $category) {
                                echo "<option value='" . $category['ID_category'] . "'>" . $category['category_name'] . "</option>";
                            }
                        ?>

                    </select>
                    <a href="./add.php?type=category">Ajouter une categorie</a>

                </div>
                
                <div class="conteneur" name="grains_box">

                    <div><i class="fa fa-fw fa-tree" id="logosearch"></i></div>
                    <select name="orientation" class="select_options">

                        <option value="0">Choisissez une orientation</option>
                        
                        <?php
                            $sql = "SELECT * FROM orientation";
                            $query = $db->prepare($sql);
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($result as $orientation) {
                                echo "<option value='" . $orientation['ID_orientation'] . "'>" . $orientation['orientation_name'] . "</option>";
                            }
                        ?>

                    </select>
                    <a href="./add.php?type=orientation">Ajouter une orientation</a>


                </div>

            </div>

        </div>

        <div id='button_submit'>

            <input type="submit" value="Submit" id="submit">
            
        </div>

    </form>
</body>

</html>