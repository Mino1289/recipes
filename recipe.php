<html>
<head>
    <title>Matthew's recipes</title>
</head>

<body>

<?php
    include "database.php";
    global $db;

    $sql = "SELECT * FROM recette 
    INNER JOIN auteur ON recette.ID_auteur = auteur.ID_auteur
    INNER JOIN category ON recette.ID_category = category.ID_category 
    INNER JOIN orientation ON recette.ID_orientation = orientation.ID_orientation 
    INNER JOIN livre ON recette.ID_livre = livre.ID_livre WHERE ID_recette = ?";
    $query = $db->prepare($sql);
    $query->execute([$_GET["id"]]);
    $recipe = $query->fetch();


    echo "<div>";
    echo "<h1>".$recipe["nom"]. " - " . $recipe["auteur_name"]."</h1>";
    echo "<h3>". $recipe["livre_name"]. ", page : ". $recipe["page"] ."</h3>";
    echo "<h3>catégorie : ". $recipe["category_name"]. " , " . $recipe["orientation_name"]."</h3>";
    echo "</div>";
?>
</body>

</html>
