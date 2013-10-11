<?php
	require_once '../tool/SQLHelper.php';
	$name = $_POST['name'];
	$price_before = $_POST['price_before'];
	$price_now = $_POST['price_now'];
	$freight = $_POST['freight'];
	$detail = $_POST['detail'];
	$color = $_POST['color'];
	$size = $_POST['size'];


	$flag = 0;
    foreach($_FILES['file']['error'] as $item){
        if($item > 0){
            $flag = 1;
        }
    }

    if(empty($name) || empty($price_before) || empty($price_now) || empty($freight) || empty($color) || empty($size) || $flag){
        echo "error";
        exit();
    }
	
	$color_json = '[';
	for($i = 0;$i < count($color); $i++){
		$color_json .= '{"color":"'.$color[$i].'"},';
	}
	$color_json = rtrim($color_json, ",");
	$color_json .= ']';

	$size_json = '[';
	for($i = 0;$i < count($size); $i++){
		$size_json .= '{"color":"'.$size[$i].'"},';
	}
	$size_json = rtrim($size_json, ",");
	$size_json .= ']';

	$temp = '[';
    for($i = 0; $i < count($_FILES['file']['name']); $i++){
        $filename = "../upload/img/".time().rand(1,1000).$_FILES['file']['name'][$i];
		move_uploaded_file($_FILES["file"]["tmp_name"][$i], $filename);
        $temp .= '{"img":"'.$filename.'"},';
    }
    $temp = rtrim($temp, ",");
    $temp .= ']';

	$sqlHelper = new SQLHelper();
	$sql = "insert into goods(name,price_before,price_now,freight,detail,color,size,img) values('$name','$price_before','$price_now','$freight','$detail','$color_json','$size_json','$temp')";
	$res = $sqlHelper->dml($sql);
	$sqlHelper->close();
    if($res){
        echo "ok";
        exit();
    }else{
        echo "error";
        exit();
    }
?>