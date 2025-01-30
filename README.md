# COIS-Lab - A space for collaborative IVENA statistics

# Requirements
-   Webserver (Apache, Nginx, LiteSpeed, IIS, etc.) with PHP 8.4 or higher and 
    MySQL 8.4 as database.

# Setup
This project expects you to have local webserver and a locally installed MySQL
or MariaDB instance. 

## Install from GitHub
1. Launch a **terminal** or **console** and navigate to the webroot folder. 
   Clone [this repository from GitHub](https://github.com/nplhse/cois-hub) to 
   a folder in the webroot of your server, e.g. `~/webroot/cois-lab`.

    ```
    $ cd ~/webroot
    $ git clone https://github.com/nplhse/cois-lab.git
    ```

2. Install the project with all dependencies by using **composer**. 

    ```
    $ cd ~/webroot/cois-lab
    $ composer install
    ``` 

3. You are ready to go, just open the site with your favorite browser!

# Contributing
Any contribution to this project is appreciated, whether it is related to 
fixing bugs, suggestions or improvements. Feel free to take your part in the 
development of this project!

However, you should follow some simple guidelines which you can find in the
[CONTRIBUTING](CONTRIBUTING.md) file. Also, you must agree to the 
[Code of Conduct](CODE_OF_CONDUCT.md).

# License
See [LICENSE](LICENSE.md).
