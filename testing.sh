#!/usr/bin/env bash

ACT=$1

if [ "$ACT" = "start" ]; then
  php ./artisan queue:work redis --sleep=3 --tries=3 --daemon &
  laravel-echo-server start &
  php ./artisan emulate:cron-api &
else
  for pid in $(ps -ef | awk '/php .\/artisan/ {print $2}'); do kill -9 $pid; done
  pkill laravel-echo-server
fi