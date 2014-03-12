**S.A.R.A.H from anywhere**
=====================

This is an add-on for **[S.A.R.A.H](http://encausse.wordpress.com/s-a-r-a-h/)** , that allows users to access it from anywhere, without need of anything else than [Google Chrome](https://www.google.com/intl/chrome/browser/) (33 or superior) and a PHP server *on the host*.

----------


**Installation:**
---------

All you have to do is to copy the files in a folder on your PHP server, and **that's all !**
> **NOTE:**
I strongly recommend you to protect this folder with a *.htaccess* file, in order to prevent undesired people to access your home automation.

You can replace the text *S.A.R.A.H* with whatever you want by changing the value of the *$name* variable in *index.php*.

    $name = "NameOfServer";

**Users guide:**
---------

### How to send: ###
Go visit the page and you'll have 3 possibilities to talk to SARAH:
 * Type whatever you want in the text input.
 * Click on the little microphone and speak *(you can only say one order at the time )*.
 * Click on the **"Dictée continue"** button, and then you could say multiple commands, without any other action. And, if there's no problem, the browser window does not even need to be selected.
 
### How to receive: ###
2 ways of receiving what S.A.R.A.H answered:
 * Read what is written below the buttons.
 * Check the **"Vocalisation du résultat"** box and let the magic happens !

### Configuration: ###
Server side:
 * Name of the assistant.
 * IP adress of the NodeJS server (to access the *"http://server:8888/?emulate=[...]"* option).

Client side: 
 * You can set the recognized language.

**Things to be done:**
---------
No order:

 - Cookies ! to store your settings.
 - A way to resend the last command.
 - Changing the TTS voice according to your language.
 - Rework the CSS.
 - Cleaning the code.


[S.A.R.A.H](http://encausse.wordpress.com/s-a-r-a-h/) is a NodeJS framework by [JP Encausse](https://github.com/JpEncausse), an Home Automation project built 
on top of:
* C# (Kinect) client for Voice, Gesture, Face, QRCode recognition. 
* NodeJS (ExpressJS) server for Internet of Things communication.




