RewriteEngine on
RewriteCond %{HTTP_HOST} ^example\.com$ [OR]
RewriteCond %{HTTP_HOST} ^www\.example\.com$
RewriteRule ^(.*)$ https://example.co/$1 [R=301,L]
