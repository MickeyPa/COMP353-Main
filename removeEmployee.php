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
					deleteEmployee($_POST);
					break;
				case "Dependent":
					deleteDependent($_POST);
					break;
				case "Department":
					deleteDepartment($_POST);
					break;
				case "Location":
					deleteLocation($_POST);
					break;
				case "DepartmentLocation":
					deleteDepartmentLocation($_POST);
					break;
				case "Project":
					deleteProject($_POST);
					break;
				case "WorksOn":
					deleteWorksOn($_POST);
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
						echo "<option value=".$column.">";
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
						echo "<option value=".$column.">".$column."</option>";
				}
			}
			echo "</select></br>";
			break;
		  case "DepartmentLocation":
			$PDOresults = getDepartmentLocations();
            		echo "Department Location: <select name='SIN'>";
          		
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
            		echo "Works On: <select name='SIN'>";
          		
            		while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
			{
				foreach($row as $column)
				{
					$t++;
					if($t == 1)
						echo "<option value=".$column.">".$column."</option>";
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
