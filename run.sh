#!/bin/bash

clear
echo -e "\e[36m"
echo "╔══════════════════════════════════════╗"
echo "║        INPUT FLOW LAB - SERVER        ║"
echo "╠══════════════════════════════════════╣"
echo "║  Status   : RUNNING                   ║"
echo "║  Host     : 127.0.0.1                 ║"
echo "║  Port     : 8000                      ║"
echo "║  Logs     : data.txt                  ║"
echo "╚══════════════════════════════════════╝"
echo -e "\e[0m"

# Clean old data
touch data.txt

echo -e "\e[33m[+] Waiting for input...\e[0m"
echo "----------------------------------------"

# Start PHP silently
php -S 127.0.0.1:8000 > /dev/null 2>&1 &

PHP_PID=$!

# Live data view
tail -f data.txt

# On CTRL+C
trap "kill $PHP_PID; echo 'Server stopped'; exit" INT
