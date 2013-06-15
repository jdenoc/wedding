<?php
/**
 * Created by: denis
 * Created on: 2013-06-15
 *
 * Takes in a url from .htaccess file, converts it to lowercase and redirects the user to the correct location.
 * SRC: http://simonholywell.com/post/2012/11/force-lowercase-urls-rewrite-php.html
 */

if(isset($_GET['rewrite-strtolower-url'])) {
    $url = $_GET['rewrite-strtolower-url'];
    unset($_GET['rewrite-strtolower-url']);
    $params = http_build_query($_GET);
    if(strlen($params)) {
        $params = '?' . $params;
    }
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/' . strtolower($url) . $params, true, 301);
    exit;
}
header("HTTP/1.0 404 Not Found");
die('Unable to convert the URL to lowercase. You must supply a URL to work upon.');