## Database Auto Backup ##

#### File Structure ####
In backup_and_restore Folder
- DBBackup.php
- DBRestore.php
- connection.php

In Root Folder
- schedule.bat


## Settings To change ##
- change the value of  **$host**, **$db\_name**, **$db\_user**  and **$db\_pass**
	<br /> `$host = '192.168.100.45'`<br /> 
	`$db_name = 'attendance'; `<br />
	`$db_user = 'root'; `<br/>
	`$db_pass = 'password';`  
according to your database configuration in **connection.php**
- In schedule.bat (default  `php D:\std\backup_and_restore\DBBackup.php`) change the Absolute path of DBBackup.php as per your folder structure
- If php isn't set in environment variables then set php in [environment variables](https://msdn.microsoft.com/en-us/library/windows/desktop/ms682653(v=vs.85).aspx "Environment Variables") or you can provide full path of php
   
- ----------

## Setting up scheduler ##


1. Go to window [task scheduler](https://msdn.microsoft.com/en-us/library/windows/desktop/aa383614(v=vs.85).aspx "Window Task Scheduler") and add schedule.bat file in the script
2. select the time in which you want to run scheduler
3. set other value if required


##Restoring The Database ##
Since the database take full backup until last point of time it has been schedule. Restoring can be done by using Admin panel.

- Login with your administrative Credentials
- In top menu setting/backup and recovery you can choose the period from which you want to restore the database