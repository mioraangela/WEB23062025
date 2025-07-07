<?php 
    require("../Inclus/fonctions.php");
    $departements = getCurrentManager();
    //var_dump($departements);
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
        <h1> Liste des departements</h1>
        <div>
            <a href="index.php">home</a>
        </div>
        <table border ='1' style="border-collapse: collapse">

            <tr>
                <th> Numero de departements </th>
                <th> Nom de departements</th>
                <th> Managers </th>
                <th>Nombre des Employers</th>
            </tr>

            <?php foreach($departements as $departement) { ?>
                <?php $nomDepart = $departement['dept_name'];
                    $idDepart = getIdDepartment($nomDepart);
                    $first_name = $departement['first_name'];
                    $last_name = $departement['last_name'];
                ?>
                    <tr>
                        <td><?= $departement['dept_no']?></td>
                        <td><a href="employes.php?id=<?= $idDepart?>"><?= $nomDepart?></a></td>
                        <td><?= $last_name?> <?= $first_name?> </td>
                        <td> <?=$departement['nb_employees']?></td>
                    </tr>
            <?php } ?>

        </table>
    </main>
</body>
</html>