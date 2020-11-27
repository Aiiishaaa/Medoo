<?php
include 'email_scraper.php' ;
$url = 'https://github.com/nyxgeek/username-lists/blob/master/usernames-top100/usernames_gmail.com.txt';
$emails = scrape_email($url);
echo implode('<br>',$emails);
?>