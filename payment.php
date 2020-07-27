<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		echo "heya";
		$email=$_POST['email'];
		$img=addslashes(file_get_contents($_FILES["images"]["tmp_name"]));
		echo '<img src="data:image/jpeg;base64,'.base64_encode($img ).'"" />';
	}
?>