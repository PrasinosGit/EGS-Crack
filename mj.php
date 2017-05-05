<?php
header("Content-Type:text/html;charset=utf-8");
@set_time_limit(6); 
function udpGet($sendMsg = '', $ip = '172.19.20.4', $port = '9000'){  
    $handle = stream_socket_client("udp://{$ip}:{$port}", $errno, $errstr);  
    if( !$handle ){  
        die("ERROR: {$errno} - {$errstr}\n");  
    }  
    fwrite($handle,$sendMsg);  
    $result = fread($handle, 1024);  
    fclose($handle);  
	 return $result;  
}  
@$zt=$_GET['zt'];
@$ip=$_GET['ip'];
/*设置发送数据*/	
if(isset($zt)&&isset($ip)){	
$start_time=microtime(true); 
	if($_GET['ip']==1){
		$ip="172.19.20.2";
		$jh="\x01";
	}else if($_GET['ip']==2){
		$ip="172.19.20.3";
		$jh="\x02";
	}else if($_GET['ip']==3){
		$ip="172.19.20.4";;
		$jh="\x03";
	}else if($_GET['ip']==4){
		$ip="172.19.20.5";
		$jh="\x04";;
	}else if($_GET['ip']==5){
		$ip="172.19.20.6";
		$jh="\x05";
	}else{
		exit;
	}
$qzkm="\xa3\xa8\x00\x08\x00\x0a\x00".$jh."\x00\x00\x00\x00\x45\x4a\x00\x00\x00\x00\x11\x21\x30\x40\x50\x60\x70\x80\x00\x00\x00\x00";
$jcqzkm="\xa3\xa8\x00\x08\x00\x0a\x00".$jh."\x00\x00\x00\x00\x45\x4a\x00\x00\x00\x00\x12\x22\x30\x40\x50\x60\x70\x80\x00\x00\x00\x00";
$qzgm="\xa3\xa8\x00\x08\x00\x0a\x00".$jh."\x00\x00\x00\x00\x45\x4a\x00\x00\x00\x00\x13\x23\x30\x40\x50\x60\x70\x80\x00\x00\x00\x00";
$jcqzgm="\xa3\xa8\x00\x08\x00\x0a\x00".$jh."\x00\x00\x00\x00\x45\x4a\x00\x00\x00\x00\x14\x24\x30\x40\x50\x60\x70\x80\x00\x00\x00\x00";
/*设置发送数据结束*/	
/*发送数据*/
  	if($_GET['zt']=="qzkm"){
		$data=udpGet($qzkm,$ip);
		}else if($_GET['zt']=="jcqzkm"){
		$data=udpGet($jcqzkm,$ip);
		}else if($_GET['zt']=="qzgm"){
		$data=udpGet($qzgm,$ip);
		}else if($_GET['zt']=="jcqzgm"){
		$data=udpGet($jcqzgm,$ip);
		}else{
		exit; 
		}  
/*发送数据结束*/
 $end_time=microtime(true);
 $total=$end_time-$start_time; 
 if($total<=6&&isset($data)){
	echo"<h1>成功</h1>";
 }
}


?> 
<html>
<head>
<style type="text/css">
select {
  border: solid 1px #000;
  width:100%;
  height:25%;
	font-size:50px;
  appearance:none;
  -moz-appearance:none;
  -webkit-appearance:none;
  padding-right: 14px;
}

select::-ms-expand { display: none; }
input{
	  width:100%;
  height:50%;
}

</style>
</head>
<body>
<form action="" method="get" enctype="multipart/form-data">
<select name="ip" >
<option value="1";>1号楼</option>
<option value="2">2号楼</option>
<option value="3">3号楼</option>
<option value="4">4号楼</option>
<option value="5">5号楼</option>
</select>
<select name="zt" >
<option value="qzkm";>强制开门</option>
<option value="jcqzkm">解除强制开门</option>
<option value="qzgm">强制关门</option>
<option value="jcqzgm">解除强制关门</option>
</select>
<input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>


