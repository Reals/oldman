<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8;" />
<title> 剧集资源授权 </title>
<script>
	function onReback() {
	  location.href = "index.php";	
	}
	function onSubmit() {
		 var username = document.getElementById("username").value;
		 var password = document.getElementById("password").value;
	   if( username.length == 0 || password.length == 0) {
	     alert("请输入授权口令"); 
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
		     if( msg == "username" || msg == "password" ) {
		       alert("Usernamd or Password incorrect.");
		     } else {
		     	 location.href = msg; // page going
		     }
			 }
		 }
		 xmlhttp.open("POST","admin.php",true);
		 xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		 xmlhttp.send("username="+username+"&"+"password="+password);		
  }	
</script>
<style type="text/css">
	 #admin {
	   border:solid 1px rgb(138,138,138);	
	   border-radius:10px;
	   top:40%;
	   left:50%;
	   width:300px;
	   height:280px;
	   position:absolute;
	   margin-top:-120px;
	   margin-left:-150px;
	   background-color:rgb(198,198,198);
	 }
	 #form {
	 	 text-align:center;
	 	 margin-top:5%;
	 	 font-family:'微软雅黑';
	 	 font-size:15px;
	 }
	 #submit,#reback {
	   width:75%;
	   font-family:'微软雅黑';
	   font-size:15px;
	   padding-top:5px;
	   padding-bottom:5px;	
	   margin-top:10px;
	 }
	 .tit { 
	   font-family:'微软雅黑';
	 }
	 h6 { 
	   font-family:'微软雅黑';	
	   font-size:20px;
	   font-weight:thin;
	   margin:0px;
	   padding:0px;
	   
	 }
	 hr {
	   margin:10px 10px 10px 10px;
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

  <div id="admin">
  	 <form method="post" action="#" id="form">
  	 	  <h6> 管理员授权 </h6>
  	 	  <hr>
     	  <p> <span class="tit"> 管理员: </span> <input type="text" id="username" name="username" value="admin" /> </p>
  	    <p> <span class="tit"> 口&nbsp&nbsp令: </span> <input type="password" id="password" name="password" /> </p>
  	    <input type="button" id="submit" value="授 权" onclick="onSubmit();" /><br>
  	    <input type="button" id="reback" value="返 回" onclick="onReback();" />
  	 </form>
  </div>	
</body>

</html>
