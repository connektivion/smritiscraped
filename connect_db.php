<?php
	if(!(@mysql_connect('localhost','root',''))||!(@mysql_select_db('smriti'))){
		echo"we are temporarily down..cant connect";
		die();
	}
?>