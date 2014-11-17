<?php
//open imap stream
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
imap_reopen($mail,$url."INBOX");
echo "<br/>there are ". imap_num_msg($mail) . " INBOX";
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
//get structure of INBOX
//messagenum:1 multi-part
$structure=imap_fetchstructure($mail,1);
echo "<br/>".str_repeat("=",80)."<br/>";
echo "primary body type:".$structure->type."<br/>";
echo "body transfer encoding:".$structure->encoding."<br/>";
echo "parts:";
var_dump($structure->parts);
$body=imap_fetchbody($mail,1,1);
echo iconv('GB2312','UTF-8',$body);
//messagenum:4 it's text type,and encode is base64
$structure=imap_fetchstructure($mail,4);
echo "<br/>".str_repeat("=",80)."<br/>";
echo "primary body type:".$structure->type."<br/>";
echo "body transfer encoding:".$structure->encoding."<br/>";
//get body's content when body's type is text(0)
$body=imap_fetchbody($mail,4,1);
$f=fopen('test.txt','w');
fwrite($f,imap_base64($body));
fclose($f);
