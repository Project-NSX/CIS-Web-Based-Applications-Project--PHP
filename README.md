# CIS-Web-Based-Applications-Project--PHP
 CIS - Year 3 - Web-Based Applications Assignment Project.<br />
 The project uses HTML, CSS, PHP, MySQL and Bootstrap to deliver a prototype of a storefront. Interfaces with a database to deliver dynamic content.
## Project Description
Notes about this project:
- The assignment breifs for this project can be found in the "ASSIGNMENT FILES" folder, along with the zipped code for each of the submissions, screenshots of the project, and a backup of the SQL database developed for the project. 
- The Assignment-Briefs.pdf file describes the requirements for each of the three assignment submissions.
- The "Assignment Submissions" folder contains zip files that contain the required code for each submission. These are essentially snap shots of the code at the time of submission for each assignment.
- The "Final Project Screenshots" folder contains screenshots of the final application.
- The "SQL-TABLES-DUMP" folder contains a backup of the SQL tables that are required for the project to run.

## Database Information
This section contains information regarding the database that was developed as part of this application. I begin with designing the database and then move onto providing the code I used to create the database.
### Database Design
Database Table Structure:<br /><br />

Product<br />
	productID<br />
	productName<br />
	Image<br />
	shortDescription<br />
	longDescription<br />
	Price <br />
	<br /><br />
User<br />
	userID<br />
	fName<br />
	lName<br />
	Email<br />
	Password<br />
	deliveryAddress<br />
	billingAddress<br /><br />
	
Order<br />
	orderID<br />
	orderDate<br />
	userID (FK REFERENCES User(userID))<br /><br />
	
Product Order<br />
	productID (FK REFERENCES Product(productID)<br />
	orderID (FK REFERENCES Order(orderID)<br />
    Quantity<br /><br />

Options for payment method:
- Save card details (cardName, cardNo, expiraryDate) to User and select paymentMethod at Order stage.
- Enter all payment details at checkout and save to Order.

### SQL Used To Create Database
#### Create Tables
CREATE TABLE Product<br />
(<br />
	productID INT UNSIGNED NOT NULL AUTO_INCREMENT, <br />
	productName VARCHAR (128),<br />
	image BLOB, <br />
	description VARCHAR(128) NOT NULL,<br />
	PRIMARY KEY (productID)<br />
);<br />

CREATE TABLE Customer<br />
(<br />
	customerID INT UNSIGNED NOT NULL AUTO_INCREMENT,<br />
    fName VARCHAR(128),<br />
    lName VARCHAR(128),<br />
    email VARCHAR(255),<br />
    password VARCHAR(128),<br />
    deliveryAddress VARCHAR(512),<br />
    billingAddress VARCHAR(512),<br />
    PRIMARY KEY (customerID)<br />
);<br /><br />

CREATE TABLE CustomerOrder<br />
(<br />
	orderID INT UNSIGNED NOT NULL AUTO_INCREMENT, <br />
    orderDate DATETIME,<br />
	PRIMARY KEY (orderID)<br />
);<br /><br />

CREATE TABLE ProductOrder<br />
(<br />
	productID INT UNSIGNED NOT NULL,<br />
	orderID INT UNSIGNED NOT NULL, <br />
	PRIMARY KEY (productID, orderID),<br />
	FOREIGN KEY (productID)<br />
		REFERENCES Product(productID)<br />
		ON DELETE RESTRICT ON UPDATE CASCADE,<br />
	FOREIGN KEY (orderID)<br />
		REFERENCES CustomerOrder(orderID)<br />
		ON DELETE CASCADE ON UPDATE CASCADE<br />
);

#### Inserting Test Data
INSERT INTO customer <br />
(fName, lName, eMail, password, deliveryAddress, billingAddress)<br />
VALUES<br />
(<br />
	"Charlie", <br />
    "Francis", <br />
    "CFrancis@gmail.com", <br />
    "charliepass", <br />
    "10 Charlie's street, Charlietown, RH55 6BB",<br />
    "10 Charlie's street, Charlietown, RH55 6BB"<br />
),	<br />
(<br />
	"Walter", <br />
    "Bishop", <br />
    "WBishop@gmail.com", <br />
    "walterpass", <br />
    "Best lab in Harvard, Harvard University, FH33 6SJ",<br />
    "Best lab in Harvard, Harvard University, FH33 6SJ"<br />
),<br />
(<br />
	"Peter", <br />
    "Bishop", <br />
    "ThisIsMyShow@BestGuyEver.com", <br />
    "veryimportantperson101", <br />
    "Best lab in Harvard, Harvard University, FH33 6SJ",<br />
    "Best lab in Harvard, Harvard University, FH33 6SJ"<br />
);<br /><br />


INSERT INTO product <br />
(productName, description)<br />
VALUES<br />
(<br />
	"Chamoizon Basics Ladder", <br />
    "Chamizon Basics Ladder is a basic ladder that should probably get the job done. Suitable for light work or it might break."<br />
),<br />
(<br />
	"Premium Ladder + Free Bloke", <br />
    "Premium ladder made of high quality stainless steel. Suitable for all jobs around the home such as cleaning windows. Strong but lightweight, as is the bloke that comes with the ladder. The bloke provided can clean up to 300 windows an hour, provided sufficient amounts of coffee are supplied."<br />
),<br />
(<br />
	"Chamoizon Chamoise Leather",<br /> 
    "Basic Chamoise Leather thats good for cleaning windows and stuff. Should work alright as long as you don't put too much pressure on while cleaning and break the window. Bits of broken glass may have an adverse affect on product"<br />
),<br />
(<br />
	"Cheapo Telescopic Ladder", <br />
    "Telescopic ladder that only collapses 20% of the time while in use. Please ensure you have a good amount of medical care available before using."<br />
),<br />
(<br />
	"Chamoizon Basics Squeegee", <br />
    "Basic squeegee, guarenteed to make a funny noise when cleaning your windows."<br />
);<br />