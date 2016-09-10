<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

	<!-- Load Core Materialize CSS  -->
	<link href="./mat.min.css" rel="stylesheet">

	<!-- Custom styles for this site -->
	
	<link href="./ext.css" rel="stylesheet">
	<link href="./bs.min.css">
	
	<!-- Custom tags for the head tag -->
</head>

<?php	
	require 'connect_db.php';
	if(isset($_GET['type'])&&isset($_GET['roll'])){
		$type=$_GET['type'];
		$person=$_GET['roll'];
		if(!empty($type)&&!empty($person)){
			$query1="select * from `names` where `roll`='".$person."'";
			$query_run1=mysql_query($query1);
			$query2="select * from `names` where 1";
			$query_run2=mysql_query($query2);
			if($type==2)
				$op="Your Opinion on your friends ..<br>";
			else $op="Your Friends Think ..<br>";
			$data=array();
			while($dat=mysql_fetch_assoc($query_run2)){
				$data[$dat['roll']]['name']=$dat['name'];
				$data[$dat['roll']]['pic']=$dat['pic'];
			}

			if(mysql_num_rows($query_run1)!=0){
				$var1=mysql_fetch_assoc($query_run1);
				if($data[$var1['roll']]['pic']=='http://students.nitk.ac.in')
						$data[$var1['roll']]['pic']='img/presiwww.jpg';
				echo '<section class="container" style="padding-top:15px"><h2><center>Smriti testimonials </center></h2>
						<div class="row valign-wrapper">
							<div class="col s4">
								<div style="background:url('.$data[$var1['roll']]['pic'].');background-size:cover;background-repeat:no-repeat;background-position:45% 20%;padding-top:100%;width:100%;border-radius:50%"></div>	
							</div>
							<div class="col s6 offset-s2 offset-2" style="margin-left: 16.66667%!important;">
								<div class="row">
									<h4>'.$data[$var1['roll']]['name'].'</h4>
									<h6>'.$op.'</h6>
								</div>
							</div>
						</div>
					</section>
					<div class="divider"></div>';
				if($type==1){
					$query='select * from `entries` where `to` = "'.$person.'"';
					$t='from';
				}else{
					$query='select * from `entries` where `from` = "'.$person.'"';
					$t='to';
				}
				$query_run=mysql_query($query);
				while($var=mysql_fetch_assoc($query_run)){
					if($data[$var[$t]]['pic']=='http://students.nitk.ac.in')
						$data[$var[$t]]['pic']='img/presiwww.jpg';

					echo '<div class="row center-align" style="padding-top:10px;width:80%!important;margin: 0px 10% 20px;">
							<div class="col s12 m8 offset-m2 offset-l2" style="width:100%!important;margin-left:0!important">
								<div class="card grey lighten-3 waves-effect waves-block waves-light custom-card valign-wrapper">
									<div class="card-content black-text">
										<div class="row valign-wrapper">
											<div class="col s4">
												<div style="background:url('.$data[$var[$t]]['pic'].');background-size:cover;background-repeat:no-repeat;background-position:45% 20%;padding-top:100%;width:100%;border-radius:50%"></div>	
											</div>
											<div class="col s8">
												<h4>'.$data[$var[$t]]['name'].'</h4>
											</div>
										</div>
										<div class="divider"></div>
										<div class="container left-align" style="padding-top:10px">
											'.$var['testimonial'].'
										</div>
									</div>
								</div>
							</div>
						</div>';
				}
			}
		}
	}
?>