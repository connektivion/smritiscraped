<?php
	require 'connecta_db.php';
	include 'mcurl.php';
	function scrapper($tid){

		$lnk="http://students.nitk.ac.in/smriti/testimonial/".$tid;
		$results_page=curl($lnk);

		if($results_page!=""&&$results_page=='Not Found')
			return;

		$testimonial=scrape_between($results_page,'<div class="flow-text container" style="padding:20px">','</div>');
		$sender=scrape_between($results_page,'<a class="btn-floating btn-large waves-effect waves-light blue lighten-3" href="/smriti/profiles/','">');
		$roll=scrape_between($results_page,'<a class="btn-floating btn-large waves-effect waves-light teal lighten-3" href="/smriti/profiles/','">');
		
		$query1="select `to` from `entries` where `to` = '".$roll."' and `from` = '".$sender."' and `tid`=".$tid."";
		$query_run1=mysql_query($query1);
		if(mysql_num_rows($query_run1)==0){
			$query="INSERT INTO `entries`(`to`, `from`, `testimonial`,`tid`) VALUES ('".$roll."','".$sender."','".mysql_real_escape_string($testimonial)."',".$tid.")";	
			$query_run=mysql_query($query);
			if(!$query_run)
				echo $sender." ".$roll."<br>";
				echo $query;
		}
		//echo $testimonial."<br>".$sender."<br>".$roll."<br>".$tid;
	}
	for($i=2;$i<=10000;$i++)
		scrapper($i);
	//scrapper(1);
?>
