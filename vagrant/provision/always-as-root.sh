#!/usr/bin/env bash

source /app/vagrant/provision/common.sh

#== Provision script ==

info "Restart web-stack"
service php7.0-fpm restart
service nginx restart
service mysql restart

cat /app/vagrant/provision/ascii-art/planet-express.txt
