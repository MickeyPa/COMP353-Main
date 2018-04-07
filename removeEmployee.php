		<?php
			include("DatabaseMethods.php");
			include("frontEnd.php");
		?>
		<?php
			$PDOresults = getEmployees();
			echo "<form method='post'>";
            		echo "Employee: <select name='employees'>";
          		
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
			echo "<input type='submit' value='Submit'>";
			echo "</form>";
		?>
		<?php
			if (isset($_POST['employees'])) 
			{
    				$result = deleteEmployee(intval($_POST['employees']));
			}
		?>
