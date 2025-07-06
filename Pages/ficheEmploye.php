<?php 
    require("../Inclus/fonctions.php");
    $idEmployer=$_GET['id'];
    $employer = getEmployeesParId($idEmployer);
    $salaires = getSalaryHistoryParId($idEmployer);
    $longTimeEmploi = getLongTimeEmploi($idEmployer);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Fiche Employer</h1>
    <div>
        <a href="index.php">home</a>
    </div>
    <?php foreach($employer as $info){ ?>
        <p>Nom: <?= $info['last_name']?></p>
        <p>Prenom: <?=$info['first_name']?></p>
        <p>Numero id: <?=$info['emp_no']?></p>
        <p>Date de naissance: <?=$info['birth_date']?></p>
        <p>Sexe: <?=$info['gender']?></p>
        <p>Date de recrutement: <?=$info['hire_date']?></p>
        <p>emploi le plus long: <?= $longTimeEmploi[0]['title']?> vers la date <?= $longTimeEmploi[0]['from_date']?> a <?= $longTimeEmploi[0]['to_date']?></p>
    <?php } ?>
        <p> Emploi occuper: <?= $salaires[0]['title']?></p>
    <br>
    <table border ='1' style="border-collapse: collapse">
        <tr>
            <th>Emploi occuper</th>
            <th>Salaire</th>
            <th>Nom de departement</th>
            <th>Date debut</th>
            <th>Date fin</th>
        </tr>
        <?php foreach($salaires as $salaire){?>
            <tr>
                <td><?= $salaire['title']?></td>
                <td><?= $salaire['salary']?></td>
                <td><?= $salaire['dept_name']?></td>
                <td><?= $salaire['from_date']?></td>
                <td><?= $salaire['to_date']?></td>
            </tr>
        <?php } ?>
    </table>
    
</body>
</html>