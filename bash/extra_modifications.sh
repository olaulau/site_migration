#!/bin/bash

grep -rl --include=".htaccess" SetHandler website | xargs sed --in-place='' "s|SetHandler|#SetHandler|g"


exit

<FilesMatch "\.php$">
        SetHandler application/x-httpd-suphp70
</FilesMatch>
