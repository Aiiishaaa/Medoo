<?php

$url = 'http://computerandu.wordpress.com/2011/06/29/how-to-get-google-invite/';
$emails = scrape_email($url);
echo implode($emails, ' ');

function scrape_email($url) {
    if ( !is_string($url) ) {
        return '';
    }
    //$result = @file_get_contents($url);
    $result = @curl_get_contents($url);
    
    if ($result === FALSE) {
        return '';
    }
    
    // Convert to lowercase
    $result = strtolower($result);
    
    // Replace EMAIL DOT COM
    $result = preg_replace('#[(\\[\\<]?AT[)\\]\\>]?\\s*(\\w*)\\s*[(\\[\\<]?DOT[)\\]\\>]?\\s*[a-z]{3}#ms', '@$1.com', $result);

    // Email matches
    preg_match_all('#\\b([\\w\\._]*)[\\s(]*@[\\s)]*([\\w_\\-]{3,})\\s*\\.\\s*([a-z]{3})\\b#msi', $result, $matches);
    
    $usernames = $matches[1];
    $accounts = $matches[2];
    $suffixes = $matches[3];
    $emails = array();
    for ($i = 0; $i < count($usernames); $i++) {
        $emails[$i] = $usernames[$i] . '@' . $accounts[$i] . '.' . $suffixes[$i];
    }
    
    return $emails;
}

function clean($str) {
    if ( !is_string($str) ) {
        return '';
    } else {
        return trim(strtolower($str));
    }
}

function curl_get_contents($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    // For https connections, we do not require SSL verification
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 5);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    $content = curl_exec($ch);
    //$error = curl_error($ch);
    //$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return $content;
}

?>
