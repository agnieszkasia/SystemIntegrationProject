# System Integration Web Application
Web application that processes data from txt files, xml files and database, and using SOAP webservices.
	
## Technologies
Project is created with:
* PHP 7.3
* Bootstrap 4
* XAMPP Apache server
* MySQL database
* NuSOAP Library
	
## Installation
To run this project:

* Download project
* Put project folder (projekt1) inside htdocs folder (path is something like this C:\xampp\htdocs)
* Start the Apache server in the XAMPP Control Panel
* Go to the browser and type in URL field: localhost/projekt1/index.php

## Application functionality
* Import data from TXT file
* Export data to TXT file
* Import data from XML file
* Export data to XML file
* Import data database
* Export data database
* Read and edit data
* Count and show number of duplicates and new rows
* Return webService with the number of records in the database filtered on the basis of the manufacturer provided by the customer
* Return webService with data from the database filtered on the basis of the screen type provided by the customer
* Return webService with the number of laptops with a given screen proportion (e.g. 16x9, 16x10)
