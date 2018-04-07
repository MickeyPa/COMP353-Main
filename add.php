																																																																																																																											<?php
			include("DatabaseMethods.php");
			include("frontEnd.php");
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
		</script>
	
		<?php
		if(isset($_POST['address'])){
			echo $_POST['addingForm'];
		}
			if(isset($_POST['table']) || isset($_POST['addingForm'])){
        $PDOresults;
        echo "<form id='addingForm' method='post'>";
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
		$PDOresults = getEmployees();
            	echo "Supervisor: <select name='supervisorID'>";
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
        			echo "Id: <input type='number' name='id'/></br>";
            	echo "Name: <input type='text' name='name'/></br>";
		$PDOresults = getDepartmentLocations();
            	echo "Department Location: <select name='depLocation'>";
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
		
		  echo "<input type='submit' value='Submit'>";
          echo "</form>";
      }
		?>
		
	</body>
</html>
