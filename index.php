<?php
// Create connection
$connection = mysqli_connect("localhost", "root","", "interview_assignment");

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

//Query users db
$queryDatabase = "SELECT * FROM users";
$queryDatabaseResult = $connection->query($queryDatabase);

//Check if query is functional
if (!$queryDatabaseResult) {
		die("Unable to query database. Select query.");
}

//Fetch every row and put it in array record[]
while ($row = mysqli_fetch_assoc($queryDatabaseResult)) {
	$record[] = $row;
}

//Check if any users are stored in the $record[], if not no users are in stored in the database
if (empty($record)) {
	die("Unable to proceed. No users stored in database.");
}

//Convert data to storable representations. To undo this use unserialize()
$recordSerialized = serialize($record);

//FILE MANAGEMENT
$filename = "databasePull.txt";

//Create file to store database in, and store serialized data in file
$fileWrite = fopen($filename, "w") or die("Unable to write file");
fwrite($fileWrite, $recordSerialized);
fclose($fileWrite);

//Read from stores file
$fileRead = fopen($filename, "r") or die ("Unable to read file");
$fileReadResult = fread($fileRead,filesize($filename));
fclose($fileRead);

//Binary safe string comparasion
$diff = strcmp($recordSerialized, $fileReadResult);

//Check if data in file equals database data
if ($diff !== 0) {
	echo "Cannot proceed. Database mismatch.";
}
else{
	//Delete all users from the database
	//NOTE - It was unclear from the problem description whether the table should be deleted, or just the user data use the following query to delete the entire table: "DROP TABLE users"
	$queryDelete = "DELETE FROM users";
	$queryDeleteResult = $connection->query($queryDelete);
	//If unable to delete users, let the user know.
	if (!$queryDeleteResult) {
		die("Unable to query database. Delete query.");
	}
	else{
		echo "Success";
	}
}

?>