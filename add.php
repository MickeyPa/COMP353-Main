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
			<input type="submit" value="Submit">

		</form>
		<script>
      $("document").ready(function() {
        $( "input[type=radio][name=table]" ).change(function(){
                                           $("form").submit();
                                           });
      });
	</script>
		<?php
			if(isset($_POST['table'])){
        switch($_POST['table']){
          case "Employee":
        			echo "test1"; break;
	
          default: echo "test2";
}
      }
		?>
	</body>
</html>
