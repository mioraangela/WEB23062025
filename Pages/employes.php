<?php 
    require("../Inclus/fonctions.php");
    $idDepart = $_GET['id'];
    $employees = getEmployeesParDepartParId($idDepart);
    $count = 1;
    $next = getNextEmployees($nomEmployer,$departName,$ageMin,$ageMax,$count);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <main>
        <table>
            <tr>
                <th> Numero de departements </th>
                <th> Nom de departements</th>
                <th> Date de naissance</th>
                <th> Nom des employes</th>
                <th> Sexe</th>
                <th> Date de recrutement</th>
            </tr>
            <?php foreach($employees as $employe){
                $idEmploye = $employe['emp_no']; 
            ?>
                <a href="ficheEmploye.php?id=<?= $idEmploye?>">
                    <tr onclick="window.location='ficheEmploye.php?id=<?= $idEmploye?>';"
                        style="cursor:pointer;"
                    >
                        <td><?=$employe['dept_no']?></td>
                        <td><?=$employe['dept_name']?></td>
                        <td><?=$employe['birth_date']?></td>
                        <td><?=$employe['last_name']?> <?=$employe['first_name']?></td>
                        <td><?=$employe['gender']?></td>
                        <td><?=$employe['hire_date']?></td>
                    </tr>
                </a>

            <?php } ?>
        </table>
    </main>
</body>
</html>