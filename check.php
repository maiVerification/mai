<?php 
header("Content-Type:text/html; charset=utf-8");



$getcode = $_GET['getcode'];


if($getcode == md5("MAIC777777")){

	$yan = 'c72360d4394d2f8b56c03484ff00ffd99e72e386';
	echo $yan;
}

if($getcode == md5("MAIC666666")){
	
	$yan = $_GET['yan'];

	//加密地址接口地址返回
	$data = doGet("http://api.58muzi.com/api/public/Lotteryinformation");

	$data = json_decode($data,true);

    $html = "";

	foreach ($data['result']['list'] as $key => $value) {
		$html .="<li class='on'><div class='s1'>";
		$html .=$value['hash'];
		$html .="</div><div class='s2 txt-red'>";
		$html .=$value['escape_multiple'];
		$html .="</div></li>";
	}

	$data1 = doGet("http://api.58muzi.com/api/public/Lotteryinformation?hash=".$yan);
	$result = json_decode($data1,true);

	$arr['html'] = $html;
	$arr['hash'] = $result['result']['list'][0]['hash'];
	$arr['probability'] = $result['result']['list'][0]['escape_multiple'];

	echo json_encode($arr);exit;
}

if($getcode == md5("MAIC888888")){
	$yan = $_GET['yan'];
	//probability
	$data = doGet("http://api.58muzi.com/api/public/Lotteryinformation?hash=".$yan);
	$result = json_decode($data,true);

	$arr['hash'] = $result['result']['list'][0]['hash'];
	$arr['probability'] = $result['result']['list'][0]['escape_multiple'];

	echo json_encode($arr);exit;
}



function doGet($url)
{
    //初始化
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$url);
    // 执行后不直接打印出来
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    // 跳过证书检查
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // 不从证书中检查SSL加密算法是否存在
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    //执行并获取HTML文档内容
    $output = curl_exec($ch);

    //释放curl句柄
    curl_close($ch);

    return $output;
}
?>