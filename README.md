Idno OpenPGP Encrypted Forms
============================

Uses OpenPGP in browser encryption to encrypt the contents of web forms prior to
submission.

This is very much experimental.

Installation
------------

 * Install into your IdnoPlugins directory and activate it in the plugins setting 
   panel.
 * Generate your keys using gnupg on your server (with no password), make sure your .gnupg directory is not web readable.
   Note: On Debian www-data's home directory is /var/www, which is generally web readable. It is recommended you 
   either change this, or limit access via config. 
 * Set your public key in your config.ini

What this is for
----------------

This is intended to mitigate one specific problem, that is when providing HTTPS in a load
balanced environment, HTTPS is quite often removed at the endpoint, meaning that the page payload
can be visible to anyone with access to your load balancer or internal network via passive scan or
Heartbleed style memory overflow.

Note, that in this scenario they could still MotS attack the page, and modify the page content before 
it is sent, but that would mean TAO have got into your data centre, and there's not much a humble
web plugin can do about that.


What this is not for
--------------------

This is not a replacement for HTTPS! 

HTTPS ensures that your page has not been tampered with, so you'll
still need to deploy your page - and openpgp.js - over HTTPS to ensure the page hasn't been modified.

TODO
----
- [ ] Find a way of doing pgp on the server without calling an external executable
- [ ] Research a way of guarding against HTTP only page modification

Licence
-------

Released under the Apache 2.0 licence: http://www.apache.org/licenses/LICENSE-2.0.html

Requires
--------
* OpenPGP Idno wrapper <https://github.com/mapkyca/IdnoOpenPGPJS>

See
---
 * Author: Marcus Povey <http://www.marcus-povey.co.uk> 
 * OpenPGP.js <http://openpgpjs.org/>