#!/bin/bash

composer dump-autoload

php artisan migrate:fresh --env="testing"

php artisan test
