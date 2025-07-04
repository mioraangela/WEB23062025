<?php 
    require("connexion.php");

    function afficherLesDepartements(){
        $bdd = dbconnect();
        $sql = "SELECT * FROM departments;";
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }
    
    function getIdDepartment($nomDepartment){
        $bdd = dbconnect();
        $sql = "SELECT dept_no
            FROM departments
            WHERE dept_name ='%s';
        ";
        $sql = sprintf($sql, $nomDepartment);
        $req = mysqli_query($bdd,$sql);
        $result = mysqli_fetch_assoc($req);
        mysqli_free_result($req);
        return $result; 
    }
    
    function getEmployeesDepart(){
        $bdd = dbconnect();
        $sql = "SELECT departments.dept_no, departments.dept_name
        , employees.birth_date,employees.first_name, 
        employees.last_name, employees.gender, 
        employees.emp_no,employees.hire_date
        FROM departments
        Join dept_emp
        on departments.dept_no = dept_emp.dept_no
        Join employees
        on dept_emp.emp_no = employees.emp_no
        ";
        $req = mysqli_query($bdd,$sql);
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getEmployees($nomEmployer,$departName,$ageMin,$ageMax){
        $bdd = dbconnect();

        $nomEmployer = mysqli_real_escape_string($bdd, $nomEmployer);
        $departName = mysqli_real_escape_string($bdd, $departName);
        $ageMin = (int)$ageMin;
        $ageMax = (int)$ageMax;

        $sql = "SELECT departments.dept_no, departments.dept_name
        , employees.birth_date,employees.first_name, 
        employees.last_name, employees.gender, 
        employees.emp_no, 
        TIMESTAMPDIFF( YEAR, employees.birth_date, CURDATE()) AS age
        FROM departments
        Join dept_emp
        on departments.dept_no = dept_emp.dept_no
        Join employees
        on dept_emp.emp_no = employees.emp_no
        where TimeSTAMPDIFF( YEAR, employees.birth_date, CURDATE())>= $ageMin
        AND TimeSTAMPDIFF( YEAR, employees.birth_date, CURDATE()) <= $ageMax
        AND (
            employees.first_name COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%' OR
            employees.last_name COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%'OR
            CONCAT(employees.last_name, ' ', employees.first_name) COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%' OR
            CONCAT(employees.first_name, ' ', employees.last_name) COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%'
        )
        AND departments.dept_name COLLATE utf8mb4_general_ci LIKE '%$departName%'
        LIMIT 20
        ";
        $req = mysqli_query($bdd,$sql);
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getNextEmployees($nomEmployer, $departName, $ageMin, $ageMax, $offset, $itemsPerPage){
        $bdd = dbconnect();

        // Sécuriser les entrées
        $nomEmployer = mysqli_real_escape_string($bdd, $nomEmployer);
        $departName = mysqli_real_escape_string($bdd, $departName);
        $ageMin = (int)$ageMin;
        $ageMax = (int)$ageMax;

        $sql = "SELECT departments.dept_no, departments.dept_name,
                    employees.birth_date, employees.first_name, 
                    employees.last_name, employees.gender, 
                    employees.emp_no, 
                    TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) AS age
                FROM departments
                JOIN dept_emp ON departments.dept_no = dept_emp.dept_no
                JOIN employees ON dept_emp.emp_no = employees.emp_no
                WHERE TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) BETWEEN $ageMin AND $ageMax
                AND (
                        employees.first_name COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%' OR
                        employees.last_name COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%' OR
                        CONCAT(employees.last_name, ' ', employees.first_name) COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%' OR
                        CONCAT(employees.first_name, ' ', employees.last_name) COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%'
                )
                AND departments.dept_name COLLATE utf8mb4_general_ci LIKE '%$departName%'
                LIMIT $offset, $itemsPerPage";

        $req = mysqli_query($bdd, $sql);
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    


    function getTotalEmployees($nomEmployer, $departName, $ageMin, $ageMax){
        $bdd = dbconnect();

        $nomEmployer = mysqli_real_escape_string($bdd, $nomEmployer);
        $departName = mysqli_real_escape_string($bdd, $departName);
        $ageMin = (int)$ageMin;
        $ageMax = (int)$ageMax;

        $sql = "SELECT COUNT(*) as total
                FROM departments
                JOIN dept_emp ON departments.dept_no = dept_emp.dept_no
                JOIN employees ON dept_emp.emp_no = employees.emp_no
                WHERE TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) BETWEEN $ageMin AND $ageMax
                AND (
                        employees.first_name COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%' OR
                        employees.last_name COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%' OR
                        CONCAT(employees.last_name, ' ', employees.first_name) COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%' OR
                        CONCAT(employees.first_name, ' ', employees.last_name) COLLATE utf8mb4_general_ci LIKE '%$nomEmployer%'
                )
                AND departments.dept_name COLLATE utf8mb4_general_ci LIKE '%$departName%'";

        $req = mysqli_query($bdd, $sql);
        $total = mysqli_fetch_assoc($req)['total'];
        mysqli_free_result($req);
        
        return $total;
    }


     function getMinEtMaxAge(){
        $bdd = dbconnect();
        $sql = "SELECT 
        MAX(TimeSTAMPDIFF( YEAR, employees.birth_date, CURDATE()))AS age_max,
        MIN(TimeSTAMPDIFF( YEAR, employees.birth_date, CURDATE())) AS age_min
        FROM departments
        Join dept_emp
        on departments.dept_no = dept_emp.dept_no
        Join employees
        on dept_emp.emp_no = employees.emp_no
        ";
        $req = mysqli_query($bdd,$sql);
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getEmployeesParId($idEmploye){
        $bdd = dbconnect();
        $sql = "SELECT * 
        FROM employees
        Where emp_no ='%s'
        ";
        $sql = sprintf($sql, $idEmploye);
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getSalaryHistoryParId($idEmploye){
        $bdd = dbconnect();
        $sql = "SELECT salaries.emp_no, titles.title, 
        salaries.salary, departments.dept_name,
        salaries.from_date, salaries.to_date
        FROM salaries
        Join employees
        on employees.emp_no = salaries.emp_no
        Join titles
        on employees.emp_no = titles.emp_no
        Join dept_emp
        on employees.emp_no = dept_emp.emp_no
        Join departments
        on departments.dept_no = dept_emp.dept_no
        Where salaries.emp_no ='%s'
        ";
        $sql = sprintf($sql, $idEmploye);
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getEmployeesParDepartParId($idDepart,$offset){
        $bdd = dbconnect();
        $sql = "SELECT departments.dept_no, departments.dept_name
        , employees.birth_date,employees.first_name,employees.emp_no, 
        employees.last_name, employees.gender,
        employees.hire_date
        FROM departments
        Join dept_emp
        on departments.dept_no = dept_emp.dept_no
        Join employees
        on dept_emp.emp_no = employees.emp_no
        Where departments.dept_no ='%s'
        LIMIT $offset,20
        ";
        $sql = sprintf($sql, $idDepart,$offset);
        $req = mysqli_query($bdd,$sql );
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }

    function getTotalEmployeesParDepartParId($idDepart){
        $bdd = dbconnect();
        $sql = "SELECT Count(*) AS count
        FROM departments
        Join dept_emp
        on departments.dept_no = dept_emp.dept_no
        Join employees
        on dept_emp.emp_no = employees.emp_no
        Where departments.dept_no ='%s'
        ";
        $sql = sprintf($sql, $idDepart);
        $req = mysqli_query($bdd, $sql);
        $result = mysqli_fetch_assoc($req);
        mysqli_free_result($req);
        return $result;
    }

    function getCurrentManager(){
        $bdd = dbconnect();
        $sql = "SELECT *
            FROM employees e
            Join dept_manager dm
            on e.emp_no = dm.emp_no
            Join departments d
            on d.dept_no = dm.dept_no
            WHERE dm.to_date ='9999-01-01';
        ";
        $req = mysqli_query($bdd,$sql);
        $result = array();
        while ($news = mysqli_fetch_assoc($req)) {
            $result[] = $news;
        }
        mysqli_free_result($req);
        return $result;
    }
    
?>