<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;" />
<title> 剧集资源管理 </title>
<script>
	function onDelete() {
	  var item_name = document.getElementById("item_name").value;
	  if( item_name.length == 0) {
	  	alert("请输入要删除的电视剧名");
	  	return false;
	  }	
	  if( confirm("确定删除该电视剧所有信息吗？") ) {
		   // Ajax
		   var xmlhttp;
			 if(window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
			   xmlhttp = new XMLHttpRequest();
		 	 else // code for IE6, IE5
			   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");  
			 xmlhttp.onreadystatechange=function() { // reponse function
				 if( xmlhttp.readyState==4 && xmlhttp.status==200 ) {
			     var msg = xmlhttp.responseText;
			     alert(msg);
			   } 
			 }
			 xmlhttp.open("POST","delete_item.php",true);
			 xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			 xmlhttp.send("item_name="+item_name);	  	
	  } else {
	  	return false;
	  }		
	}
	
	function onSubmit() {
		 var item_name = document.getElementById("item_name").value;
		 var item_count = document.getElementById("item_count").value;
		 var item_year = document.getElementById("item_year").value;
		 var item_node = document.getElementById("item_node").value;
		 var item_link = document.getElementById("item_link").value;
		 var item_notice =document.getElementById("item_notice").value;
		 
	   if( item_name.length == 0) {
	     alert("请输入剧集名称，总集数及上映年份"); 
	     return false;  	
	   }
	   if( item_node.length != 0 && item_link.length == 0) {
	   	  alert("请输入本集资源链接");
	   	  return false;
	   }
	   if( item_link.length !=0 && item_node.length == 0) {
	      alert("请输入该资源对应集数");
	      return false;	
	   }

	   // Ajax
	   var xmlhttp;
		 if(window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
		   xmlhttp = new XMLHttpRequest();
	 	 else // code for IE6, IE5
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");  
		 xmlhttp.onreadystatechange=function() { // reponse function
			 if( xmlhttp.readyState==4 && xmlhttp.status==200 ) {
		     var msg = xmlhttp.responseText;
		     alert(msg);
		   } 
		 }
		 xmlhttp.open("POST","upload_proc.php",true);
		 xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		 xmlhttp.send("item_name="+item_name+"&"+"item_count="+item_count+"&"+"item_year="+item_year+"&"+"item_node="+item_node+"&"+"item_link="+item_link+"&"+"item_notice="+item_notice);		
  }		
  function onLogonInfo() {
    location.href = "logoninfo.php";	
  }
</script>
<style type="text/css">
	 #form {
	 	 text-align:center;
	 	 margin-top:5%;
	 	 font-family:'微软雅黑‘;
	 	 font-size:15px;
	 }
	 #submit,#reback,#delete,#logon {
	   width:220px;
	   font-family:'微软雅黑';
	   font-size:15px;
	   padding-top:2px;
	   padding-bottom:2px;	
	   margin-top:10px;
	 }
	 .tit { 
	   font-family:"微软雅黑";
	   font-size:15px;
	   width:200px;
	   height:40px;
	   padding-top:5px;
	   padding-bottom:5px;
	   margin-top:5px;
	 }
	 h6 { 
	   font-family:'微软雅黑';	
	   font-size:18px;
	   font-weight:thin;
	   margin-bottom:20px;
	   padding:0px;
	   
	 }
	 #username,#password {
	   padding-top:5px;
	   padding-bottom:5px;
	   margin-top:6px;
	   border-radius:2px;
	   border-style:none;	
	   font-size:15px;
	 }
</style>

</head>

<body> 
  <div >
  	 <form method="post" action="#" id="form">
  	 	  <h6> 请输入以下所有信息 </h6>
     	  <p> <span class="tit"> 电视剧名:</span> <input type="text" id="item_name" name="item_name" /> </p>
     	  <p> <span class="tit"> 总共集数:</span> <input type="text" id="item_count" name="item_count" /> </p>
     	  <p> <span class="tit"> 上映年份:</span> <input type="text" id="item_year" name="item_year" /> </p>
        <p> <span class="tit"> 上传集数:</span> <input type="text" id="item_node" name="item_node" /> </p> 
        <p> <span class="tit"> 资源链接:</span> <input type="text" id="item_link" name="item_link" /> </p>         
        <p> <span class="tit"> 最新通知:</span> <input type="text" id="item_notice" name="item_notice" /> </p>  	  
  	    <input type="button" id="submit" value="上 传" onclick="onSubmit();" /><br>
  	    <input type="button" id="delete" value="删 除" onclick="onDelete();" /><br>
  	    <button id="logon"><a href="logoninfo.php" target="_blank">查看日志</a></button><br>   
  	    <button id="reback"><a href="index.php" target="_blank">返 回</a></button>
  	 </form>
  </div>	
</body>

</html>



<?php

?>