<?php

//import the converter class
require('image_converter.php');

if($_FILES){
	$obj = new Image_converter();
	
	//call upload function and send the $_FILES, target folder and input name
	$upload = $obj->upload_image($_FILES, 'uploads', 'fileToUpload');
	if($upload){
		$imageName = urlencode($upload[0]);
		$imageType = urlencode($upload[1]);
		
		if($imageType == 'jpeg'){
			$imageType = 'jpg';
		}
		header('Location: convert.php?imageName='.$imageName.'&imageType='.$imageType);
	}
}	
?>
<html>
<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<style>
*,
		*:after,
		*:before{
		 -webkit-box-sizing: border-box;
		 -moz-box-sizing: border-box;
		 -ms-box-sizing: border-box;
		 box-sizing: border-box;
		}
	body{
		 font-family: arial;
		 font-size: 16px;
		 margin: 0;
		 background: linear-gradient(133deg, #4abeb2, #3c57d2);
		 color: #000;
		 align-items: center;
		 justify-content: center;
	}
	table{
		margin-top:200px;
		background: white;
		padding:30px;
		width:600px;
		height:300px;
	}
	tr,td{
		padding:10px;
		
	}
	
</style>
<script>
	function checkEmpty(){
		var img = document.getElementById('fileToUpload').value;
		if(img == ''){
			alert('Please upload an image');
			return false;
		}
		return true;
	}
</script>
</head>
<body>
	<table width="500" align="center">
		<tr><td align="center">	<h2 align="center">Image Converter</h2></td></tr>
		<tr><td align="center"><h4>Convert Any image to JPG, PNG</h4></td></th>
		<tr>
			<td align="center">
				<form action="" enctype="multipart/form-data" method="post" onsubmit="return checkEmpty()" />
					<input type="file" name="fileToUpload" id="fileToUpload" class="form-control my-3" />
					<input type="submit" value="Upload" class="btn btn-danger"/>
				</form>
			</td>
		</tr>
	</table>
</body>
</html>