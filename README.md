# Teamspeak 3 Webinterface
## Introduction
This is a PHP Webinterface to mange your teamspeak instance.
You just have to configure the servers IP in the config.

The Interfaces provides a login (query user)

## Installation
### With Docker
If you with to install this interface with docker, 
you just have to create your `config.php` and mount it into the container.

Example:
```bash
docker run -it --rm \
-p8989:80 \
--name ts3web \
-vc:local_path_on_your_machine/config.php:/var/www/html/config.php \
registry.gitlab.com/rays3t/ts3web
```

Change `local_path_on_your_machine/config.php` to the path on your machine, 
where you have placed the configuration.
You can copy a example config from:
[/src/config.php.example](/src/config.php.example)

In this example we are just starting a container, 
adding the config and exposing the port `8989` on the host.

For better security tho we would recommend to bind the port only to localhost
(`-p172.0.0.1:8989:80`) and setup a proxy (Apache for example), 
which then forwards the request.

### Manual installation
1. Just copy all the files from [/src](/src) into the 
web directory  (or subfolder) of your webserver
2. Change the configuration.php.example to your needs
3. Rename it from `config.php.example` to `config.php`
4. If you encounter any errors, check the file permissions and changed them 
to the user of your apache / webserver.


## Authors and licensing
This Project is licensed with the GPLv3.
For more information have a look into the [license](/license.md) file.

Docker image creation by Kevin 'RAYs3T' Urbainczyk


Teamspeak 3 Webinterface written by Psychokiller (Daniel P.)

Dev-Website: http://ts3.cs-united.de


This software uses the `ts3admin.class.php` from Par0noid (Stefan Z.)

Dev-Website: http://ts3admin.info