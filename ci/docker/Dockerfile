FROM shinsenter/phpfpm-nginx:php8.2-alpine
# base image doc
# https://hub.docker.com/r/shinsenter/php

# needed for pdftotext
RUN apk add poppler-utils

ADD docker/startup/00-install /startup/00-install
RUN chmod +x /startup/00-install