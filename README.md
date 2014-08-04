<h1> Remind Me </h1>

<a href='http://imgbin.org'><img src='http://imgbin.org/images/18657.png' alt='This image is hosted for free at ImageBin' height="200" width="200"/></a>

<h3>Installation</h3>

* Clone the repository, inside the newly created folder execute `git submodule update --init --recursive`
* Add database credentials into: `app/config/database.php`
* Add SendGrid credentials into: `app/config/SendGridAuth.php`
* Change `Security.salt` and `Security.cipherSeed` in `app/config/core.php`
* Rename `app/Plugin/Opauth/Config/bootstrapEXAMPLE.php` to `bootstrap.php` and add the specified credentials for Opauth Strategies.

