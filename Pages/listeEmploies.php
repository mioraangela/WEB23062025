<?php 
    require("../Inclus/fonctions.php");
    $emploies = getListEmplois();
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
        <h1>Liste des Emploies</h1>
        <table border ='1' style="border-collapse: collapse">
            <tr>
                <th>Nom des Emploies</th>
                <th>Nombre Homme</th>
                <th>Nombre Femme</th>
                <th> Moyenne des Salaires</th>
            </tr>
            <?php foreach($emploies as $emploie) {?>
                <tr>
                    <td><?= $emploie['title']?></td>
                    <td><?= $emploie['nb_employees_homme']?></td>
                    <td><?= $emploie['nb_employees_femme']?></td>
                    <td><?= $emploie['avg_salaries']?></td>
                </tr>
            <?php }?>
        </table>
    </main>
</body>
</html>