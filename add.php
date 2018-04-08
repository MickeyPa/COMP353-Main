																																																																																																																											<?php
			include("DatabaseMethods.php");
			include("frontEnd.php");
		?>
		<form id="formE" method="post">
			<label><input type = "radio" name="table" value="Employee"/> Employee</label></br>
			<label><input type = "radio" name="table" value="Dependent"/> Dependent</label></br>
			<label><input type = "radio" name="table" value="Department"/> Department</label></br>
			<label><input type = "radio" name="table" value="Location"/> Location</label></br>
			<label><input type = "radio" name="table" value="DepartmentLocation"/> Department Location </label></br>
			<label><input type = "radio" name="table" value="Project"/> Project </label></br>
			<label><input type = "radio" name="table" value="WorksOn"/> Works On </label></br>
		</form>
		<script>
      $(document).ready(function() {
        $('input[type=radio][name=table]').change(function(){
                                           $(document.getElementById('formE')).submit();
                                           });
      });
		</script>
	
		<?php
		if(isset($_POST['formName'])){
			echo $_POST['formName'];
			switch($_POST['formName']){
				case "Employee":
					addEmployee($_POST);
					break;
				case "Dependent":
					addDependent($_POST);
					break;
				case "Department":
					addDepartment($_POST);
					break;
				case "Location":
					addLocation($_POST);
					break;
				case "DepartmentLocation":
					addDepartmentLocation($_POST);
					break;
				case "Project":
					addProject($_POST);
					break;
				case "WorksOn":
					addWorksOn($_POST);
					break;
			}
		}
			if(isset($_POST['table']) || isset($_POST['formName'])){
		$TableType;
        if(isset($_POST['table'])) $TableType = $_POST['table'];
		else $TableType = $_POST['formName'];
		$PDOresults;
        echo "<form id='addingForm' method='post'>";
		echo "<input type='text' name='formName' value=".$TableType." hidden/>";
        switch($TableType){
          case "Employee":
        	echo "SIN: <input type='number' name='SIN'/></br>";
            	echo "Name: <input type='text' name='Name'/></br>";
            	echo "Date Of Birth: <input type='date' name='DateOfBirth'/></br>";
            	echo "Gender: <input type='text' name='Gender'/></br>";
            	echo "Address: <input type='text' name='Address'/></br>";
            	echo "Phone Number: <input type='number' name='PhoneNumber'/></br>";
            	echo "Salary: <input type='number' name='Salary'/></br>";
		$PDOresults = getEmployees();
            	echo "Supervisor: <select name='SupervisorId'>";
          	$t = 0;
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
		{
			foreach($row as $column)
			{
				$t++;
				if($t == 1)
					echo "<option value=".$column.">";
				if($t == 2)
					echo $column."</option>";
				if($t == 9)
					$t = 0;
			}
		}
            	echo "</select></br>";
            	$PDOresults = getDepartmentsKeys();

            	echo "Department: <select name='DepartmentNumber'>";
           		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									echo "<option value=$column> $column</option>";
								}
							}
            	echo "</select></br>";
            break;
            
            
            case "Dependent":
        			echo "SIN: <input type='number' name='SIN'/></br>";
            	echo "Name: <input type='text' name='Name'/></br>";
            	echo "Date Of Birth: <input type='date' name='DateOfBirth'/></br>";
            	echo "Gender: <input type='text' name='Gender'/></br>";
		$PDOresults = getEmployees();
            	echo "Guardian: <select name='Guardian'>";
          		$t = 0;
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									$t++;
									if($t == 1)
										echo "<option value=".$column.">";
									if($t == 2)
										echo $column."</option>";
									if($t == 9)
										$t = 0;
								}
							}
            	echo "</select></br>";
            break;
            case "Department":
					echo "Number: <input type='number' name='Number'/></br>";
        			echo "Name: <input type='text' name='Name'/></br>";
		$PDOresults = getEmployees();
            	echo "Manager: <select name='Manager'>";
          		$t = 0;
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									$t++;
									if($t == 1)
										echo "<option value=".$column.">";
									if($t == 2)
										echo $column."</option>";
									if($t == 9)
										$t = 0;
								}
							}
            	echo "</select></br>";
            	echo "Start Date: <input type='date' name='StartDate'/></br>";
            break;
            case "Location":
        			echo "Address: <input type='text' name='Address'/></br>";
            break;
            case "DepartmentLocation":
				echo "Department Number: <input type='number' name='DepartmentNumber'/></br>";
        			$PDOresults = getLocationsKeys();
            	echo "Location: <select name='Address'>";
          		
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									echo "<option value='".$column."'> $column</option>";
								}
							}
            	echo "</select></br>";
            break;
            case "Project":
        			echo "Id: <input type='number' name='Id'/></br>";
            	echo "Name: <input type='text' name='Name'/></br>";
				$PDOresults = getLocations();
            	echo "Address: <select name='Address'>";
          		$t = 0;
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									echo "<option value='".$column."'>".$column."</option>";
								}
							}
            	echo "</select></br>";
            break;
            case "WorksOn":
        			$PDOresults = getEmployees();
            	echo "Employee: <select name='Employee'>";
          		
            	$t = 0;
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									$t++;
									if($t == 1)
										echo "<option value=".$column.">";
									if($t == 2)
										echo $column."</option>";
									if($t == 9)
										$t = 0;
								}
							}
            	echo "</select></br>";
				$PDOresults = getProjectsKeys();
            	echo "Project: <select name='ProjectId'>";
          		
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									echo "<option value=$column>$column</option>";
								}
							}
            	echo "</select></br>";
				echo "Hours Worked: <input type='number' name='HoursWorked'/></br>";
            break;
	
          default: echo "test2";
		}
		
		  echo "<input type='submit' value='Submit'>";
          echo "</form>";
      }
		?>
		
	</body>
</html>
