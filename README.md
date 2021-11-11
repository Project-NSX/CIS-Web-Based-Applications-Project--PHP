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
- 
## Project Screenshots
Below are screenshots of the final project
![](ASSIGNMENT-FILES/Final-Screenshots/1.png?raw=true "Home Page")

![](ASSIGNMENT-FILES/Final-Screenshots/2.png?raw=true "Product Details Page")

![](ASSIGNMENT-FILES/Final-Screenshots/3.png?raw=true "Shopping Basket")

![](ASSIGNMENT-FILES/Final-Screenshots/4.png?raw=true "Login Page")

![](ASSIGNMENT-FILES/Final-Screenshots/5.png?raw=true "Checkout")

![](ASSIGNMENT-FILES/Final-Screenshots/6.png?raw=true "Summary")

![](ASSIGNMENT-FILES/Final-Screenshots/7.png?raw=true "Success")

## Database Information
This section contains information regarding the database that was developed as part of this application. I begin with designing the database and then move onto providing the code I used to create the database.
### Database Design
Database Table Structure:<br /><br />

Product<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;productID<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;productName<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Image<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;shortDescription<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;longDescription<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Price <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><br />
User<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;userID<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fName<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lName<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;deliveryAddress<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;billingAddress<br /><br />
	
Order<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;orderID<br />
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
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;productID INT UNSIGNED NOT NULL AUTO_INCREMENT, <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;productName VARCHAR (128),<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;image BLOB, <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;description VARCHAR(128) NOT NULL,<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRIMARY KEY (productID)<br />
);<br />

CREATE TABLE Customer<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;customerID INT UNSIGNED NOT NULL AUTO_INCREMENT,<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;fName VARCHAR(128),<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lName VARCHAR(128),<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;email VARCHAR(255),<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;password VARCHAR(128),<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;deliveryAddress VARCHAR(512),<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;billingAddress VARCHAR(512),<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRIMARY KEY (customerID)<br />
);<br /><br />

CREATE TABLE CustomerOrder<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;orderID INT UNSIGNED NOT NULL AUTO_INCREMENT, <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;orderDate DATETIME,<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRIMARY KEY (orderID)<br />
);<br /><br />

CREATE TABLE ProductOrder<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;productID INT UNSIGNED NOT NULL,<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;orderID INT UNSIGNED NOT NULL, <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PRIMARY KEY (productID, orderID),<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FOREIGN KEY (productID)<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCES Product(productID)<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ON DELETE RESTRICT ON UPDATE CASCADE,<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FOREIGN KEY (orderID)<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REFERENCES CustomerOrder(orderID)<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ON DELETE CASCADE ON UPDATE CASCADE<br />
);

#### Inserting Test Data
INSERT INTO customer <br />
(fName, lName, eMail, password, deliveryAddress, billingAddress)<br />
VALUES<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Charlie", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Francis", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"CFrancis@gmail.com", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"charliepass", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"10 Charlie's street, Charlietown, RH55 6BB",<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"10 Charlie's street, Charlietown, RH55 6BB"<br />
),	<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Walter", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Bishop", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"WBishop@gmail.com", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"walterpass", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Best lab in Harvard, Harvard University, FH33 6SJ",<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Best lab in Harvard, Harvard University, FH33 6SJ"<br />
),<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Peter", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Bishop", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"ThisIsMyShow@BestGuyEver.com", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"veryimportantperson101", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Best lab in Harvard, Harvard University, FH33 6SJ",<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Best lab in Harvard, Harvard University, FH33 6SJ"<br />
);<br /><br />


INSERT INTO product <br />
(productName, description)<br />
VALUES<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Chamoizon Basics Ladder", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Chamizon Basics Ladder is a basic ladder that should probably get the job done. Suitable for light work or it might break."<br />
),<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Premium Ladder + Free Bloke", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Premium ladder made of high quality stainless steel. Suitable for all jobs around the home such as cleaning windows. Strong but lightweight, as is the bloke that comes with the ladder. The bloke provided can clean up to 300 windows an hour, provided sufficient amounts of coffee are supplied."<br />
),<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Chamoizon Chamoise Leather",<br /> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Basic Chamoise Leather thats good for cleaning windows and stuff. Should work alright as long as you don't put too much pressure on while cleaning and break the window. Bits of broken glass may have an adverse affect on product"<br />
),<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Cheapo Telescopic Ladder", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Telescopic ladder that only collapses 20% of the time while in use. Please ensure you have a good amount of medical care available before using."<br />
),<br />
(<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Chamoizon Basics Squeegee", <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"Basic squeegee, guarenteed to make a funny noise when cleaning your windows."<br />
);<br />
