<?php 
    require("../Inclus/fonctions.php");
    $idEmployer=$_GET['id'];
    $employer = getEmployeesParId($idEmployer);
    $salaires = getSalaryHistoryParId($idEmployer);
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
    <br>
    <table>
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