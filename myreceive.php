<?php
header("title:hello");
date_default_timezone_set("Asia/Chongqing");
//date_default_timezone_set("Asia/Kolkata");
$url="{imap.qq.com:993/imap/ssl}";
$mail=imap_open($url,'774590565','zsk2aixgp');
$folders=imap_list($mail,$url,'*');
echo "<h2>list folders:</h2><br/>";
foreach($folders as $folder){
	echo $folder."<br/>";
}
echo "<h2>open inbox </h2><br/>";
imap_reopen($mail,$url."INBOX");
echo "<h2>get overview of inbox</h2> <br/>";
$overviews=imap_fetch_overview($mail,"1:4");
foreach($overviews as $overview){
	echo str_repeat('=',80)."<br/>";
	echo "subject decode:".imap_mime_header_decode($overview->subject)[0]->charset."<br/>";
	echo "subject:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->subject)[0]->text)."<br/>";
	echo "from:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->from)[0]->text)."<br/>";
	echo "to:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->to)[0]->text)."<br/>";
	echo "date:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->date)[0]->text)."<br/>";
	//echo "message_id:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->message_id)[0]->text)."<br/>";
	//echo "in_reply_to:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->in_reply_to)[0]->text)."<br/>";
	echo "size:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->size)[0]->text)."<br/>";
	//echo "uid:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->from)[0]->uid)."<br/>";
	echo "msgno:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->msgno)[0]->text)."<br/>";
	echo "recent:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->recent)[0]->text)."<br/>";
	echo "seen:".iconv("GBK","UTF-8",imap_mime_header_decode($overview->seen)[0]->text)."<br/>";
}
echo "<h2>get structure and body</h2><br/>";
echo "in structure there are structure information about email,like transfer encoding,content type and ..<br/>";
for($i=1;$i<=10;$i++){
	echo str_repeat('=',80)."<br/>";
	$structure=imap_fetchstructure($mail,$i);
	echo "primarty body type is ".$structure->type."<br/>";
	echo "body transfer encoding is ".$structure->encoding."<br/>";
	echo "if have a description ".$structure->ifdescription."<br/>";
	echo "structure's parts is <br/>";
	echo var_dump($structure->parts)."<Br/>";
	foreach($structure->parts as $key=>$value){
		$t_encoding=$structure->parts[$key]->encoding;
		$message=imap_fetchbody($mail,$i,$key+1);
		if($t_encoding==0 or $t_encoding==1){
			$message=imap_8bit($message);
		}
		else if($t_encoding==2){
			$message=imap_binary($message);
		}
		else if($t_encoding==3){
			$message=imap_base64($message);
		}
		else if($t_encoding==4){
			$message==quoted_printable_decode($message);
		}
}
?>
