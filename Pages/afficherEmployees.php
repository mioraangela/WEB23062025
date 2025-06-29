<?php 
    require("../Inclus/fonctions.php");
    $nomEmployer = $_POST['nom'];
    $departName = $_POST['departments'];
    $ageMin = $_POST['ageMin'];
    $ageMax =$_POST['ageMax'];
    $employees = getEmployees($nomEmployer,$departName,$ageMin,$ageMax);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th>Nom departement</th>
            <th>Nom Employer</th>
            <th>Age</th>
        </tr>
        <?php foreach ($employees as $employe) {?>
            <tr>
                <td><?=$employe['dept_name']?></td>
                <td><?=$employe['last_name']?> <?=$employe['first_name']?> </td>
                <td><?=$employe['age']?></td>
            </tr>
        <?php } ?>
    </table>
    
</body>
</html>