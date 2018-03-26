<?php


     function ConnectToDatabase()
    {
        $servername = "ryc353.encs.concordia.ca";
        $dbname = "ryc353_4";
        $username = "ryc353_4";
        $password = "353winte";

        #Using PDO
        try {
            $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully <br/>";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        return $connection;
    }

    #1: Which student(s) is not a member of any team?
    function getStudentsNotInATeam()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT students.SID FROM students
                                  WHERE students.SID NOT IN (SELECT members.SID FROM members);");
        $connection = null;
        return $results;
    }

    #2: For each team, list its members.
     function getListOfMembersOnTeams()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT teams.TID, students.SID, students.Name FROM teams, students, members 
                                  WHERE members.TID = teams.TID AND members.SID = students.SID
                                  ORDER BY teams.TID ASC;");
        $connection = null;
        return $results;
    }

    #3: Who was not present in the demo of a team?
     function getStudentsNotInDemos()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT students.Name from students, teams
                                  WHERE students.SID IN (SELECT members.SID FROM members WHERE members.TID = teams.TID)
                                  AND students.SID NOT IN (SELECT demos.SID FROM demos WHERE demos.TID = teams.TID);");
        $connection = null;
        return $results;
    }

    #4: List the teams which have less than four members.
     function getTeamsWithLessThanFourMembers()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT teams.TID FROM teams WHERE teams.NoOfMembers < 4;");
        $connection = null;
        return $results;
    }

    #5: Given a TID, list the names of the members
    #$teamID is an integer
     function getListOfTeamMembers($teamID)
    {
        $connection = ConnectToDatabase();
	try
	{
		$results = $connection->query("SELECT students.Name FROM students, members
                                  WHERE students.SID = members.SID AND members.TID = $teamID;");
	}
	catch(Exception $e)
	{
		echo "Invalid input";
	}	
        $connection = null;
        return $results;
    }

    #6: Given a date, list all of the teams that have demos on that day.
    #$date is formatted YYYY-MM-DD
     function getTeamsWhoHaveDemos($date)
    {
        $connection = ConnectToDatabase();
	try{
        $results = $connection->query("SELECT DISTINCT demos.TID FROM demos WHERE demos.Day = '$date';");
	}
	catch(Exception $e)
	{
		echo "Invalid input";
	}	
        $connection = null;
        return $results;
    }

    #7: For each teams that is not complete (<4 members), list the TID and its capacity to increase.
     function getTeamsCapacityToIncrease()
    {
        $connection = ConnectToDatabase();
        $results = $connection->query("SELECT teams.TID, (4-teams.NoOfMembers) FROM teams WHERE teams.NoOfMembers < 4;");
        $connection = null;
        return $results;
    }

    #8: Given a student's name or ID, find their team ID.
    #$student is an integer or a string
     function getTeamIdByStudent($student)
    {
        	$connection = ConnectToDatabase();
        	if (is_numeric($student))
		{
			$student = (int) $student;
            		$results = $connection->query("SELECT members.TID FROM members WHERE members.SID = $student;");
        	} 
		else 
		{
			$student = (string) $student;
            		$results = $connection->query("SELECT members.TID FROM members, students 
                                      WHERE members.SID = students.SID AND students.Name = '$student';");
        	}
	
        	$connection = null;
        	return $results;
    }

    #9: Given a student's name or ID, find their teammates names and IDs.
    #$student is an integer or a string
    function getTeammatesByStudent($student)
    {
        $connection = ConnectToDatabase();
	try{
        if (is_numeric($student)) 
	{
		$student = (int) $student;
            	$results = $connection->query("SELECT members.SID, students.Name FROM members, students 
                                      WHERE members.SID = students.SID AND 
                                      members.TID IN (SELECT members.TID FROM members WHERE members.SID = $student);");
        } else {
		$student = (string) $student;
            $results = $connection->query("SELECT members.SID, students.Name FROM members, students 
                                      WHERE members.SID = students.SID AND 
                                      members.TID IN (SELECT members.TID FROM members 
                                                      WHERE members.SID IN (SELECT students.SID from students 
                                                                            WHERE students.Name = '$student'));");
        }
}
	catch(Exception $e)
	{
		echo "Invalid input";
	}	
        $connection = null;
        return $results;
    }

?>
