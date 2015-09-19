<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<html>	
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8;" />	
  <title> 访客记录 </title>
</head>

<body>
	
<?php
  require_once("common.php");
?>

<style type="text/css">
	table {border:1px gray solid;border-collapse:collapse;text-align:center;margin-top:40px;}
	.tb_header {border:1px gray solid;font-family:'微软雅黑';font-size:18px;font-weight:normal;background-color:green;padding:10px 40px 10px 40px;}
	.tb_grid {border:1px gray solid;font-family:'Calibri' '微软雅黑';font-size:15px;padding:10px 40px 10px 40px;}	
	#title {font-family:'微软雅黑';font-size:24px;margin-bottom:18px;}
</style>

<?php
  date_default_timezone_set('PRC');  
  //$user_time = date('Y-m-d H:i:s');
  //$user_ipad = GetIp(); // ԃ»§IP
  //$user_adr = GetIpLookup($user_ipad);
  //$user_addr = $user_adr['country']."-".$user_adr['province']."-".$user_adr['city']; // 
  $sql_links = sqlConnect();
  $sql_state = "select * from `logon_record` order by `logon_count`";
  $sql_query = $sql_links->getData($sql_state);
  // 不存在记录
  if( !sizeof($sql_query) ) {
    echo "<p style='color:red'>未发现访问记录</p>";
    return;	
  } 
  // 存在记录则打印表格   
  echo "<table align='center'>";
  echo "<caption align='top' id='title'> 访客信息记录 </caption>";
  echo "<tr><th class='tb_header' style='text-align:center'>次数</th><th class='tb_header'>访问时间<th class='tb_header'>IP地址</th><th class='tb_header'>地理位置</th></tr>";
	foreach($sql_query as $key=>$value) {
		echo "<tr>";
		echo "<td class='tb_grid'>".$value['logon_count']."</td>";
		echo "<td class='tb_grid'>".$value['logon_time']."</td>";
		echo "<td class='tb_grid'>".$value['logon_ip']."</td>";
		echo "<td class='tb_grid'>".$value['logon_addr']."</td>";
    echo "</tr>";			    
  }
  echo "</table>";
?>

</body>
</html>