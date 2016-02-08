#!/bin/sh
#
# Provision the vagrant environment

# Copy site .conf file accross
sudo cp /vagrant/config/environments/development.conf /etc/apache2/sites-available/ctbusinessawards.dev.conf
sudo rm -rf /var/www
sudo mkdir -p /var/www
sudo ln -fs /vagrant /var/www/ctbusinessawards.dev
# Enable new virtual host
sudo ln -fs /etc/apache2/sites-available/ctbusinessawards.dev.conf /etc/apache2/sites-enabled/ctbusinessawards.dev.conf
# Restart Apache
sudo service apache2 restart
# Setup database
mysql -u root -proot -e "create database wordpress"
mysql -u root -proot wordpress < /vagrant/scripts/bootstrap.sql
# Install Composer Dependencies
php /usr/local/bin/composer.phar update --working-dir="/var/www/ctbusinessawards.dev" --no-interaction
# Node
npm -v
npm install --prefix="/var/www/ctbusinessawards.dev/html/app/themes/ctba-2016/"
#bower install --config.directory="/var/www/ctbusinessawards.dev/html/app/themes/ctba-2016/libs" -p
