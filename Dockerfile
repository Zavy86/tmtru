FROM alpine:3

RUN apk add --no-cache \
    apache2 \
    php8 \
    php8-apache2 \
    php8-session \
    php8-mbstring \
    php8-json \
    shadow \
    nano \
    curl

# download and extract tmtru archive
RUN curl -Lso tmtru.tar.gz https://github.com/Zavy86/tmtru/archive/master.tar.gz
RUN tar --strip-components=1 -xf tmtru.tar.gz -C /var/www/localhost/htdocs/
RUN rm tmtru.tar.gz

# make initial configuration and links symblic link
RUN mkdir /dataset
RUN mkdir /dataset/links
RUN echo "{\"debuggable\":true,\"length\":3,\"title\":\"tmtru\",\"owner\":\"Firstname Lastname\",\"password\":\"password\",\"gTag\":\"\"}" > /dataset/configuration.json
RUN ln -s /dataset/configuration.json /var/www/localhost/htdocs/
RUN ln -s /dataset/links /var/www/localhost/htdocs/

# move document root and directory htdocs to public
RUN sed -ri \
    -e 's!^DocumentRoot "/var/www/localhost/htdocs"$!DocumentRoot "/var/www/localhost/htdocs/public"!g' \
    -e 's!^<Directory "/var/www/localhost/htdocs">$!<Directory "/var/www/localhost/htdocs/public">!g' \
    -e 's!^#(LoadModule rewrite_module .*)$!\1!g' \
    -e 's!^(\s*AllowOverride) None.*$!\1 All!g' \
    "/etc/apache2/httpd.conf"

# start script to override apache user's uid/gid
RUN echo -e \
'#!/bin/sh\n'\
'groupmod -o -g ${PGID:-1000} apache\n'\
'usermod -o -u ${PUID:-1000} apache\n'\
'chown -R apache:apache /var/www/localhost/htdocs\n'\
'chown -R apache:apache /dataset\n'\
'exec httpd -D FOREGROUND' > /start.sh
RUN chmod +x /start.sh

WORKDIR /var/www/localhost/htdocs

ENTRYPOINT ["/start.sh"]

VOLUME /dataset

EXPOSE 80
