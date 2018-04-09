		<?php
			include("DatabaseMethods.php");
			include("frontEnd.php");
		?>
		
		<form id="formE" method="post">
		Choose your query: <select id='query' name='query' onchange="ownQuery()">
		<option value="Select">Create your own query</option>
		<option value="EmployeeDependents">Get the names, genders, and dates of birth of all an employee's dependents</option>
		<option value="DepartmentManagers">Get all the department managers.</option>
		<option value="ProjectGroups">Get all the projects, the employees that are assigned to them, and the hours they've worked on those projects.</option>
		<option value="SupervisorNames">Get all Supervisors Names</option>
		<option value="SupervisedRelations">Get all supervisors names and the employees under them.</option>
		<option value="EmployeesDepartments">Get all the employee-department assignments</option>
		</select></br>
		<input type='text' size='100px' onclick="this.value=''" id='selectQuery' name='selectQuery' value="Enter your personnalized query here!"/></br>
		<input type='submit' value='Query'>
		</form>
		</br>
		<script>
		function ownQuery(){
		   var text = document.getElementById('selectQuery');
		   var options = document.getElementById('query');
           if(options.value == 'Select'){
			   text.style.visibility = 'visible';
			   text.value = "Enter your personnalized query here!";
			   text.size ='100';
		   }
		   else if(options.value == "EmployeeDependents"){
			   text.style.visibility = 'visible';
			   text.value = "Enter the SIN of an employee here!"
			   text.size ='30';
		   }
		   else
			   text.style.visibility = 'hidden';
		}
		</script>
		
		<?php
		if(isset($_POST['query'])){
			$PDOresults;
			switch($_POST['query']){
				case "Select":
					$PDOresults = sendSelectQuery($_POST['selectQuery']);
					break;
				case "EmployeeDependents":
					$PDOresults = getEmployeeDependents($_POST['selectQuery']);
					break;
				case "DepartmentManagers":
					$PDOresults = getDepartmentManagers();
					break;
				case "ProjectGroups":
					$PDOresults = getProjectGroups();
					break;
				case "SupervisorNames":
					$PDOresults = getSupervisorNames();
					break;
				case "SupervisedRelations":
					$PDOresults = getSupervisorSupervisedRelations();
					break;
				case "EmployeesDepartments":
					$PDOresults = getEmployeesDepartments();
					break;
			}
			echo "<table cellspacing='10px' border='1px solid black'>";
			while($PDOresults != NULL && $row = $PDOresults->fetch(PDO::FETCH_ASSOC))
			{
				echo "<tr>";
				foreach($row as $column)
				{
					echo "<td>".$column."</td>";
				}
				echo'</tr>';
			}
		}
		?>
	</body>
</html>
