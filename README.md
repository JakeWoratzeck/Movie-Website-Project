# Movie-Website-Project
## &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CS3380 Final Project

## Group Members
### &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jacob Woratzeck (jcw4kd)
### &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Taylor Kuttenkuler (not in class)

## Instance link
### &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;http://jcw4kd.epizy.com

## Application Description

### Our project is a website that allows users to view information about new and upcoming movies. The front page (index.html) displays a preview of the films described in the website. Users can select “Sign In” at the bottom of the page to go to the login screen (login.php and login_form.php). If a user is not registered, they can select “Sign Up” from this page to register an account (register.php and registration_form.php). After logging in to or registering for the website, users will be moved to the main page of the website (membersArea.php). Users can use a dropdown menu to select the movie they want to view information about. When the dropdown selection is changed, the page will fetch information from a database and dynamically populate the page using AJAX with information on the selected film (getMovie.php). Selecting the “Account Details” button at the bottom of the main page will move users to a page that allows them to view and edit their account information (user_form.php and getUser.php). The user can also select “Delete Account” from this page where they will be prompted to confirm their account credentials (deleteAccount.php and delete_form.php). The site uses a PHP session throughout the site to monitor if a user is logged in. At the bottom of the main page (membersArea.php), there is a “Log Out” button that will terminate the session (logout.php) and return the user to the site’s front page (index.html).

### On our database, the “Users” table is used to store account information of the users. This information can be created, read, updated, and deleted through various methods mentioned above. The second table in the database is “Movies” which stores information on the movies that is used to dynamically populate the main page (membersArea.php) when a user selects a movie from the dropdown list.

## CRUD Requirements
### The CRUD requirements of the project are met mostly with the website’s login system. A user can create an account by choosing “Sign Up” button on the login screen (login_form.php). The user will be moved to a page to fill out a form(registration_form.php). This data will be used to create an entry in the “Users” table of our database (register.php).

### A user can read their account information by selecting “Account Details” on the site’s main page (membersArea.php). This will parse the database and populate a form on the page (user_form.php). The dropdown menu on the main page (membersArea.php) also reads data as it queries the database and dynamically populates the page with the information it parses. 

### User data can also be updated by editing the information on the “Account Details” page mentioned above. Upon submission, the information the user filled in is used to update their entry in the “Users” table in the database (getUser.php and user_form.php). 

### Finally, a user can delete data from the database by deleting their account. If a user selects “Delete Account” from the “Account Details” screen, they will be prompted to enter their username and password (delete_form.php). The credentials are validated with the database and, if correct, the entry will be deleted from the database (deleteAccount.php).

## Video Demonstration
### &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;https://vimeo.com/246302933

## Entity Relationship Diagram
 ![MovieWebsiteERD](/MovieWebsiteERD.png)

## Database Schema
CREATE TABLE `Movies` (

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`id` int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`title` varchar(40) NOT NULL,

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`description` text NOT NULL,

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`rating` varchar(5) NOT NULL,

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`posterImage` varchar(40) NOT NULL,

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`trailerLink` varchar(40) NOT NULL

); 

CREATE TABLE `Users` (

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`id` int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`firstName` varchar(30) NOT NULL,

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`lastName` varchar(30) NOT NULL,

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`username` varchar(20) NOT NULL UNIQUE,

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;`password` varchar(64) NOT NULL

);

