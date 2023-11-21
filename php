#!/bin/bash
docker run --rm -v $(pwd):/var/www/html --network host php:8.2-cli php "$@"