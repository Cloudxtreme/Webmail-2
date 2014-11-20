<?php
//open imap stream
date_default_timezone_set('Asia/Chongqing');
$url="{imap.qq.com:993/imap/ssl}";
$mail=imap_open($url,'774590565','zsk2aixgp');
//get folder list
$folders=imap_list($mail,$url,"*");
foreach($folders as $folder){
	echo $folder."<br/>";
}
//get reivew of drafts box
imap_reopen($mail,$url."Drafts");
echo "there are ". imap_num_msg($mail) . " Drafts";
$drafts=imap_fetch_overview($mail,"1:4");
foreach($drafts as $draft){
	echo "<br/>".str_repeat("=",80)."<br/>";
	echo "subject:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->subject)[0]->text)."<br/>";
	echo "from:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->from)[0]->text)."<br/>";
	//echo "to:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->to)[0]->text)."<br/>";
	echo "date:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->date)[0]->text)."<br/>";
	echo "message_id:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->message_id)[0]->text)."<br/>";
	echo "size:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->size)[0]->text)."<br/>";
	echo "uid:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->uid)[0]->text)."<br/>";
	echo "recent:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->recent)[0]->text)."<br/>";
}
//get reivew of INBOX box
imap_reopen($mail,$url."Drafts");
echo "<br/>there are ". imap_num_msg($mail) . " INBOX";
$drafts=imap_fetch_overview($mail,"1:2");
foreach($drafts as $draft){
	echo "<br/>".str_repeat("=",80)."<br/>";
	echo "subject:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->subject)[0]->text)."<br/>";
	echo "from:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->from)[0]->text)."<br/>";
	//echo "to:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->to)[0]->text)."<br/>";
	echo "date:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->date)[0]->text)."<br/>";
	echo "message_id:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->message_id)[0]->text)."<br/>";
	echo "size:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->size)[0]->text)."<br/>";
	echo "uid:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->uid)[0]->text)."<br/>";
	echo "recent:".iconv("GB2312","UTF-8",imap_mime_header_decode($draft->recent)[0]->text)."<br/>";
}
//get structure of INBOX
//messagenum:1 multi-part,tranfer encoding is 0
$structure=imap_fetchstructure($mail,'2');
echo "<br/>".str_repeat("=",80)."<br/>";
echo "primary body type:".$structure->type."<br/>";
echo "body transfer encoding:".$structure->encoding."<br/>";
echo "parts:";
var_dump($structure);
if($structure->parts){
	foreach($structure->parts as $key => $value){
		$t_encoding=$structure->parts[$key]->encoding;
		//$name=$structure->parts[$key]->dparameters[0]->value;
		$message=imap_fetchbody($mail,'2',$key+1);
		$encoding=$structure->parts[$key]->parameters[0]->value;
		echo "<br/>===================".$encoding."-------------------<br/>";
		echo "part".$key."<br/>";
		if($t_encoding ==0 or $t_encoding ==1){
			$message=imap_8bit($message);
		}
		else if($t_encoding==2){
			$message=imap_binary($message);
		}
		else if($t_encoding==3){
			$message=imap_base64($message);
		}
		else if($t_encoding==4){
			$message=quoted_printable_decode($message);
		}
		if($encoding=='gb2312'){
			echo iconv("GB2312","UTF-8",$message);
		}
		else if($encoding=='utf-8'){
			echo $message;
		}
		if($structure->parts[$key]->parameters[0]->attribute=='charset'){
			$message=iconv('GB2312','UTF-8',$message);
			echo $message."<br/>";
		}
	}
}
//messagenum:4 it's text type,and transfer encoding is base64
$structure=imap_fetchstructure($mail,2);
	echo "<br/>".str_repeat("=",80)."<br/>";
	echo "primary body type:".$structure->type."<br/>";
	echo "body transfer encoding:".$structure->encoding."<br/>";
	//get body's content when body's type is text(0)
	$body=imap_fetchbody($mail,2,'1');
	$f=fopen('test.txt','w');
	fwrite($f,imap_base64($body));
	fclose($f);
