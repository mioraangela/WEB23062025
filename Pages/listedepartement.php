<?php 
    require("../Inclus/fonctions.php");
    $departements = afficherLesDepartements();
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
        <table >
            <tr>
                <th>numero de departements </th>
            
                <th>nom de departements</th>
            </tr>

            <?php foreach($departements as $departement) { ?>
                <tr>
                    <td><?= $departement['dept_no']?></td>
                    <td><a href="employes.php?id="><?= $departement['dept_name']?></a></td>
                </tr>
            <?php } ?>
        </table>
    </main>
</body>
</html>