#
# Development
#
# Build command:
# docker build --no-cache -f production.dockerfile -t zavy86/tmtru .
#
# Push command:
# docker push zavy86/tmtru
#
# Run command:
# docker run --name tmtru -d -p 80:80 -v tmtru-dataset:/dataset -e PUID=1000 -e PGID=1000 zavy86/tmtru
#

FROM alpine:3

ARG DEPENDENCIES="\
nano \
curl \
shadow \
apache2 \
php8 \
php8-apache2 \
php8-json \
php8-mbstring \
php8-session \
"

# installation
RUN apk add --no-cache $DEPENDENCIES

# copy source code
COPY . /var/www/localhost/htdocs/

# remove unnecessary files
RUN rm -f /var/www/localhost/htdocs/development.dockerfile
RUN rm -f /var/www/localhost/htdocs/production.dockerfile
RUN rm -f /var/www/localhost/htdocs/configuration.json
RUN rm -fR /var/www/localhost/htdocs/links

# make initial configuration and symblic link
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
