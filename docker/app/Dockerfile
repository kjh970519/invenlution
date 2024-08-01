# Base Image
FROM php:7.2.34-apache

# Update and install security patches
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
                                                                  vim \
                                                                  less \
                                                                  libpng-dev \
                                                                  libjpeg-dev \
                                                                  libfreetype6-dev \
                                                                  --fix-missing

# GD 라이브러리 설치 및 활성화
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ && \
    docker-php-ext-install gd

# ll 별칭 설정
RUN echo "alias ll='ls -l'" >> /etc/bash.bashrc

# Additional setup
RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy entire application code from context directory to /var/www/html
COPY . /var/www/html/

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Expose port
EXPOSE 80