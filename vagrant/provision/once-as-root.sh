#!/usr/bin/env bash

#== Import script args ==

timezone=$(echo "$1")

#== Bash helpers ==

function info {
    echo " "
    echo "--> $1"
    echo " "
}

#== Provision script ==

info "Allocate swap for MySQL 5.6"
fallocate -l 2048M /swapfile
chmod 600 /swapfile
mkswap /swapfile
swapon /swapfile
echo '/swapfile none swap defaults 0 0' >> /etc/fstab

info "Configure locales"
update-locale LC_ALL="C"
dpkg-reconfigure locales

info "Configure timezone"
echo ${timezone} | tee /etc/timezone
dpkg-reconfigure --frontend noninteractive tzdata

info "Prepare root password for MySQL"
debconf-set-selections <<< "mysql-server-5.6 mysql-server/root_password password \"''\""
debconf-set-selections <<< "mysql-server-5.6 mysql-server/root_password_again password \"''\""

info "Update OS software"
apt-get update
apt-get upgrade -y

info "Install additional software"
apt-get install -y git php5-curl php5-cli php5-intl php5-mcrypt php5-mysqlnd php5-gd php5-fpm nginx mysql-server-5.6
php5enmod mcrypt

info "Configure MySQL"
sed -i 's/.*bind-address.*/bind-address = 0.0.0.0/' /etc/mysql/my.cnf

info "Configure PHP-FPM"
fpm_conf=/etc/php5/fpm/pool.d/www.conf
sed -i 's/user = www-data/user = vagrant/g' $fpm_conf
sed -i 's/group = www-data/group = vagrant/g' $fpm_conf
sed -i 's/owner = www-data/owner = vagrant/g' $fpm_conf

info "Configure PHP error handler"
php_ini_set() {
    sed -i 's/error_reporting = .*/error_reporting = E_ALL/' $1
    sed -i 's/display_errors = .*/display_errors = On/' $1
}
php_ini_set /etc/php5/fpm/php.ini
php_ini_set /etc/php5/cli/php.ini

info "Configure NGINX"
sed -i 's/user www-data/user vagrant/g' /etc/nginx/nginx.conf

info "Enabling site configuration"
ln -s /app/vagrant/nginx/app.conf /etc/nginx/sites-enabled/app.conf

info "Initailize databases for MySQL"
mysql -uroot <<< "CREATE DATABASE \`yii2-core\`"

info "Install composer"
if [ ! -f /usr/local/bin/composer ]; then
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
else
    composer self-update
fi
