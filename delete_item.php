<?php
   require_once("common.php");
?>

<?php
    $item_name = $_POST['item_name'];
    $sql_links = sqlConnect();
    $sql_state = "select * from `item_list` where `item_name`='$item_name'";
    $sql_query = $sql_links->getData($sql_state);
    if( !sizeof($sql_query) ) {
      echo "《".$item_name."》资源不存在！";
      return;	
    }
    $item_id = $sql_query[0]['item_id'];
    $sql_state = "delete from `item_list` where `item_id`='$item_id'";
    $sql_links->runSql($sql_state);
    $sql_state = "delete from `item_addr` where `item_id`='$item_id'";
    $sql_links->runSql($sql_state);
    echo "《".$item_name."》删除成功！";
    $sql_links->closeDb();
?>