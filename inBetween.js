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
if(isset($_POST['submit']))
{
   display();
} 
?>
