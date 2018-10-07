#!/bin/bash

sed --in-place='' "s|SetHandler|#SetHandler|g" website/.htaccess


exit

<FilesMatch "\.php$">
        SetHandler application/x-httpd-suphp70
</FilesMatch>
