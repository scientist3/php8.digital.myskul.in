###################
What is CodeIgniter
###################

CodeIgniter is an Application Development Framework - a toolkit - for people
who build web sites using PHP. Its goal is to enable you to develop projects
much faster than you could if you were writing code from scratch, by providing
a rich set of libraries for commonly needed tasks, as well as a simple
interface and logical structure to access these libraries. CodeIgniter lets
you creatively focus on your project by minimizing the amount of code needed
for a given task.

*******************
Release Information
*******************

This repo contains in-development code for future releases. To download the
latest stable release please visit the `CodeIgniter Downloads
<https://codeigniter.com/download>`_ page.

**************************
Changelog and New Features
**************************

You can find a list of all changes for each release in the `user
guide change log <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/changelog.rst>`_.

*******************
Server Requirements
*******************

PHP version 5.6 or newer is recommended.

It should work on 5.3.7 as well, but we strongly advise you NOT to run
such old versions of PHP, because of potential security and performance
issues, as well as missing features.

************
Installation
************
[ChatGptHelp](https://chat.openai.com/share/e187fc37-ff78-4f14-adf3-225af6b9d772)
Just run these two commands 
0) docker-compose down
1) docker-compose build
2) docker-compose up -d

docker exec -it 3cb97b4c9d7e17135a4ee144c4b9e0ebd1e6a3bf80587b177acce0103e526996 ls -ld /var/www/html/application/sessions

docker exec -it 3cb97b4c9d7e17135a4ee144c4b9e0ebd1e6a3bf80587b177acce0103e526996 chown www-data:www-data /var/www/html/application/sessions

docker exec -it 3cb97b4c9d7e17135a4ee144c4b9e0ebd1e6a3bf80587b177acce0103e526996 chmod 755 /var/www/html/application/sessions

docker tag php7_image scientist33/php7_image:latest
docker tag php8_image scientist33/php8_image:latest

docker push scientist33/php7_image:latest
docker push scientist33/php8_image:latest


.. docker build -t my_nginx_reverse_proxy -f Dockerfile.nginx .
.. docker run -d -p 80:80 --name my_nginx_proxy my_nginx_reverse_proxy
.. docker rm my_nginx_proxy

.. docker run -d -p 80:80 --name my_nginx_proxy my_nginx_reverse_proxy
.. docker rename my_nginx_proxy new_name

Please see the `installation section <https://codeigniter.com/userguide3/installation/index.html>`_
of the CodeIgniter User Guide.

*******
License
*******

Please see the `license
agreement <https://github.com/bcit-ci/CodeIgniter/blob/develop/user_guide_src/source/license.rst>`_.

*********
Resources
*********

-  `User Guide <https://codeigniter.com/docs>`_
-  `Contributing Guide <https://github.com/bcit-ci/CodeIgniter/blob/develop/contributing.md>`_
-  `Language File Translations <https://github.com/bcit-ci/codeigniter3-translations>`_
-  `Community Forums <http://forum.codeigniter.com/>`_
-  `Community Wiki <https://github.com/bcit-ci/CodeIgniter/wiki>`_
-  `Community Slack Channel <https://codeigniterchat.slack.com>`_

Report security issues to our `Security Panel <mailto:security@codeigniter.com>`_
or via our `page on HackerOne <https://hackerone.com/codeigniter>`_, thank you.

***************
Acknowledgement
***************

The CodeIgniter team would like to thank EllisLab, all the
contributors to the CodeIgniter project and you, the CodeIgniter user.
