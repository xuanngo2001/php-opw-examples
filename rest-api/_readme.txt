# Before running the commands below.
#   Ensure that the credentials are correct in ./rest-api/database.php.
#   Change -uroot2 and -ppassword according to your setup.

# Copy PHP files to /var/www/html/.
    yes | cp -av ./rest-api /var/www/html/

# Destroy and build database.
    mysql -uroot2 -ppassword -e "DROP DATABASE rest_api_db"
    mysql -uroot2 -ppassword -e "CREATE DATABASE rest_api_db"

# Create employee table.
	mysql -uroot2 -ppassword rest_api_db -e "CREATE TABLE employee(id INTEGER PRIMARY KEY AUTO_INCREMENT, name TEXT, role TEXT);"

# Post json data
    curl -X POST -H "Content-Type: application/json" -d '{ "name":"abc", "role":"role" }' http://localhost/rest-api/create.php
    curl -X POST -H "Content-Type: application/json" -d @data.json  http://localhost/rest-api/create.php
    
    curl -X GET http://localhost/rest-api/read.php


######################################### Optional
# Run if new mysql instance is installed to create root2 user.
    mysql -uroot -ppassword -e "CREATE USER 'root2'@'localhost' IDENTIFIED BY 'password'; GRANT ALL PRIVILEGES ON *.* TO 'root2'@'localhost' WITH GRANT OPTION; FLUSH PRIVILEGES;"
    mysql -uroot -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root2'@'localhost' WITH GRANT OPTION; FLUSH PRIVILEGES;"

    # Run FLUSH PRIVILEGES; to see if user table need repair: mysqlcheck --repair --all-databases

