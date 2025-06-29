<?php 
    require("../Inclus/fonctions.php");
    $idEmployer=$_GET['id'];
    $employer = getEmployeesParId($idEmployer);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach($employer as $info){ ?>
        <p>Nom: <?= $info['last_name']?></p>
        <p>Prenom: <?=$info['first_name']?></p>
        <p>Numero id: <?=$info['emp_no']?></p>
        <p>Date de naissance: <?=$info['birth_date']?></p>
        <p>Sexe: <?=$info['gender']?></p>
        <p>Date de recrutement: <?=$info['hire_date']?></p>
    <?php } ?>
    
</body>
</html>