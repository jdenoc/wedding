<?php   // update_info.php (ADMIN)
require_once('../../res/connection.php');
$db = new pdo_connection('jdenocco_wedding');
$db->getAllRows("SELECT * FROM info");

$new_info = array();
echo 'keys:<br/>';
foreach($_POST as $key=>$entry){
    echo '<br/><br/>ORIGINAL:'.$key.'  '.$entry.'<br/>';
    $key_explode = explode('_', $key);
    if(is_numeric($key_explode[0])){
        $event = ($key_explode[1]=='event')? $entry : $db->getValue("SELECT `event` FROM info WHERE `id`=:id",
            array('id'=>$key_explode[0]));
        $type = ($key_explode[1]=='type')? $entry : $db->getValue("SELECT `type` FROM info WHERE `id`=:id",
            array('id'=>$key_explode[0]));
        $text = ($key_explode[1]=='text')? $entry : $db->getValue("SELECT `text` FROM info WHERE `id`=:id",
            array('id'=>$key_explode[0]));

        if(  $db->update('info', array(
                'event'=>addslashes($event),
                'type'=>addslashes($type),
                'text'=>addslashes($text)),
            array('id'=>$key_explode[0]))
        ){
            echo '***updated: '.$key_explode[0].'  '.$event.' - '.$type.' - '.$text;
        }
    }else{
        echo '<br/>To insert: '.($key_explode[1]).' - '.addslashes($entry);
        switch($key_explode[1]){
            case 'event':
                if($entry != '') $new_info['event'] = addslashes($entry);
                break;
            case 'type':
                if($entry != '') $new_info['type'] = addslashes($entry);
                break;
            case 'text':
                if($entry != '') $new_info['text'] = addslashes($entry);
                break;
        }
        print_r($new_info);
    }
}

if(!empty($new_info)){
    $db->insert("info", $new_info);
    echo 'inserted: ';
    print_r($new_info);
}

$db->closeConnection();
header("Location: ../admin.php");
exit;
?>