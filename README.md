<h1> Remind Me </h1>

<h3>Installation</h3>

* Clone the repository, inside the newly created folder execute `git submodule update --init --recursive`
* Add database credentials into: `app/config/database.php`
* Add SendGrid credentials into: `app/config/SendGridAuth.php`
* Change `Security.salt` and `Security.cipherSeed` in `app/config/core.php`
* Rename `app/Plugin/Opauth/Config/bootstrapEXAMPLE.php` to `bootstrap.php` and add the specified credentials for Opauth Strategies.

