## Servicemapp Setup instructions

1. Unzip servicemapp-master to webroot (ex. C:\xampp\htdocs\) and rename it to servicemappadv
2. Setup hosts file (C:\Windows\System32\drivers\etc\hosts) by adding this line at the end: 
	127.0.0.1   servicemapp
	127.0.0.1   back.servicemapp

3. Update http-vhosts.conf file (ex. C:\xampp\apache\conf\extra\http-vhosts.conf) to look like this:
		# Virtual Hosts
		#
		# Required modules: mod_log_config

		# If you want to maintain multiple domains/hostnames on your
		# machine you can setup VirtualHost containers for them. Most configurations
		# use only name-based virtual hosts so the server doesn't need to worry about
		# IP addresses. This is indicated by the asterisks in the directives below.
		#
		# Please see the documentation at 
		# <URL:http://httpd.apache.org/docs/2.4/vhosts/>
		# for further details before you try to setup virtual hosts.
		#
		# You may use the command line option '-S' to verify your virtual host
		# configuration.

		#
		# Use name-based virtual hosting.
		#
		NameVirtualHost *:80
		#
		# VirtualHost example:
		# Almost any Apache directive may go into a VirtualHost container.
		# The first VirtualHost section is used for all requests that do not
		# match a ##ServerName or ##ServerAlias in any <VirtualHost> block.
		#


		<VirtualHost *:80>
		    ServerAdmin email@gmail.com
		    DocumentRoot "C:/xampp/htdocs/servicemappadv/frontend/web"
		    ServerName servicemapp
		    ServerAlias www.servicemapp
		    ErrorLog "logs/servicemapp-error.log"
		    CustomLog "logs/servicemapp-access.log" combined

		    <Directory "C:/xampp/htdocs/servicemappadv/frontend/web">
		        AllowOverride All      
		        Order Allow,Deny       
		        Allow from all         
		        Require all granted    
		    </Directory>

		</VirtualHost>

		<VirtualHost *:80>
		    ServerAdmin email@gmail.com
		    DocumentRoot "C:/xampp/htdocs/servicemappadv/backend/web"
		    ServerName back.servicemapp
		    ServerAlias www.back.servicemapp
		    ErrorLog "logs/back.servicemapp-error.log"
		    CustomLog "logs/back.servicemapp-access.log" combined

		    <Directory "C:/xampp/htdocs/servicemappadv/backend/web">
		        AllowOverride All      
		        Order Allow,Deny       
		        Allow from all         
		        Require all granted    
		    </Directory>

		</VirtualHost>


4. Change settings in httpd.conf (C:\xampp\apache\conf\httpd.conf) by enabling (commenting out) the following modules (if commented): 
	- LoadModule deflate_module modules/mod_deflate.so
	- LoadModule expires_module modules/mod_expires.so
	- LoadModule filter_module modules/mod_filter.so

5. Install dependencies using [Composer](https://getcomposer.org/): `composer global require "fxp/composer-asset-plugin:1.1.1" && composer install`
6. Run command [`./init`](init) to initialize the application with dev environment
7. Adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.

Your webapp should be now available at:
   * Frontend: http://servicemapp/
   * Backend (administration): https://back.servicemapp/