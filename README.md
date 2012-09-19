Learning Registry App

VHost Setup
<VirtualHost *:80>
	ServerName www.learningapp.dev
	ServerAdmin webmaster@learningapp.dev
	ServerAlias learningapp.dev

	SetEnv APPLICATION_ENV "development"

	DocumentRoot /var/www/learningapp/public/www
	<Directory /var/www/learningapp/public/www>
                Options -Indexes  +SymLinksIfOwnerMatch
                #AllowOverride None
		RewriteEngine on
		RewriteBase /

		# www redirect
		#RewriteCond %{HTTP_HOST} ^learningapp.dev [NC]
		#RewriteRule ^(.*)$ http://www.learningapp.dev/$1 [R=301,L]

		RewriteCond %{REQUEST_FILENAME} !-f
		RewriteCond %{REQUEST_FILENAME} !-d
		RewriteRule . index.php [L]
	
		<IfModule mod_headers.c>
                        Header set Access-Control-Allow-Origin "http://m.learningapp.dev"
			Header set Access-Control-Allow-Methods "POST,GET,OPTIONS,PUT"
			Header set Access-Control-Allow-Headers "Content-Type,origin,x-prototype-version,x-requested-with"
                </IfModule>
	
	</Directory>

	ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
	<Directory "/usr/lib/cgi-bin">
		AllowOverride None
		Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
		Order allow,deny
		Allow from all
	</Directory>

	ErrorLog /var/www/learningapp/log/apache-error.log

	# Possible values include: debug, info, notice, warn, error, crit,
	# alert, emerg.
	LogLevel warn

	CustomLog /var/www/learningapp/log/apache-access.log combined

    Alias /doc/ "/usr/share/doc/"
    <Directory "/usr/share/doc/">
        Options Indexes MultiViews FollowSymLinks
        AllowOverride None
        Order deny,allow
        Deny from all
        Allow from 127.0.0.0/255.0.0.0 ::1/128
    </Directory>

</VirtualHost>
