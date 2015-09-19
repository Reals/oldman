<?php
   require_once("common.php");
?>

<?php
	  $item_name = $_POST['item_name'];
	  $item_count = $_POST['item_count'];
	  $item_year = $_POST['item_year'];
	  $item_node = $_POST['item_node'];
	  $item_link = $_POST['item_link'];
	  $item_notice = $_POST['item_notice'];
	  $item_echo = "";
	  $sql_links = sqlConnect();
	  // item_list遍历
	  $sql_state = "select * from `item_list` where `item_name`='$item_name'";
	  $sql_query = $sql_links->getData($sql_state);
	  $item_notice = (empty($item_notice)) ? "暂无消息" : $item_notice;	
	  if( !sizeof($sql_query) ) { // 不存在该剧，需要增加
	  	$item_modify = date('Y-m-d');
	  	$sql_state = "insert into `item_list` (`item_name`,`item_count`,`item_year`,`item_notice`,`item_modify`) values"."("."'".$item_name."','".$item_count."','".$item_year."','".'创建资源'."','".$item_modify."')";
	    $sql_links->runSql($sql_state);
	    if ($sql_links->errno() != 0) {
	      die("Error:" . $sql_links->errmsg());
	    }
	  } else { // 已经存在剧名，则修改相关信息
	  	$item_count = ( empty($item_count) ) ? $sql_query[0]['item_count'] : $item_count;
      $item_year = ( empty($item_year) ) ? $sql_query[0]['item_year'] : $item_year;
	    $item_modify = ( $item_notice == "暂无消息" ) ? $sql_query[0]['item_modify'] : date('Y-m-d');
	    $sql_state = "update `item_list` set `item_count`='$item_count',`item_year`='$item_year',`item_notice`='$item_notice',`item_modify`='".$item_modify."' where `item_name`='$item_name'";	
	    $sql_links->runSql($sql_state);
	    if ($sql_links->errno() != 0) {
	      die("Error:" . $sql_links->errmsg());
	    }
	  }
    $sql_state = "select * from `item_list` where `item_name`='$item_name'";
    $sql_query = $sql_links->getData($sql_state);	
    $item_id = $sql_query[0]['item_id']; // 获取ID
	  // item_addr遍历
	  if( empty($item_node) ) {
	    echo "《".$item_name."》剧集创建或修改成功";
	    $sql_links->closeDb();
	    return;	
	  }
	  $sql_state = "select * from `item_addr` where `item_node`='$item_node' and `item_id`='$item_id'";
	  $sql_query = $sql_links->getData($sql_state);
	  if( !sizeof($sql_query) ) { // 不存在这条资源链接
	  	$sql_state = "insert into `item_addr` (`item_id`,`item_node`,`item_link`) values ('$item_id','$item_node','$item_link')";
	  	$sql_links->runSql($sql_state);
	    if ($sql_links->errno() != 0) {
	      die("Error:" . $sql_links->errmsg());
	    }
	    echo "《".$item_name."》第".$item_node."集资源上传成功";
	    $sql_links->closeDb();
	    return;
	  } else { // 存在资源链接，则替换之
	  	$sql_state = "update `item_addr` set `item_link`='$item_link' where `item_id`='$item_id' and `item_node`='$item_node'";
	  	$sql_links->runSql($sql_state);
	    if ($sql_links->errno() != 0) {
	      die("Error:" . $sql_links->errmsg());
	    }
	    echo "《".$item_name."》第".$item_node."集链接修改成功";
	    $sql_links->closeDb();
	    return;	  	  	
	  }    
?>