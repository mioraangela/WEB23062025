<?php 
    require("../Inclus/fonctions.php");
    $departments = afficherLesDepartements();
    $ages = getMinEtMaxAge();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="listedepartement.php">Liste des departements</a>
    <br><br>
    <form action="afficherEmployees.php" method="Post">
        <p>Nom employe <input type="text" id="nom" name="nom">  </p>
        
        <select name="departments" id="departments">
            <option value="">Choissiser le departement</option>
            <?php foreach ($departments as $department) { ?>
                <option value="<?= $department['dept_name']?>"><?=$department['dept_name']?></option>
            <?php }?>
        </select>

        <?php foreach ($ages as $age) { ?>
            <p> Selectionner depuis le nombre <?= $age['age_min']?></p>
        <?php } ?>

            <p> age min <input type="number" id="ageMin" name="ageMin"></p>
            <p> age max <input type="number" id="ageMax" name="ageMax"></p>
        <input type="submit" value="rechercher">
    </form>
    <?php if(isset($_GET['error'])){ ?>
            <h5>Veuillez remplir les Champs</h5>
    <?php }?>
    
</body>
</html>