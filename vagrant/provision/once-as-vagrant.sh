#!/usr/bin/env bash

#== Import script args ==

github_token=$(echo "$1")

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Configure composer"
composer config --global github-oauth.github.com ${github_token}
echo "Done!"

info "Install plugins for composer"
composer global require "fxp/composer-asset-plugin:^1.2.0" --no-progress --prefer-dist

info "Changing working directory"
cd /app

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

info "Create bash-alias 'app' for vagrant user"
echo 'alias app="cd /app"' | tee /home/vagrant/.bash_aliases

info "Enabling colorized prompt for guest console"
sed -i "s/#force_color_prompt=yes/force_color_prompt=yes/" /home/vagrant/.bashrc
