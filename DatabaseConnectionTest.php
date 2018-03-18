
<?php
	$servername = "ryc353.encs.concordia.ca";
	$dbname = "ryc353_4";
	$username = "ryc353_4";
	$password = "353winte";

	#Using PDO

	$connection = new PDO("mysql:host=$servername;dbname=$dbname", $username,$password);
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$PDOresults = $connection->query("select * from employees;");

	while($row = $PDOresults->fetch(PDO::FETCH_ASSOC)){
		foreach($row as $column){
			echo $column." ";
		}
		echo'<br/>';
	}
?>
