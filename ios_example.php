<?php
use xmpush\IOSBuilder;
use xmpush\Sender;
use xmpush\Constants;
use xmpush\Stats;
use xmpush\Tracer;
use xmpush\Region;

include_once(dirname(__FILE__) . '/autoload.php');

$secret = 'your app secret';
$bundleId = 'your app bundleId';

Constants::setBundleId($bundleId);
Constants::setSecret($secret);

$aliasList = array('2', 'alias2');
$desc = '这是一条mipush推送消息';
$payload = '{"test":1,"ok":"It\'s a string"}';

$message = new IOSBuilder();
$message->description($desc);
$message->soundUrl('default');
$message->badge('4');
$message->timeToLive(604800000); //可选项, 消息的生命周期, 若用户离线, 设置消息在服务器保存的时间, 单位: ms
$message->extra('payload', $payload);
$message->build();

$sender = new Sender();
// $sender->setRegion(Region::China);// 支持海外
print_r($sender->sendToAliases($message, $aliasList)->getRaw());

?>
