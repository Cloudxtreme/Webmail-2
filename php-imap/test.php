<?php
require "classes/imap.class.php";
$imap=new Imap('imap.qq.com','774590565','zsk2aixgp');
$email=$imap->returnEmailMessageArr(1);
var_dump($email);
echo "<br/>";
$imapObj=$imap->returnImapMailBoxmMsgInfoObj();
var_dump($imapObj);
echo "<br/>";
$mailBoxattr=$imap->returnMailboxListArr();
var_dump($mailBoxattr);
echo "<br/>";
$emailArr=$imap->returnMailBoxHeaderArr("INBOX");
var_dump($emailArr);
?>
