		<?php
			include("COMP353-Main/DatabaseMethods.php");
			include("COMP353-Main/frontEnd.php");
		?>
		<form id="form" method="post">
			<label><input type = "radio" name="table" value="Employee"/> Employee</label></br>
			<label><input type = "radio" name="table" value="Dependents"/> Dependent</label></br>
			<label><input type = "radio" name="table" value="Department"/> Department</label></br>
			<label><input type = "radio" name="table" value="Location"/> Location</label></br>
			<label><input type = "radio" name="table" value="DepartmentLocation"/> Department Location </label></br>
			<label><input type = "radio" name="table" value="Project"/> Project </label></br>
      <label><input type = "radio" name="table" value="WorksOn"/> Works On </label></br>
		</form>
		<script>
      $(document).ready(function() {
        $('input[type=radio][name=table]').change(function(){
                                           $('form').submit();
                                           });
      });
      
      //SIN, Name, DateOfBirth, Gender, Address, PhoneNumber, 
//Salary, SupervisorId, DepartmentNumber
	</script>
		<?php
			if(isset($_POST['table'])){
        $PDOresults;
        echo "<form>";
        switch($_POST['table']){
          case "Employee":
        	echo "SIN: <input type='number' name='SIN'/></br>";
            	echo "Name: <input type='text' name='name'/></br>";
            	echo "Date Of Birth: <input type='date' name='dateofbirth'/></br>";
            	echo "Gender: <input type='text' name='gender'/></br>";
            	echo "Employee: <input type='radio' name='employee'/></br>";
            	echo "Address: <input type='text' name='address'/></br>";
            	echo "Phone Number: <input type='number' name='PhoneNumber'/></br>";
            	echo "Salary: <input type='number' name='salary'/></br>";
		$PDOresults = getEmployeesKeys();
            	echo "<select name='supervisorID'>";
          		
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									echo "<option value=$column> $column</option>";
								}
							}
            	echo "</select>";
            	$PDOresults = getDepartmentsKeys();

            	echo "<select name='DepartmentNumber'>";
           		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									echo "<option value=$column> $column</option>";
								}
							}
            	echo "</select>";
            break;
            
            
            case "Dependents":
        			echo "<form><input type='number' name='SIN'/></br>";
            break;
            case "Employee":
        			echo "<form><input type='number' name='SIN'/></br>";
            break;
            case "Employee":
        			echo "<form><input type='number' name='SIN'/></br>";
            break;
            case "Employee":
        			echo "<form><input type='number' name='SIN'/></br>";
            break;
            case "Employee":
        			echo "<form><input type='number' name='SIN'/></br>";
            break;
            case "Employee":
        			echo "<form><input type='number' name='SIN'/></br>";
            break;
	
          default: echo "test2";
          echo "</form>";
}
      }
		?>
	</body>
</html>
