<h1>memomail.io</h1>

<a href='http://imgbin.org'><img src='http://imgbin.org/images/18657.png' alt='This image is hosted for free at ImageBin' height="200" width="200"/></a>

<h4><i>"A simple and elegant web app for creating memos that will be delivered straight to your inbox."</i></h4>

<h3>Installation</h3>

* Clone the repository, inside the newly created folder execute `git submodule update --init --recursive`
* Add database credentials into: `app/config/database.php`
* Add SendGrid credentials into: `app/config/SendGridAuth.php`
* Change `Security.salt` and `Security.cipherSeed` in `app/config/core.php`
* Rename `app/Plugin/Opauth/Config/bootstrapEXAMPLE.php` to `bootstrap.php` and add the specified credentials for Opauth Strategies.

