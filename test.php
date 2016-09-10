<?php
    include("../mpdf60/mpdf.php");
	if(isset($_GET['type'])&&isset($_GET['roll'])){
		$type=$_GET['type'];
		$roll=$_GET['roll'];
		if(!empty($type)&&!empty($roll)){
			$mpdf=new mPDF('c','A4','','' , 0 , 0 , 0 , 0 , 0 , 0); 
			 
			$mpdf->SetDisplayMode('fullpage');
			 
			$mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list
			$link='http://localhost/smriti/res.php?type='.$type.'&roll='.$roll;
			$mpdf->WriteHTML(file_get_contents($link));
			         
			$mpdf->Output();
		}
	}
?>