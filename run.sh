grep -E 'Vilnius|LH|ZB' all-cables.csv > lt-cables.csv
php -f lt-analysis.php > lt-cables.html
