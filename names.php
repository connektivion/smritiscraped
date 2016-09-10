<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>Smriti 2016</title>

	<!-- Load Core Materialize CSS  -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Custom styles for this site -->
	
	<link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
	
	<!-- Custom tags for the head tag -->
</head>
<?php
	require 'connect_adb.php';
	include 'mcurl.php';
	$results_page= curl("http://students.nitk.ac.in/smriti/browse/");

	$results_page = scrape_between($results_page, '<ul class="collapsible collection with-header z-depth-2" data-collapsible="accordion">', '</ul>'); // Scraping out only the middle section of the results page that contains our results
	
	$separate_results = explode('<a href="/smriti/profiles', $results_page);   // Expploding the results into separate parts into an array

	// For each separate result, scrape the URL
	foreach ($separate_results as $separate_result) {
		if ($separate_result != "") {
			if(scrape_between($separate_result, '/', '"')!=""){
				//$results_urls[] =  scrape_between($separate_result, 'href="', '">');
				if(scrape_between($separate_result, '<span class="secondary-content">', '</span>')!=""){
					$roll=scrape_between($separate_result, '<span class="secondary-content">', '</span>');
					$nm=scrape_between($separate_result,'class="collection-item">','<');
					$query="INSERT INTO `names`(`name`, `roll`) VALUES ('".$nm."','".$roll."')";
					$query_run=mysql_query($query);
				}
			}
		}
	}
?>