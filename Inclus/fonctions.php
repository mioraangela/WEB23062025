<?php 
    <?php 
    require("dbconnect.php");

    function afficherLesProprietes(){
        $bdd = dbconnect();
        $sql = "SELECT * FROM immobilier_proprietes";
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getProprieteParId($idPropriete){
       $bdd = dbconnect();
        $sql = "SELECT * FROM immobilier_proprietes WHERE  id_propriete='%s'";
        $sql = sprintf($sql, $idPropriete);
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result; 
    }

    
    function getAgentProprieteParId($idPropriete){
        $bdd = dbconnect();
        $sql = "SELECT
                a.id_agent 
            FROM immobilier_listings il
            JOIN immobilier_proprietes p ON p.id_propriete = il.id_propriete
            JOIN immobilier_agents a ON a.id_agent = il.id_agent
            WHERE p.id_propriete ='%s';
        ";
        $sql = sprintf($sql, $idPropriete);
        $req = mysqli_query($bdd,$sql);
        $result = mysqli_fetch_assoc($req);
        mysqli_free_result($req);
        return $result; 
    }
    
    function getAgentParId($idAgent){
        $bdd = dbconnect();
        $sql = "SELECT immobilier_agents.id_agent,
            immobilier_agents.nom,
            immobilier_agents.prenom, 
            immobilier_proprietes.id_propriete, 
            immobilier_proprietes.ville, 
            immobilier_proprietes.adresse,
            immobilier_proprietes.type_maison
            FROM immobilier_listings
            JOIN immobilier_agents
            ON immobilier_agents.id_agent = immobilier_listings.id_agent
            JOIN immobilier_proprietes
            ON immobilier_proprietes.id_propriete = immobilier_listings.id_propriete
            WHERE immobilier_agents.id_agent='%s';
        ";
        $sql = sprintf($sql, $idAgent);
        $req = mysqli_query($bdd,$sql);
        $result = array();
        while ($ret = mysqli_fetch_assoc($req)){
            $result[] = $ret;
        };
        mysqli_free_result($req);
        return $result; 
    }

    function getAgentInfoParId($idAgent){
        $bdd = dbconnect();
        $sql = "SELECT DISTINCT immobilier_agents.id_agent,
            immobilier_agents.nom,
            immobilier_agents.prenom,
            immobilier_agents.region
            FROM immobilier_listings
            JOIN immobilier_agents
            ON immobilier_agents.id_agent = immobilier_listings.id_agent
            JOIN immobilier_proprietes
            ON immobilier_proprietes.id_propriete = immobilier_listings.id_propriete
            WHERE immobilier_agents.id_agent='%s';
        ";
        $sql = sprintf($sql, $idAgent);
        $req = mysqli_query($bdd,$sql);
        $result = array();
        while ($ret = mysqli_fetch_assoc($req)){
            $result[] = $ret;
        };
        mysqli_free_result($req);
        return $result; 
    }
?>
?>