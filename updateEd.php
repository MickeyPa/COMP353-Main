																																																																																																																											<?php
			include("DatabaseMethods.php");
			include("frontEnd.php");
		?>
		<form id="formE" method="post">
			<label><input type = "radio" name="table" value="Employee"/> Employee</label></br>
			<label><input type = "radio" name="table" value="Dependents"/> Dependent</label></br>
			<label><input type = "radio" name="table" value="Department"/> Department</label></br>
			<label><input type = "radio" name="table" value="Project"/> Project </label></br>
			<label><input type = "radio" name="table" value="WorksOn"/> Works On </label></br>
		</form>
		<script>
      			$(document).ready(function()
			{
        			$('input[type=radio][name=table]').change(function(){$(document.getElementById('formE')).submit();});
      			});
		
			function enable(){
				var form = document.getElementById('addingForm').elements;
				for(var x = 0; x < form.length ; x++){
					form[x].disabled = false;
				}
			}
		</script>	
		<?php
		if(isset($_POST['formName']))
		{
			echo $_POST['formName'];
			switch($_POST['formName'])
			{
				case "Employee":
					modifyEmployee($_POST);
					break;
				case "Dependent":
					modifyDependent($_POST);
					break;
				case "Department":
					modifyDepartment($_POST);
					break;
				case "Project":
					modifyProject($_POST);
					break;
				case "WorksOn":
					modifyWorksOn($_POST);
					break;
			}
		}
		if(isset($_POST['table']) || isset($_POST['formName']))
		{
			$TableType;
        		if(isset($_POST['table'])) 
				$TableType = $_POST['table'];
			else 
				$TableType = $_POST['formName'];
			$PDOresults;
        		echo "<form id='addingForm' method='post'>";
			echo "<input type='text' name='formName' value=".$TableType." hidden/>";
        switch($TableType){
          case "Employee":
		$PDOresults = getEmployees();
        	echo "SIN: <select> name='sin'>";		
		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
		{
			foreach($row as $column)
			{
				$t++;
				if($t == 1)
				{
					echo "<option value=".$column.">";
					echo $column."</option>";
				}
				if($t == 9)
					$t = 0;
			}
		}
		echo "</select></br>";
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
            	echo "</select>";
            	$PDOresults = getDepartmentsKeys();

            	echo "Department: <select name='DepartmentNumber'>";
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
        			echo "SIN: <input type='number' name='SIN'/></br>";
            	echo "Name: <input type='text' name='name'/></br>";
            	echo "Date Of Birth: <input type='date' name='dateofbirth'/></br>";
            	echo "Gender: <input type='text' name='gender'/></br>";
		$PDOresults = getEmployees();
            	echo "Guardian: <select name='guardianID'>";
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
            	echo "</select>";
            break;
            case "Department":
        			echo "Name: <input type='text' name='name'/></br>";
		$PDOresults = getEmployees();
            	echo "Manager: <select name='managerID'>";
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
            	echo "</select>";
            	echo "Start Date: <input type='date' name='startdate'/></br>";
            break;
            case "Location":
        			echo "Address: <input type='text' name='address'/></br>";
            break;
            case "DepartmentLocation":
        			$PDOresults = getLocationsKeys();
            	echo "Location: <select name='locationID'>";
          		
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									echo "<option value=$column> $column</option>";
								}
							}
            	echo "</select>";
		echo "Address: <input type='text' name='address'/></br>";
            break;
            case "Project":
				echo "Choose a tuple to update: <select name='tuple' onclick='enable()'>";
				$PDOresults = getProjects();
				$t = 0;
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									$t++;
									if($t == 1)
										echo "<option value=".$column.">".$column;
									if($t == 2)
										echo ": ".$column."</option>";
									if($t == 3){
										echo ": ".$column."</option>";
										$t = 0;
									}
								}
							}
            	echo "</select></br>";
        			echo "Id: <input type='number' name='id' disabled/></br>";
            	echo "Name: <input type='text' name='name' disabled/></br>";
		$PDOresults = getDepartmentLocations();
            	echo "Department Location: <select name='depLocation' disabled>";
          		$t = 0;
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									$t++;
									if($t == 1)
										echo "<option value=".$column.">";
									if($t == 2){
										echo $column."</option>";
										$t = 0;
									}
								}
							}
            	echo "</select>";
            break;
            case "WorksOn":
        			$PDOresults = getEmployees();
            	echo "Manager: <select name='managerID'>";
          		
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
            	echo "</select>";
		$PDOresults = getProjectsKeys();
            	echo "Project: <select name=projectID'>";
          		
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									echo "<option value=$column> $column</option>";
								}
							}
            	echo "</select>";
		echo "SIN: <input type='number' name='SIN'/></br>";
            break;
	
          default: echo "test2";
		}
		
		  echo "</br><input type='submit' value='Submit'>";
          echo "</form>";
      }
		?>
		
	</body>
</html>
