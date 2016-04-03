#!/bin/bash
symfony new $1 3.0
cp di/.gitignore $1
find $1 -name ".htaccess" -type f -delete