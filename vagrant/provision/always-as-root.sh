#!/usr/bin/env bash

#== Bash helpers ==

function info {
  echo " "
  echo "--> $1"
  echo " "
}

#== Provision script ==

info "Restart web-stack"
service php5-fpm restart
service nginx restart
service mysql restart

cat "/app/vagrant/provision/ascii-art/planet-express.txt"
