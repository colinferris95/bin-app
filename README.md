# bin-app
Bin application readme
Built using php7.4 and Laminas 3

To Install:

Go to the release/tag section on github

download release 0.0.2

unzip in a directory

cd into the the directory on terminal


can use local php or docker to start server:

PHP
php -S 0.0.0.0:8080 -t public public/index.php

Docker
docker-compose up -d --build 

Can access either the "width" or "frequency" filters

requests:

Frequency

curl --location --request POST 'http://localhost:8080/binutil/frequency' \
--form 'inputData="0.1, 3.4, 3.5, 3.6, 7.0, 9.0, 6.0, 4.4, 2.5, 3.9, 4.5, 2.8"'

expected output:
{
    "High": [
        "4.5",
        "6.0",
        "7.0",
        "9.0"
    ],
    "Medium": [
        "3.5",
        "3.6",
        "3.9",
        "4.4"
    ],
    "Low": [
        "0.1",
        "2.5",
        "2.8",
        "3.4"
    ]
}

Logic: each bin will have the same number of items 12/3 = 4 items in each bin

Width

curl --location --request POST 'http://localhost:8080/binutil/width' \
--form 'inputData="0.1, 3.4, 3.5, 3.6, 7.0, 9.0, 6.0, 4.4, 2.5, 3.9, 4.5, 2.8"'

expected output

{
    "High": [
        "7.0",
        "9.0"
    ],
    "Medium": [
        "3.4",
        "3.5",
        "3.6",
        "3.9",
        "4.4",
        "4.5",
        "6.0"
    ],
    "Low": [
        "0.1",
        "2.5",
        "2.8"
    ]
}

Logic: each bin has the same interval, decided by the highest number/3 9.0/3 = 3 so each bin is 0-3,3-6,6-9

Run test suite
./vendor/bin/phpunit --testsuite BinUtil


