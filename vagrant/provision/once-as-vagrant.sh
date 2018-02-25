#!/usr/bin/env bash

source /app/vagrant/provision/common.sh

#== Import script args ==

github_token=$(echo "$1")

#== Provision script ==

info "Configure composer"
composer config --global github-oauth.github.com ${github_token}

info "Changing working directory"
cd /app

info "Install phpMyAdmin"
composer create-project phpmyadmin/phpmyadmin --repository-url=https://www.phpmyadmin.net/packages.json --no-dev --no-progress --prefer-dist
cd phpmyadmin
cp config.sample.inc.php config.inc.php
sed -i "/AllowNoPassword.*/ {N; s/AllowNoPassword.*false/AllowNoPassword'] = true/}" config.inc.php
echo "\$cfg['CheckConfigurationPermissions'] = false;" >> config.inc.php
cd ../

info "Install project dependencies"
if [ ! -d vendor ]; then
    composer install --no-progress --prefer-dist
else
    composer update --no-progress --prefer-dist
fi

info "Init project"
if [ ! -f .env ]; then
    cp .env.dist .env
fi
php yii app/setup --interactive=0

info "Create bash-alias 'app' for ubuntu user"
echo 'alias app="cd /app"' | tee /home/ubuntu/.bash_aliases

info "Enabling colorized prompt for guest console"
sed -i 's/#force_color_prompt=yes/force_color_prompt=yes/' /home/ubuntu/.bashrc
