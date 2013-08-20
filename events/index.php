<?php
/**
 * User: denis
 * Date: 2013-08-18
 */

$today = date('Y-m-d');
if($today >= '2013-08-21' && $today < '2013-08-28'){
    // 1316 Jones St. Google+ Event
    header('Location: https://plus.google.com/events/cn1lvev7litk19ce69dprchm0j0');
    exit;

}elseif($today >= '2013-08-28' && $today < '2013-09-05'){
    // Ballyroe Google+ Event
    header('Location: https://plus.google.com/events/c9dikq3bhauqotqgdfe7pge3i78');
    exit;

}else{
    // No Event
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Events | Denis & Britain's Wedding Reception</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?php echo 'http://'.$_SERVER["HTTP_HOST"].'/imgs/favicon.ico'; ?>" type="image/x-icon"/>
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Merienda+One' type='text/css'/>

        <style>
            #main{
                font-family: 'Merienda One', cursive;
                font-size: 14px;
                width: 510px;
                text-align: center;
                margin: auto;
                padding-top: 50px;
            }
            body{
                background: #222;
                color: #e9e9e9;
            }
            #main a:link,
            #main a:visited,
            #main a:hover{
                color: #3299bb;
            }
        </style>
    </head>
    <body>
    <div id="container">
        <div id="main">
            <h1>404 | Oops!</h1>
            <br/><br/>
            <p>It seems that you that there aren't any events around this time.</p>
        </div>
    </div>
    </body>
    </html>

<?php } ?>