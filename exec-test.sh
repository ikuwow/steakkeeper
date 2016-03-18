#!/bin/sh

vendor/bin/phpcs -p --extensions=php --standard=vendor/cakephp/cakephp-codesniffer/CakePHP ./src ./tests ./config ./webroot --ignore=./config/Migrations
vendor/bin/phpunit


