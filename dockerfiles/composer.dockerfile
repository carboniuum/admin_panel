FROM composer:2.5.7

ENV PHPUSER=laravel

RUN addgroup -g 1000 ${PHPUSER} && adduser -G ${PHPUSER} -g ${PHPUSER} -s /bin/sh -D ${PHPUSER}

USER ${PHPUSER}

WORKDIR /var/www/html

ENTRYPOINT [ "composer", "--ignore-platform-reqs" ]
