<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<html>
	
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8;" />	
  <title> 老蒋的地盘 </title>
  <!--
  <link rel="stylesheet"    type="text/css" href="../css/main.css" /> 
  <link rel="shortcut icon" type="image/x-icon" href="../img/title.ico" />
  -->
  <style type="text/css">
  	h2 a {text-decoration:none;}
  	h2 a:link {color:rgb(138,138,138);}
  	h2 a:visited {color:rgb(138,138,138);}
  	h2 a:hover {color:red;}
  	h2 a:active {color:rgb(138,138,138);}
  	h3 a:link {color:rgb(138,138,138);}
  	h3 a:visited {color:rgb(138,138,138);}
  	h3 a:hover {color:red;}
  	h3 a:active {color:rgb(138,138,138);}  	
    .links_line {font-family:'微软雅黑';font-size:16px;margin-top:10px;margin-bottom:10px;}
    .links_line a {margin-right:10px;margin-left:10px;}
    .links_line a:link {color:blue;}
    .links_line a:visited {color:blue;}
    .links_line a:hover {color:red;}
    .links_line a:active {color:blue;}
    .links {margin-left:40px;color:rgb(138,138,138);}
    .usable_links {margin-right:20px;}
    .item_main {border-bottom:1px solid rgb(218,218,218);width:100%;height:auto;margin-top:10px;}
    .item_name {font-family:'微软雅黑';font-size:20px;color:red;margin-left:40px;}	
  	.title_info {font-size:16px;color:rgb(138,138,138);}
  	.notice_info {font-family:'微软雅黑';font-size:14px;color:rgb(138,138,138);margin-top:20px;margin-bottom:20px;text-decoration:underline;}
  	.linkpanel {list-style:none;}
  	.linkpanel li {display:inline-block;}  	
  	.linkpanel li a {font-family:'微软雅黑';font-size:16px;text-decoration:none;margin-top:10px;margin-bottom:10px;}
  	.linkpanel li a {display:inline-block;border:1px solid rgb(138,138,138);width:48px;text-align:center;padding-top:10px;padding-bottom:10px;}
  	.linkpanel li a:link {color:rgb(118,118,118);border-color:rgb(138,138,138);background-color:none;}
  	.linkpanel li a:visited {color:rgb(118,118,118);border-color:rgb(138,138,138);background-color:none;}
  	.linkpanel li a:hover {color:white;border-color:white;background-color:red;}
  	.linkpanel li a:active {color:rgb(118,118,118);border-color:rgb(138,138,138);background-color:none;}
  </style>
  <!--
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  -->
</head>
	
