#!/bin/bash

# Check if PHP is installed
if ! [ -x "$(command -v php)" ]; then
    echo 'Error: PHP is not installed.' >&2
    sudo apt install php-cli php-mysql php-curl
fi

# Check if zip is installed
if ! [ -x "$(command -v zip)" ]; then
    echo 'Error: zip is not installed.' >&2
    sudo apt install zip
fi

# Check if Composer is installed
if ! [ -x "$(command -v composer)" ]; then
    echo 'Error: Composer is not installed.' >&2
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
    php -r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    php composer-setup.php
    php -r "unlink('composer-setup.php');"

    sudo mv composer.phar /usr/local/bin/composer
fi

# Check if Laravel is installed with composer show and grep -c
if [ $(composer show | grep -c laravel) -eq 0 ]; then
    echo 'Error: Laravel is not installed.' >&2
    composer global require laravel/installer
fi

# Enable php extensions: dom, xml
if ! [ $(command -v php -m | grep -c xml) -eq 0 ]; then
    echo 'Error: PHP extension dom is not enabled.' >&2
    sudo apt install php-xml
fi
# Check if sqlite is installed and install based on user input
if ! [ $(command -v php -m | grep -c sqlite3) -eq 0 ]; then
    echo 'Error: sqlite3 is not installed.' >&2
    read -p "Do you want to install sqlite3? (y/n) " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Yy]$ ]]; then
        sudo apt install php-sqlite3
    fi
fi

# Curl
if ! [ $(command -v php -m | grep -c curl) -eq 0 ]; then
    echo 'Error: PHP extension curl is not enabled.' >&2
    sudo apt install php-curl
fi

# mbstring
if ! [ $(command -v php -m | grep -c mbstring) -eq 0 ]; then
    echo 'Error: PHP extension mbstring is not enabled.' >&2
    sudo apt install php-mbstring
fi