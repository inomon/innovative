# The name of the project 
# propel.project = [Your-Project-Name]
propel.project = ###PROPEL_PROJECT###
 
# The database driver 
# propel.database = pgsql|mysql|sqlite|mssql|oracle
propel.database = ###PROPEL_DATABASE###

# The connection parameters (optional, but required if you want to initialize db)
# This is the PDO DSN (see online docs http://www.php.net/pdo for more info)
propel.database.url = ###PROPEL_DATABASE_URL###
# Other examples:
# propel.database.url = mysql:host=localhost;dbname=test
# propel.database.url = pgsql:host=localhost dbname=db-name user=db-username password=db-password
# If you are using MySQL or Oracle, you will have to specify any username and password separately
propel.database.user = ###PROPEL_DATABAS_USER###
propel.database.password = ###PROPEL_DATABASE_PASSWORD###

# Output directories
propel.php.dir = ###PROPEL_PHP_DIR###
propel.phpconf.dir = ###PROPEL_PHPCONF_DIR###
propel.sql.dir = ###PROPEL_SQL_DIRE###
