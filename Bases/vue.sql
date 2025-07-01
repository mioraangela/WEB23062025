CREATE OR REPLACE VIEW v_liste_employer_depart AS
SELECT 
D.dept_no,
D.dept_name,
E.emp_no,
E.first_name,
E.last_name,
DE.to_date
FROM departments D
JOIN dept_emp DE
on D.dept_no = DE.dept_no
JOIN employees E
ON E.emp_no = DE.emp_no
WHERE DE.to_date ='9999-01-01'

CREATE OR REPLACE VIEW v_
SELECT 
*, Count(*) As nb_employees
FROM v_liste_employer_depart E
GROUP BY E.dept_no