<body>
	<!-- 外框架 -->
	<div id="framework"> 		
	  <div id="header" align="center" style="font-family:'微软雅黑';"> 
	    <h1 style="font-size:24px;margin-top:20px;font-weight:normal;color:black;"> 老蒋的电视剧推荐平台 </h1>
	    <h2 style="font-size:8px;font-weight:normal;color:rgb(138,138,138)"> 
	    	 设计者：<a href="admin_res.php">老蒋的崽</a> &nbsp&nbsp 版本号：v1.0
	    </h2>
	    <h3 style="font-size:16px;color:red;margin-top:20px;margin-bottom:0px;margin-left:40px;text-align:left;">
	    	<a class="usable_links" href="http://www.weather.com.cn/weather/101250405.shtml" target="_blank" title="点此查看衡阳县1周内天气预报"> 衡阳天气预报 </a>
	      <a class="usable_links" href="http://blog.sina.com.cn/s/blog_494d86ef0101je6m.html" target="_blank" title="刘少奇五服家谱"> 刘少奇家谱 </a>
	    </h3>
		  <hr style="margin-top:20px;margin-bottom:20px;color:rgb(138,138,138)">
	  </div>  
	  <div id="main">	  	
		  <?php
		    require_once("common.php");
			  $sql_links = sqlConnect();
			  $sql_state = "select * from `item_list` order by `item_id`";
			  $sql_query = $sql_links->getData($sql_state);
			  // 锚点
			  echo "<p class='links_line'><span class='links'>这些电视剧可以观看:&nbsp&nbsp&nbsp</span>";
			  foreach($sql_query as $key=>$value) {
			    echo "<a href='#item_".$key."'>".$value['item_name']."</a>&nbsp&nbsp&nbsp";			    
			  }
			  echo "</p>";
		    echo "<hr style='margin-top:20px;margin-bottom:20px;color:rgb(138,138,138)'>";
			  foreach($sql_query as $key=>$value) {
			?> 
			 <?php 
			  echo "<div class='item_main'><a name='item_".$key."'></a>";
			 ?>
			  		<p class='item_name'> 
			  			<?php echo ($key+1)."、".$value['item_name'];	?> 
			  			<span class='title_info'> <?php echo '&nbsp('.$value['item_count'].'集)'; ?>  </span>
			  			<span class='title_info'> <?php echo '&nbsp&nbsp'.$value['item_year'].'年上映'; ?> </span>
			  		</p>	

          <ul class="linkpanel">
  				  <?php
				      $sql_state = "select * from `item_addr` where `item_id`=".$value['item_id']." order by `item_node` asc";
				      $sql_query1 = $sql_links->getData($sql_state);
				      if(sizeof($sql_query1) == 0) {
				      	echo "<p style='font-family:微软雅黑;font-size:18px;color:red;'>暂无资源</p>";
				      	echo "<p class='notice_info'>".$value['item_modify']." 未添加资源</p>";
				        continue;	
				      }
				      foreach($sql_query1 as $key1=>$value1) {
				      	if($key1%12 ==0 && $key1 != 0) 
				      	  echo "<br>"; 	
					      echo "<li><a href='".$value1['item_link']."' target=_blank title='".$value['item_name']." 第".$value1['item_node']."集'> ".$value1['item_node']. "</a></li>&nbsp&nbsp";
				      }
				      if(empty($value['item_notice']) || $value['item_notice'] == "暂无消息" ) 
				      	echo "<p class='notice_info'>".$value['item_modify']." 无新消息</p>";	
				      else {
				      	if( $value['item_modify'] == date('Y-m-d') )
				      	 	echo "<p class='notice_info' style='color:red'>".$value['item_modify']." ".$value['item_notice']."</p>";	
				      	else	        
				      	 	echo "<p class='notice_info'>".$value['item_modify']." ".$value['item_notice']."</p>";	
				      }
				    ?>
				  </ul>  		
			  </div>
			<?php
			  }
			  $curr_ipad = GetIp();
			  $curr_addr = GetIpLookup($curr_ipad);			  
			  $sql_links = sqlConnect();
			  $sql_state = "select * from `logon_record` order by `logon_time`";
			  $sql_query = $sql_links->getData($sql_state);
			  $is_nearTime = false;
			  $count = sizeof($sql_query) + 1;
			  $curr = date('Y-m-d H:i:s');
			  if( sizeof($sql_query) ) { // 不为空时，组装相关信息
			  	$last = $sql_query[$count-2]['logon_time']; // 上一次登陆时间
//			  	$last_split = splitTime($last);
//			  	$curr_split = splitTime($curr);
//			  	$is_nearTime  = ( $curr_ipad == $sql_query[$count-2]['logon_ip'] );
//			  	$is_nearTime &= ( intval($last_split['year']) == intval($curr_split['year']) );
//			  	$is_nearTime &= ( intval($last_split['month']) == intval($curr_split['month']) );
//			  	$is_nearTime &= ( intval($last_split['day']) == intval($curr_split['day']) );
          if(strtotime($curr) < strtotime($last)) {
            echo "<script>alert('当前时间戳小于最后一条记录');</script>";	
          }
          $is_nearTime = ((strtotime($curr) - strtotime($last)) < 60*5 ); // 访问时间差小于2分钟，则该记录不写入数据库
			  }
			  if( !$is_nearTime || sizeof($sql_query) == 0 ) {  // 访问时间差小于2分钟时，记录不写入数据库
           $sql_state = "insert into `logon_record`(`logon_count`,`logon_time`,`logon_ip`,`logon_addr`) values ('$count','$curr','$curr_ipad','$curr_addr')";
				   $sql_links->runSql($sql_state);
				   if ($sql_links->errno() != 0) {
				     die("Error:写访问记录时出错" . $sql_links->errmsg());
				   }
			  }
			  $sql_links->closeDb();			  
			?>	  
	  </div>
	</div>
</body>
</html>
