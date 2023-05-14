<?php 

//import the converter class
require('image_converter.php');

$imageType = '';
$download = false;

//handle get method, when page redirects
if($_GET){	
	$imageType = urldecode($_GET['imageType']);
	$imageName = urldecode($_GET['imageName']);
}else{
	header('Location:index.php');
}

//handle post method when the form submitted
if($_POST){
	
	$convert_type = $_POST['convert_type'];
	
	//create object of image converter class
	$obj = new Image_converter();
	$target_dir = 'uploads';
	//convert image to the specified type
	$image = $obj->convert_image($convert_type, $target_dir, $imageName);
	
	//if converted activate download link 
	if($image){
		$download = true;
	}
}


//convert types
$types = array(
	'png' => 'PNG',
	'jpg' => 'JPG',
);
?>
<html>
<head>
<style>
img{
	max-width: 360px;
	height:400px;
}
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
		font-size:30px;
		color:white;
	}
	tr,td{
		padding:20px;
	}
</style>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
	<?php if(!$download) {?>
		<form method="post" action="">
			<table width="500" align="center">
				<tr>
					<td align="center">
						File Uploaded, Select below option to convert!
						<br/>
						<img src="uploads/<?=$imageName;?>"  />
					</td>
				</tr>
				<tr>
					<td align="center">
						Convert To: 
							<select name="convert_type" class="form-control">
								<?php foreach($types as $key=>$type) {?>
									<?php if($key != $imageType){?>
									<option value="<?=$key;?>"><?=$type;?></option>
									<?php } ?>
								<?php } ?>
							</select>
							<br/>
					</td>
				</tr>
				<tr>
					<td align="center"><input type="submit" value="convert" class="btn btn-danger" /></td>
				</tr>
			</table>
		</form>
	<?php } ?>
	<?php if($download) {?>
		<table width="500" align="center">
				<tr>
					<td align="center">
						Image Converted to <?php echo ucwords($convert_type); ?><br/>
						<img src="<?=$target_dir.'/'.$image;?>" style="margin:10px;"  />
					</td>
				</tr>
				<td align="center">
				
					<a href="download.php?filepath=<?php echo $target_dir.'/'.$image; ?>" class="btn btn-success" />Download Converted Image</a>
				</td>
			</tr>
			<tr>
				<td align="center"><a href="index.php" class="btn btn-danger">Convert Another</a></td>
			</tr>
		</table>
	<?php } ?>
</body>
</html>