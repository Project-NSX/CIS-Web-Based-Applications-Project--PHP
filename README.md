# CIS-Web-Based-Applications-Project--PHP
 CIS - Year 3 - Web-Based Applications Assignment Project. 
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
Database Table Structure:

Product
	productID
	productName
	Image
	shortDescription
	longDescription
	Price 
	
User
	userID
	fName
	lName
	Email
	Password
	deliveryAddress
	billingAddress
	
	
Order
	orderID
	orderDate
	userID (FK REFERENCES User(userID))
	
Product Order
	productID (FK REFERENCES Product(productID)
	orderID (FK REFERENCES Order(orderID)
    Quantity

Options for payment method:
- Save card details (cardName, cardNo, expiraryDate) to User and select paymentMethod at Order stage
- Enter all payment details at checkout and save to Order.

### SQL Used To Create Database
#### Create Tables
CREATE TABLE Product
(
	productID INT UNSIGNED NOT NULL AUTO_INCREMENT, 
	productName VARCHAR (128),
	image BLOB, 
	description VARCHAR(128) NOT NULL,
	PRIMARY KEY (productID)
);

CREATE TABLE Customer
(
	customerID INT UNSIGNED NOT NULL AUTO_INCREMENT,
    fName VARCHAR(128),
    lName VARCHAR(128),
    email VARCHAR(255),
    password VARCHAR(128),
    deliveryAddress VARCHAR(512),
    billingAddress VARCHAR(512),
    PRIMARY KEY (customerID)
);

CREATE TABLE CustomerOrder
(
	orderID INT UNSIGNED NOT NULL AUTO_INCREMENT, 
    orderDate DATETIME,
	PRIMARY KEY (orderID)
);

CREATE TABLE ProductOrder
(
	productID INT UNSIGNED NOT NULL,
	orderID INT UNSIGNED NOT NULL, 
	PRIMARY KEY (productID, orderID),
	FOREIGN KEY (productID)
		REFERENCES Product(productID)
		ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (orderID)
		REFERENCES CustomerOrder(orderID)
		ON DELETE CASCADE ON UPDATE CASCADE
);


#### Inserting Test Data
INSERT INTO customer 
(fName, lName, eMail, password, deliveryAddress, billingAddress)
VALUES
(
	"Charlie", 
    "Francis", 
    "CFrancis@gmail.com", 
    "charliepass", 
    "10 Charlie's street, Charlietown, RH55 6BB",
    "10 Charlie's street, Charlietown, RH55 6BB"
),	
(
	"Walter", 
    "Bishop", 
    "WBishop@gmail.com", 
    "walterpass", 
    "Best lab in Harvard, Harvard University, FH33 6SJ",
    "Best lab in Harvard, Harvard University, FH33 6SJ"
),
(
	"Peter", 
    "Bishop", 
    "ThisIsMyShow@BestGuyEver.com", 
    "veryimportantperson101", 
    "Best lab in Harvard, Harvard University, FH33 6SJ",
    "Best lab in Harvard, Harvard University, FH33 6SJ"
);


INSERT INTO product 
(productName, description)
VALUES
(
	"Chamoizon Basics Ladder", 
    "Chamizon Basics Ladder is a basic ladder that should probably get the job done. Suitable for light work or it might break."
),
(
	"Premium Ladder + Free Bloke", 
    "Premium ladder made of high quality stainless steel. Suitable for all jobs around the home such as cleaning windows. Strong but lightweight, as is the bloke that comes with the ladder. The bloke provided can clean up to 300 windows an hour, provided sufficient amounts of coffee are supplied."
),
(
	"Chamoizon Chamoise Leather", 
    "Basic Chamoise Leather thats good for cleaning windows and stuff. Should work alright as long as you don't put too much pressure on while cleaning and break the window. Bits of broken glass may have an adverse affect on product"
),
(
	"Cheapo Telescopic Ladder", 
    "Telescopic ladder that only collapses 20% of the time while in use. Please ensure you have a good amount of medical care available before using."
),
(
	"Chamoizon Basics Squeegee", 
    "Basic squeegee, guarenteed to make a funny noise when cleaning your windows."
);