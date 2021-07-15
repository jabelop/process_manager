# Process Managment System
Web app for process managment. The system allows create, launch an stop processses, to the user on the browser.

#Requirements
Nginx or Apache (Nginx recommended) web server. An example of the nginx sites-available configuration file is included in the repository.
PHP 7.4, MariaDB 10.3.29

##Setup
- Install PHP 7.4 with all the Laravel requirements and the fpm module for Nginx.
- Install Nginx or Apache (Nginx exampleconfiguration is provided, but you can use it for making the correspondent Apache setup as well).
- Configure the apropiate configuration file inside "sites-availabe" folder under "/etc/nginx" path. The "default" file in the root app folder is an working example.
- Install MariaDB 10.3.29, and create a database and an user, those values will be used for the Laravel application configuration file.  
- Clone this repository on your local machine, and install the laravel required dependencies.
- Make a copy of the ".env.example" file, name it ".env" and fill with the right values for your installation for the database setup.
- run the migrations.
- run the seeder.

