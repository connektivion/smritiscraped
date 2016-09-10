<?php
	require 'connect_db.php';
	$query="select * from `names` where 1";
	$query_run=mysql_query($query);
	$arr=array();
	while($var=mysql_fetch_assoc($query_run)){
		$temp=array();
		$temp['value']=$var['name'];
		$temp['roll']=$var['roll'];
		if($var['pic']=='http://students.nitk.ac.in')
			$var['pic']='img/presiwww.jpg';
		$temp['pic']=$var['pic'];
		array_push($arr,$temp);
	}
	$arr1= json_encode($arr);
?>
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
<body>
	<div class="container">
		<section style="padding-top:15px">
			<div class="row">
				<form class="col s12" action='' method=''>
					<div class="row center-align">
						<div class="card white lighten-2 lighten-3 waves-light valign-wrapper z-depth-2">
							<div class="input-field col s12 m8 offset-l2">

								<i class="material-icons prefix">search</i>
								<input id="icon_prefix" type="text" name="search_param" class="autocomplete inputFields">
								<label for="icon_prefix">Search for the Name/Roll No</label>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
	<script src="jquery.min.js"></script>
	<script src="mat.js"></script>
	<script>
		var goto=function(url){
			window.location='./res.php?type=1&roll='+url;
		};
	$('document').ready(function() {
		var input_selector = 'input[type=text], input[type=password], input[type=email], input[type=url], input[type=tel], input[type=number], input[type=search], textarea';
		/**************************
		* Auto complete plugin  *
		*************************/
		$(input_selector).each(function() {
			var $input = $(this);
			if ($input.hasClass('autocomplete')) {
				var $array = $input.data('array'),
				$inputDiv = $input.closest('.input-field'); 
				if ($array !== '') {
					var $html = '<ul class="autocomplete-content hide">';
					for (var i = 0; i < $array.length; i++){
						if ($array[i]['path'] !== '' && $array[i]['path'] !== undefined && $array[i]['path'] !== null && $array[i]['class'] !== undefined && $array[i]['class'] !== '') {
							$html += '<li class="autocomplete-option par"><img src="' + $array[i]['path'] + '" class="' + $array[i]['class'] + '"><span>' + $array[i]['value'] + '</span></li>';
						}else{
							$html += '<li class="autocomplete-option par" onclick=goto("'+$array[i]['roll']+'");><img class="circle responsive-img" src="'+ $array[i]['pic']+'"/><span>' + $array[i]['value']+' '+$array[i]['roll'] +'</span><div style="margin-top:2px;"> <i class="material-icons small">visibility</i> <a target="_blank" class="waves-effect waves-light btn chi" href="./res.php?type=1&roll='+$array[i]['roll']+'">Friends Wrote</a>&nbsp;&nbsp;&nbsp;<a target="_blank" class="waves-effect waves-light btn chi" href="./res.php?type=2&roll='+$array[i]['roll']+'">U Wrote</a></div><div style="margin-top:2px;"><i class="small material-icons">print</i><a target="_blank" class="waves-effect waves-light btn chi" href="./test.php?type=1&roll='+$array[i]['roll']+'">Friends Wrote</a>&nbsp;&nbsp;&nbsp;<a target="_blank" class="waves-effect waves-light btn chi" href="./test.php?type=2&roll='+$array[i]['roll']+'">U Wrote</a></div></li>';
						}
					}
					$html += '</ul>';
					$inputDiv.append($html);

					function highlight(string) {
						$('.autocomplete-content li').each(function() {
							var matchStart = $(this).text().toLowerCase().indexOf("" + string.toLowerCase() + ""),
							matchEnd = matchStart + string.length - 1,
							beforeMatch = $(this).text().slice(0, matchStart),
							matchText = $(this).text().slice(matchStart, matchEnd + 1),
							afterMatch = $(this).text().slice(matchEnd + 1);
							$(this).html("<span>" + beforeMatch + "<span class='highlight'>" + matchText + "</span>" + afterMatch + "</span>");
						});
					}

					$(document).on('keyup', $input, function() {
						var $val = $input.val().trim(),
						$select = $('.autocomplete-content');
						$select.css('width',$input.width());

						if ($val != '') {
							$select.children('li').addClass('hide');
							$select.children('li').filter(function(){
								$select.removeClass('hide');
								if ($input.hasClass('highlight-matching')) {
									highlight($val);
								}
								var check = true;
								for (var i in $val){
									if ($val[i].toLowerCase() !== $(this).text().toLowerCase()[i])
										check = false;
								};
								return check ? $(this).text().toLowerCase().indexOf($val.toLowerCase()) !== -1 : false;
							}).removeClass('hide');
						} else {
						$select.children('li').addClass('hide');
						}
					});

					$('.chi').click(function(e){
					  e.stopPropagation();
					});
				} else {
					return false;
				}
			}
		});
	});
	</script>
	<style>
		.autocomplete-content {
			margin-left: 9%;
			background: #383838;
			margin-top: -.9rem;
		}

		.autocomplete-content li {
			clear: both;
			color: rgba(0, 0, 0, 0.87);
			cursor: pointer;
			line-height: 0;
			width: 100%;
			text-align: left;
			text-transform: none;
			padding: 10px;
		}

		.autocomplete-content li span {
			color: #ffa726;
			font-size: .9rem;
			padding: 1.2rem;
			display: block;
		}

		.autocomplete-content li span .highlight {
			color: #000000;
		}

		.autocomplete-content li img {
			height: 52px;
			width: 52px;
			padding: 5px;
			margin: 0 15px;
		}

		.autocomplete-content li:hover {
			background: #eee;
			cursor: pointer;
		}

		.autocomplete-content > li:hover {
			background: #292929;
		}
	</style>
	<script>
		var stateData=<?php echo $arr1; ?>;
		$('#icon_prefix').data('array', stateData);
	</script>
</body>