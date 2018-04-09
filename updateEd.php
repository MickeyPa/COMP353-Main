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
      			
					var form = document.getElementById('addingForm').elements;
					for(var x = 2; x < form.length ; x++){
						form[x].disabled = true;
					}
        			});
		
			function enable(){
				var form = document.getElementById('addingForm').elements;
				for(var x = 0; x < form.length ; x++){
					form[x].disabled = false;
				}
				placing();
			}
			
			function placing(){
				var form = document.getElementById('addingForm').elements;
				var tuple = document.getElementById('tuple').value;
				tuple = tuple.split("|");
				for(var x = 2; x < form.length-1 ; x++){
					form[x].value = tuple[x-2];
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
				case "Dependents":
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
			echo "Choose a tuple to update: <select id='tuple' name='tuple' onclick='enable()' onchange='placing()'>";
        switch($TableType){
          case "Employee":
		$PDOresults = getEmployees();	
		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
		{
			foreach($row as $column)
								{
									$t++;
									if($t == 1){
										$temp = $column;
										echo "<option value='".$column;
									}
									else if($t == 9){
										echo "|".$column."'>".$temp."</option>";
										$t = 0;
									}
									else
										echo "|".$column;
								}
		}
		echo "</select></br>";
        			echo "<input type='number' name='SIN' hidden/>";
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
				$PDOresults = getDependents();	
		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
		{
			foreach($row as $column)
								{
									$t++;
									if($t == 1){
										$temp = $column;
										echo "<option value='".$column;
									}
									else if($t == 5){
										echo "|".$column."'>".$temp."</option>";
										$t = 0;
									}
									else
										echo "|".$column;
								}
		}
		echo "</select></br>";
        			echo "<input type='number' name='SIN' hidden/>";
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
            	echo "</select>";
            break;
            case "Department":
			$PDOresults = getDepartments();	
		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
		{
			foreach($row as $column)
								{
									$t++;
									if($t == 1){
										$temp = $column;
										echo "<option value='".$column;
									}
									else if($t == 4){
										echo "|".$column."'>".$temp."</option>";
										$t = 0;
									}
									else
										echo "|".$column;
								}
		}
		echo "</select></br>";
		echo "<input type='number' name='Number' hidden/>";
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
				
				$PDOresults = getProjects();
				$t = 0;
            	while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
							{
								foreach($row as $column)
								{
									$t++;
									if($t == 1){
										$temp = $column;
										echo "<option value='".$column;
									}
									if($t == 2)
										echo "|".$column;
									if($t == 3){
										echo "|".$column."'>".$temp."</option>";
										$t = 0;
									}
								}
							}
            	echo "</select></br>";
        			echo "<input type='number' name='Id' hidden/>";
            	echo "Name: <input type='text' name='Name'/></br>";
				echo "Address: <select name='Address'>";
				$PDOresults = getLocations();
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
				$PDOresults = getWorksOn();
				while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
				{
					foreach($row as $column)
								{
									$t++;
									if($t == 1){
										$temp = $column;
										echo "<option value='".$column;
									}
									else if($t == 2){
										$temp2 = $column;
										echo "|".$column;
									}
									else if($t == 3){
										echo "|".$column."'>Employee ".$temp.": Project ".$temp2."</option>";
										$t = 0;
									}
								}
				}
				echo "</select></br>";
				echo "<input type='number' name='Employee' hidden/>";
				echo "<input type='number' name='ProjectId' hidden/>";
				echo "<input type='number' name='HoursWorked' /></br>";
            break;
	
          default: echo "test2";
		}
		
		  echo "</br><input type='submit' value='Submit'>";
          echo "</form>";
      }
		?>
		
	</body>
</html>
