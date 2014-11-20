<?php
use Drivers\ImapDriver;
$driver=new ImapDriver('774590565','zsk2aixgp','imap.qq.com',993,TRUE);
$connection=new Connection($driver);
$boxes=$connection->getMailboxes();
var_dump($boxes);
?>
