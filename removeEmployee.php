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
			$working;
			switch($_POST['formName']){
				case "Employee":
					$working = deleteEmployee($_POST);
					break;
				case "Dependent":
					$working = deleteDependent($_POST);
					break;
				case "Department":
					$working = deleteDepartment($_POST);
					break;
				case "Location":
					$working = deleteLocation($_POST);
					break;
				case "DepartmentLocation":
					$working = deleteDepartmentLocation($_POST['Values']);
					break;
				case "Project":
					$working = deleteProject($_POST);
					break;
				case "WorksOn":
					$working = deleteWorksOn($_POST['Values']);
					break;
			}
			if($working)
				echo "The tuple was successfuly deleted.";
			else
				echo "There was an error deleting the tuple. Please try again.";
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
			$PDOresults = getEmployees();
            		echo "Employee: <select name='SIN'>";
          		
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
		  case "Dependent":
			$PDOresults = getDependents();
            		echo "Dependents: <select name='SIN'>";
          		
            		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
			{
				foreach($row as $column)
				{
					$t++;
					if($t == 1)
						echo "<option value='$column'>";
					if($t == 2)
						echo $column."</option>";
					if($t == 5)
						$t = 0;
				}
			}
			echo "</select></br>";
			break;
		  case "Department":
			$PDOresults = getDepartments();
            		echo "Department: <select name='Number'>";
          		
            		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
			{
				foreach($row as $column)
				{
					$t++;
					if($t == 1)
						echo "<option value=".$column.">";
					if($t == 2)
						echo $column."</option>";
					if($t == 4)
						$t = 0;
				}
			}
			echo "</select></br>";
			break;
		  case "Location":
			$PDOresults = getLocations();
            		echo "Location: <select name='Address'>";
          		
            		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
			{
				foreach($row as $column)
				{
						echo "<option value='".$column."'>".$column."</option>";
				}
			}
			echo "</select></br>";
			break;
		  case "DepartmentLocation":
			$PDOresults = getDepartmentLocations();
            		echo "Department Location: <select name='Values'>";
          		
            		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
			{
				foreach($row as $column)
				{
					$t++;
					
					if($t == 1){
						echo "<option value='".$column;
						$temp = $column;
					}
					if($t == 2){
					echo "|".$column."'>".$temp.": ".$column."</option>";
						$t = 0;
					}
				}
			}
			echo "</select></br>";
			break;
		  case "Project":
			$PDOresults = getProjects();
            		echo "Project: <select name='Id'>";
          		
            		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
			{
				foreach($row as $column)
				{
					$t++;
					if($t == 1)
						echo "<option value=".$column.">";
					if($t == 2)
						echo $column."</option>";
					if($t == 3)
						$t = 0;
				}
			}
			echo "</select></br>";
			break;
		  case "WorksOn":
			$PDOresults = getWorksOn();
            		echo "Works On: <select name='Values'>";
          		
            		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
			{
				foreach($row as $column)
				{
					$t++;
					if($t == 1){
						echo "<option value='".$column;
						$temp = $column;
					}
					if($t == 2)
						echo "|".$column."'>".$temp.": ".$column."</option>";
					if($t == 3)
						$t = 0;
				}
			}
			echo "</select></br>";
			break;
		}
			echo "<input type='submit' value='Submit'>";
			echo "</form>";
		}
		?>

			</body>
</html>
