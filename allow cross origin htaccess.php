<ifmodule mod_headers.c="">
   SetEnvIf Origin "^(.*\.domain\.com)$" ORIGIN_SUB_DOMAIN=$1
   Header set Access-Control-Allow-Origin "%{ORIGIN_SUB_DOMAIN}e" env=ORIGIN_SUB_DOMAIN
   Header set Access-Control-Allow-Methods: "*"
   Header set Access-Control-Allow-Headers: "Origin, X-Requested-With, Content-Type, Accept, Authorization"
</ifmodule>