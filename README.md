Introduction and solution:
The problem is solved using PHP and MySQL. The code connects to a  given database, and queries all the users. 
The users are inserted into an array, which is then serialized (https://www.php.net/manual/en/function.serialize.php).

A file is created called "databasePull.txt" and the serialized data is written to the file. In order to test whether the queried data matches,
the database before it is wiped, the program reads from the databasePull.txt file, and compares if there's any differences using strcmp (https://www.php.net/manual/en/function.strcmp.php)

If there's no difference between the database values and the stored data, the data from the database is deleted. 

How to use:
1. Create a database called "interview_assignment. I used XAMPP for this. 
2. Import the sqldump.sql file into the database. 
3. Visit the index.php site. localhost/interview-assignment or localhost/interview-assignment/index.php in my case.

If the program says success the data was successfully verified and saved to a filed called "databasePull.txt", located in the same directory as index.php.

Notes:
As noted in the code, it was unclear whether the users should be deleted, or the table should be dropped. The code currently only removed all users, but I've included a query that deletes
the table as well, reference line 54 in the code.

Repo link:
https://github.com/DanielLaursen/20200331 
