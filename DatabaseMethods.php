<?php

    # The file has 3 sections
    # 1 - select key statements
    # 2 - select * statements
    # 3 - transaction methods
    # 4 - FAQ

    # This is just a base of what I think we need to run the program successfully from the frontend.
    # Feel free to modify the file as needed!

    function ConnectToDatabase()
    {
        $servername = "ryc353.encs.concordia.ca";
        $dbname = "ryc353_4";
        $username = "ryc353_4";
        $password = "353winte";

        #Using PDO
        try {
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully <br/>";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $connection;
    }


    # Section 1
    # Select Key statements.
    # These are for creating the frontend dropdowns for foreign keys in Add transactions.

    function getEmployeesKeys()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT SIN FROM employees;");
        $connection = null;
        return $results;
    }

    function getLocationsKeys()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT Address FROM locations;");
        $connection = null;
        return $results;
    }

    function getDepartmentsKeys()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT Number FROM departments;");
        $connection = null;
        return $results;
    }

    function getProjectsKeys()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT Id FROM projects;");
        $connection = null;
        return $results;
    }


    # Section 2
    # Select * statements.
    # These are for getting all entries from the tables to display on the frontend for Modify and Delete transactions.

    function getEmployees()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT * FROM employees;");
        $connection = null;
        return $results;
    }

    function getDependents()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT * FROM dependents;");
        $connection = null;
        return $results;
    }

    function getDepartments()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT * FROM departments;");
        $connection = null;
        return $results;
    }

    function getLocations()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT * FROM locations;");
        $connection = null;
        return $results;
    }

    function getDepartmentLocations()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT * FROM departmentlocations;");
        $connection = null;
        return $results;
    }

    function getProjects()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT * FROM projects;");
        $connection = null;
        return $results;
    }

    function getWorksOn()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT * FROM workson;");
        $connection = null;
        return $results;
    }


    # Section 3
    # Add, Modify, and Delete methods for each table (where applicable).
    # Currently they return TRUE if the transaction is successfully completed, FALSE otherwise.
    # May later want to change the booleans to confirmation messages.

    # Employees
    function addEmployee($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("INSERT INTO employees 
                               (SIN, Name, DateOfBirth, Gender, Address, PhoneNumber, 
                               Salary, SupervisorId, DepartmentNumber) 
                               VALUES ($values->SIN, $values->Name, $values->DateOfBirth, 
                               $values->Gender, $values->Address, $values->PhoneNumber, 
                               $values->Salary, $values->SupervisorId, $values->DepartmentNumber)");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function modifyEmployee($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("UPDATE employees set Name = $values->Name, 
                               DateofBirth = $values->DateOfBirth, Gender = $values->Gender, 
                               Address = $values.Address, PhoneNumber = $values->PhoneNumber, 
                               Salary = $values->Salary, SupervisorId = $values->SupervisorId, 
                               DepartmentNumber = $values->DepartmentNumber
                               WHERE SIN = $values->SIN;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function deleteEmployee($SIN)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("UPDATE departments SET Manager = null, StartDate = null WHERE Manager = $SIN;");
            $connection->query("DELETE FROM dependents WHERE Guardian = $SIN;");
            $connection->query("DELETE FROM workson WHERE Employee = $SIN;");
            $connection->query("UPDATE employees SET SupervisorId = null WHERE SupervisorId = $SIN;");
            $connection->query("DELETE FROM employees WHERE SIN = $SIN;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    # Dependents
    function addDependent($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("INSERT INTO dependents (SIN, Name, DateOfBirth, Gender, Guardian) 
                               VALUES ($values->SIN, $values->Name, $values->DateOfBirth, 
                               $values->Gender, $values->Guardian)");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function modifyDependent($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("UPDATE dependents set Name = $values->Name, 
                               DateofBirth = $values->DateOfBirth, Gender = $values->Gender, 
                               Guardian = $values->Guardian
                               WHERE SIN = $values->SIN;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function deleteDependent($SIN)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("DELETE FROM dependents WHERE SIN = $SIN;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    # Departments
    function addDepartment($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("INSERT INTO departments (Number, Name, Manager, StartDate) 
                               VALUES ($values->Number, $values->Name, $values->Manager, $values->StartDate)");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function modifyDepartment($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("UPDATE departments set Name = $values->Name, 
                               Manager = $values->Manager, StartDate = $values->StartDate
                               WHERE Number = $values->Number;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function deleteDepartment($Number)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("DELETE FROM departmentlocations WHERE DepartmentNumber = $Number;");
            $connection->query("DELETE FROM departments WHERE Number = $Number;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    # Locations
    function addLocation($Address)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("INSERT INTO locations VALUES ($Address);");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function deleteLocation($Address)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("DELETE FROM locations WHERE Address = $Address;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    # DepartmentLocations
    function addDepartmentLocation($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("INSERT INTO departmentlocations (DepartmentNumber, Address) 
                               VALUES ($values->DepartmentNumber, $values->Address)");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function deleteDepartmentLocation($keyValues)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("DELETE FROM departmentlocations 
                               WHERE DepartmentNumber = $keyValues->DepartmentNumber AND Address = $keyValues->Address;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    # Projects
    function addProject($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("INSERT INTO projects (Id, Name, Address) 
                               VALUES ($values->Id, $values->Name, $values->Address)");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function modifyProject($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("UPDATE projects set Name = $values->Name, Address = $values->Address
                               WHERE Id = $values->Id;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function deleteProject($Id)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("DELETE FROM workson WHERE ProjectId = $Id;");
            $connection->query("DELETE FROM projects WHERE Number = $Id;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    # WorksOn
    function addWorksOn($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("INSERT INTO workson (Employee, ProjectId, HoursWorked) 
                               VALUES ($values->Employee, $values->ProjectId, $values->HoursWorked)");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function modifyWorksOn($values)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("UPDATE workson set HoursWorked = $values->HoursWorked
                               WHERE Employee = $values->Employee AND ProjectId = $values->ProjectId;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }

    function deleteWorksOn($keyValues)
    {
        $connection = ConnectToDatabase();
        try {
            $connection->query("DELETE FROM workson 
                               WHERE Employee = $keyValues->Employee AND ProjectId = $keyValues->ProjectId;");
            $connection = null;
        }
        catch (Exception $e)
        {
            return false;
        }
        return true;
    }


    # Section 4
    # FAQ (Frequently Asked Queries)

    # 1. Allows the user to write and send any SELECT query they want.
    function sendSelectQuery($query)
    {
        $q = explode(" ", $query)[0];
        if (strcasecmp($q, "SELECT") == 0) {

            $connection = ConnectToDatabase();
            $results = null;
            try {
                $results = $connection->query($query);
                $connection = null;
            } catch (Exception $e) {
                return false;
            }
            return $results;

        }
        else {
            return false;
        }
    }

    # 2. Get all employees and the number of dependents they have.
    function getNumberOfDependents()
    {
        $connection = ConnectToDatabase();
        $results = null;
        try {
            $results = $connection->query("SELECT employees.Name, count(dependents.guardian) 
                                          FROM employees, guardian WHERE employee.SIN = dependents.guardian;");
            $connection = null;
        } catch (Exception $e) {
            return false;
        }
        return $results;
    }

    # 3. Get the names, genders, and dates of birth of all an employee's dependents
    function getEmployeeDependents($SIN)
    {
        $connection = ConnectToDatabase();
        $results = null;
        try {
            $results = $connection->query("SELECT Name, Gender, DateOfBirth 
                                              FROM dependents, WHERE guardian=$SIN;");
            $connection = null;
        } catch (Exception $e) {
            return false;
        }
        return $results;
    }

    # 4. Get all the department managers.
    function getDepartmentManagers()
    {
        $connection = ConnectToDatabase();
        $results = null;
        try {
            $results = $connection->query("SELECT employees.Name, departments.Name 
                                          FROM employees, departments, WHERE employees.SIN = departments.Manager;");
            $connection = null;
        } catch (Exception $e) {
            return false;
        }
        return $results;
    }

    # 5. Get all the projects, the employees that are assigned to them, and the hours they've worked on those projects.
    function getProjectGroups()
    {
        $connection = ConnectToDatabase();
        $results = null;
        try {
            $results = $connection->query("SELECT projects.Name, employees.Name, workson.HoursWorked 
                                          FROM projects, employees, workson 
                                          WHERE workson.employee = employee.SIN AND workson.projectId = projects.Id
                                          ORDER BY projects.Id ASC;");
            $connection = null;
        } catch (Exception $e) {
            return false;
        }
        return $results;
    }

    # 6. Get all Supervisors Names
    function getSupervisorNames() {
        $connection = ConnectToDatabase();
        $results = null;
        try {
            $results = $connection->query("SELECT Name FROM employees 
                                          WHERE SIN IN (SELECT DISTINCT supervisorId FROM employees);");
            $connection = null;
        } catch (Exception $e) {
            return false;
        }
        return $results;
    }

    # 7. Get all supervisors names and the employees under them.
    function getSupervisorSupervisedRelations()
    {
        $connection = ConnectToDatabase();
        $results = null;
        try {
            # supervisedEmployees is a View
            $results = $connection->query("SELECT employees.Name, supervisedEmployees.Name
                                           FROM employees, supervisedEmployees
                                           WHERE employees.SIN = supervisedEmployees.SupervisorId
                                           ORDER BY employees.Name;");
            $connection = null;
        } catch (Exception $e) {
            return false;
        }
            return $results;
    }

    # 8. Get all the employee-department assignments
    function getEmployeesDepartments()
    {
        $connection = ConnectToDatabase();
        $results = null;
        try {
            $results = $connection->query("SELECT employees.Name, departments.Name 
                                          FROM employees, departments 
                                          WHERE employee.DepartmentNumber = department.Number;");
            $connection = null;
        } catch (Exception $e) {
            return false;
        }
        return $results;
    }


?>