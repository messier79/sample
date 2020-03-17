To install, follow these steps :
- Clone the repo on a server with Apache/Nginx + PHP 7+ + mySQL
- Create a database and create the structure with the script provided in the migrations directory
- Set the proper database config in Config/Config.php
- Open index.php to display the page
- Open tests.php to open the Unit Tests result page

NOTE : I've made one change to the specs : by default, I don't show the form, as the main info is the list of Users.
To open the form, use the button on top of the page.

Frameworks/libraries used :
- jQuery 3.1.0
- jQuery UI 1.12.1
- Bootstrap 4.1.3