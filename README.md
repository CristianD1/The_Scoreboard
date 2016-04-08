# The Scoreboard

-> This scoreboard was a project made during my internship at sony to feed our addiction to playing foosball competitively together.  
-> It was then re-written to also support ping pong and may eventually support any 1v1/2v2 games   
-> Note: Looks best on mobile


#### LAMP installation:

1. Follow the steps listed [here](http://howtoubuntu.org/how-to-install-lamp-on-ubuntu) to install everything you need for a apache server on ubuntu.
2. Clone this directory in `/var/www` and set the default path for apache to be `/The_Scoreboard/site` (or whatever leads you to the index.php file if you chanegd the directories)
3. Create a file in `/var/www` named `config.ini` that looks like the following (replacing username and password with your sql credentials):   
    ```
    [Database]   
    username= root   
    password= test   
    ```
4. Inside `/var/www` run `cat db.sql | mysql -u root -p` to create the database and all the corresponding tables.
5. Go to `localhost` and you should be good to go!


#### Windows installation:
1. Why? Windows? Really?
2. Sigh fine.
3. Get a wamp server, preferably [this](http://www.filehorse.com/download-wampserver-32/)
4. Start it up, click the navbar icon and go to www directory
5. Clone the git repo in there and make the same `config.ini` (see step 3 of LAMP installation) file in the `/www` directory
6. Go to `site/php/conn.php` and change the line that imports config.ini to represent the new file path it's in.
7. Open up phpmyadmin from the navbar icon for wamp and paste all the code in `The_Scoreboard/db.sql` into the tab that indicates you can write sql code.
8. Go to localhost and you're all set. I guess... use linux pls.


### Screenshots!
[[scoreboardPics/landingPage.png]]
[[scoreboardPics/signup.png.png]]
[[scoreboardPics/account.png.png]]
[[scoreboardPics/recordGame.png.png]]
