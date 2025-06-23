# test_db
Une base de données d'exemple avec une suite de tests intégrée, 
utilisée pour tester vos applications et serveurs de bases de données.

Ce dépôt a été migré depuis [Launchpad](https://launchpad.net/test-db).

Voir l'utilisation dans la [documentation MySQL](https://dev.mysql.com/doc/employee/en/index.html).

## Origine

Les données originales ont été créées par Fusheng Wang et Carlo Zaniolo chez Siemens Corporate Research. 
Les données sont au format XML.
http://timecenter.cs.aau.dk/software.htm

Giuseppe Maxia a créé le schéma relationnel et Patrick Crews a exporté les données en format relationnel.

La base de données contient environ 300 000 enregistrements d'employés avec 2,8 millions d'entrées de salaires. 
Les données exportées font 167 Mo, 
ce qui n'est pas énorme, 
mais suffisamment lourd pour être non trivial lors des tests.

Les données ont été générées, 
et en tant que telles, 
il y a des incohérences et des problèmes subtils. 
Plutôt que de les supprimer, 
nous avons décidé de laisser le contenu intact et d'utiliser ces problèmes comme exercices de nettoyage de données.

## Prérequis

Vous avez besoin d'un serveur de base de données MySQL (5.0+) et d'exécuter les commandes ci-dessous via un utilisateur disposant des privilèges suivants :

    SELECT, INSERT, UPDATE, DELETE, 
    CREATE, DROP, RELOAD, REFERENCES, 
    INDEX, ALTER, SHOW DATABASES, 
    CREATE TEMPORARY TABLES, 
    LOCK TABLES, EXECUTE, CREATE VIEW

## Installation :

1. Téléchargez le dépôt.
2. Changez de répertoire pour aller dans le dépôt.

Ensuite, exécutez :

    mysql < employees.sql

Si vous souhaitez installer avec deux grandes tables partitionnées, exécutez :

    mysql < employees_partitioned.sql

## Test de l'installation

Après l'installation, vous pouvez exécuter l'une des commandes suivantes :

    mysql -t < test_employees_md5.sql
    # OU
    mysql -t < test_employees_sha.sql

Par exemple :

    mysql -t < test_employees_md5.sql
    +----------------------+
    | INFO                 |
    +----------------------+
    | TEST DE L'INSTALLATION |
    +----------------------+
    +--------------+------------------+----------------------------------+
    | nom_tableau  | enregistrements_attendus | crc_attendu                     |
    +--------------+------------------+----------------------------------+
    | employees    |           300024 | 4ec56ab5ba37218d187cf6ab09ce1aa1 |
    | departments  |                9 | d1af5e170d2d1591d776d5638d71fc5f |
    | dept_manager |               24 | 8720e2f0853ac9096b689c14664f847e |
    | dept_emp     |           331603 | ccf6fe516f990bdaa49713fc478701b7 |
    | titles       |           443308 | bfa016c472df68e70a03facafa1bc0a8 |
    | salaries     |          2844047 | fd220654e95aea1b169624ffe3fca934 |
    +--------------+------------------+----------------------------------+
    +--------------+------------------+----------------------------------+
    | nom_tableau  | enregistrements_trouvés | crc_trouvé                      |
    +--------------+------------------+----------------------------------+
    | employees    |           300024 | 4ec56ab5ba37218d187cf6ab09ce1aa1 |
    | departments  |                9 | d1af5e170d2d1591d776d5638d71fc5f |
    | dept_manager |               24 | 8720e2f0853ac9096b689c14664f847e |
    | dept_emp     |           331603 | ccf6fe516f990bdaa49713fc478701b7 |
    | titles       |           443308 | bfa016c472df68e70a03facafa1bc0a8 |
    | salaries     |          2844047 | fd220654e95aea1b169624ffe3fca934 |
    +--------------+------------------+----------------------------------+
    +--------------+---------------+-----------+
    | nom_tableau  | correspondance_enregistrements | correspondance_crc |
    +--------------+---------------+-----------+
    | employees    | OK            | ok        |
    | departments  | OK            | ok        |
    | dept_manager | OK            | ok        |
    | dept_emp     | OK            | ok        |
    | titles       | OK            | ok        |
    | salaries     | OK            | ok        |
    +--------------+---------------+-----------+

## AVERTISSEMENT

À ma connaissance, 
ces données sont fictives et ne correspondent pas à des personnes réelles. 
Toute ressemblance avec des personnes existantes est purement fortuite.

## LICENCE

Ce travail est sous licence Creative Commons Attribution-Share Alike 3.0 Unported License. 
Pour consulter une copie de cette licence, 
visitez http://creativecommons.org/licenses/by-sa/3.0/ ou envoyez une lettre à Creative Commons, 
171 Second Street, Suite 300, San Francisco, California, 94105, USA.