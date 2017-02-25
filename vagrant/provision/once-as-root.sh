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

export DEBIAN_FRONTEND=noninteractive

info "Configure timezone"
timedatectl set-timezone ${timezone} --no-ask-password

info "Prepare root password for MySQL"
debconf-set-selections <<< "mysql-community-server mysql-community-server/root-pass password \"''\""
debconf-set-selections <<< "mysql-community-server mysql-community-server/re-root-pass password \"''\""

info "Update OS software"
apt-get update
apt-get upgrade -y

info "Install additional software"
apt-get install -y php7.0-curl php7.0-cli php7.0-intl php7.0-mcrypt php7.0-mysqlnd php7.0-gd php7.0-fpm php7.0-mbstring php7.0-xml unzip nginx mysql-server-5.7
phpenmod mcrypt

info "Configure MySQL"
sed -i 's/.*bind-address.*/bind-address = 0.0.0.0/' /etc/mysql/mysql.conf.d/mysqld.cnf
mysql -uroot <<< "CREATE USER 'root'@'%' IDENTIFIED BY ''"
mysql -uroot <<< "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%'"
mysql -uroot <<< "DROP USER 'root'@'localhost'"
mysql -uroot <<< "FLUSH PRIVILEGES"

info "Configure PHP-FPM"
fpm_conf=/etc/php/7.0/fpm/pool.d/www.conf
sed -i 's/user = www-data/user = ubuntu/g' $fpm_conf
sed -i 's/group = www-data/group = ubuntu/g' $fpm_conf
sed -i 's/owner = www-data/owner = ubuntu/g' $fpm_conf

info "Configure PHP error handler"
php_ini_set() {
    sed -i 's/error_reporting = .*/error_reporting = E_ALL/' $1
    sed -i 's/display_errors = .*/display_errors = On/' $1
}
php_ini_set /etc/php/7.0/fpm/php.ini
php_ini_set /etc/php/7.0/cli/php.ini

info "Configure NGINX"
sed -i 's/user www-data/user ubuntu/g' /etc/nginx/nginx.conf

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
