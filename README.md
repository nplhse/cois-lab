# COIS-Lab - A space for collaborative IVENA statistics

[![Testsuite](https://github.com/nplhse/cois-lab/actions/workflows/tests.yml/badge.svg)](https://github.com/nplhse/cois-lab/actions/workflows/tests.yml) [![Linting](https://github.com/nplhse/cois-lab/actions/workflows/lint.yml/badge.svg)](https://github.com/nplhse/cois-lab/actions/workflows/lint.yml)

# Requirements
-   Webserver (Apache, Nginx, LiteSpeed, IIS, etc.) with PHP 8.3 or higher 

# Setup
This project expects you to have local webserver (see requirements) running,
preferably with the symfony binary in your development environment.

## Install from GitHub
1. Launch a **terminal** or **console** and navigate to the webroot folder. 
   Clone [this repository from GitHub](https://github.com/nplhse/cois-hub) to 
   a folder in the webroot of your server, e.g. `~/webroot/cois-lab`.

    ```
    $ cd ~/webroot
    $ git clone https://github.com/nplhse/cois-lab.git
    ```

2. Install the project with all dependencies by using **make**. 

    ```
    $ cd ~/webroot/cois-lab
    $ make install
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
