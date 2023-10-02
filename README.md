Feel free to contribute to this project by creating a pull request. We welcome any improvements, bug fixes, or new features.





This Website is made for someone that has audio to sell to clients.
It has an Admin side and a regular user side.
The regular user can listen to the audio files and buy the files if they choose to after they make an account. The admin user can add new audio files to sell, they can delete audio files, and they can check which ones have been sold or not. They can also check see how signed up for an account and they can make they admins or regular users and delete the users if they choose to. There is also a blog part to this website where the an admin can put up a post about new music releases.

Languages used in this website:
HTML, CSS, JAVASCRIPT, PHP, MYSQL

SETTING UP:

To set up this website to work on your local machine you will need to have a local web server like XAMPP or MAMP. While Building this I used XAMPP and I will be giving instructions on how to set it up with XAMPP. If you don't have any web servers setup on your local machine i recommend you download XAMPP and install it. 

After You install XAMPP go to the XAMPP Folder and open it then look for a folder called 'htdocs' then open it. When your in 'htdocs' make a new folder and name it 'beatstore_empire' then open it. After you open it you need to either download the files and put them in there or clone the repository to that folder. Now all the files should be in that folder. 

The next step to to start you servers and setup your database. The way to do this is to first open the XAMPP app. if you are using Mac Computers you go to the LaunchPad and find the XAMPP(other) tab and inside the tab there is going to be one Application called ('manager-osx'), open that app. Once it's open, there should be three tabs on top, Welcome, Manage Servers, and Application log. Click on 'Manage Servers' and you should see Three servers, They should be Mysql, ProFTPD, and Apache. Click on the Mysql Server and on the right side You should see Run, Stop, Restart, and Configure. Click on Run. and do the same thing for the Apache Server. When the two servers turn green that means your good to go.

Now that your servers are setup the last thing to do is to set up your database.
Open up a web browser, I recommend using Google Chrome. Once its open on the address bar type in "localhost", it should bring you to the apache dashboard. (If you have any problems double check that your servers are green and not red). When you get to this page on the navbar there should be a tab that says 'phpMyAdmin' click on that and it should bring you to a page that says 'phpMyAdmin' on the top left corner.
This is Where we are going to set up our database. You Will notice that be page is split up into 3 parts, the left most part has the logo, some horizonal buttons with icons, and some links with a '+' icon for dropdown menus.
On top of the links with the '+' icon there is a 'new' link, click on that to create a new database. When you click it the right side of the page should change and it should say Databases and it should have a section that says 'Create database'.
For the Database name type in 'db_beatstore'. It is important that you type the database name exactly like it i typed it because it is on the website that database name is used to connect to the database that we are creating. after you enter the databae name, click create. 
When you click create the right side of the page should change and now say 'Create table' and on the left side you should see that the database you have just created is highlighted in gray. You are not going to bea creating any tables because i have already exported the database content from the one i made to make it easier for people to demo the website. All you have to do is import the database content. You might have noticed that the right side of the page also has a navbar at the top that starts with 'Structure' and has 'SQl' next to it. On that navbar there is a tab that says 'Import', click on that tab and it should change the right side to say 'Importing in the database "db_beatstore", make sure that it says "db_beatstore" This is really important.

Under that line there should be a section that says 'File to import'. This is where we are going to import our database content. On the Third Line under that header it should say Browse your computer and you shold see a button to "Choose File" click on it and navigate to the folder where you put all the files for the website and look for a folder called "MYSQL" open that folder and you should see a file called 'db_beatstore.sql' and open it. After you open the file name should be next to the Button. Now go down the page and there should be a button that says "Go", Click on it and your database content should be filled in automatically.

NOW TO OPEN THE WEBSITE:

open another tab on your web browser and Typpe in 'localhost/beatstore_empire', make sure that 'beatstore_empire' is the is the name of the folder that you put the files in.
If you did everything correctly, the website should open and you should here a some audio comuing out the speakers and you should see a webpage popup.

LOGGING IN:

I created a login and password for the admin user so that you can check out the functionality of the website.

The Username is: admin
The Password is: admin123

