<?php
  date_default_timezone_set('PRC');  
	function GetIp(){  
	    $realip = '';  
	    $unknown = 'unknown';  
	    if (isset($_SERVER)){  
	        if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)){  
	            $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);  
	            foreach($arr as $ip){  
	                $ip = trim($ip);  
	                if ($ip != 'unknown'){  
	                    $realip = $ip;  
	                    break;  
	                }  
	            }  
	        }else if(isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)){  
	            $realip = $_SERVER['HTTP_CLIENT_IP'];  
	        }else if(isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)){  
	            $realip = $_SERVER['REMOTE_ADDR'];  
	        }else{  
	            $realip = $unknown;  
	        }  
	    }else{  
	        if(getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)){  
	            $realip = getenv("HTTP_X_FORWARDED_FOR");  
	        }else if(getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)){  
	            $realip = getenv("HTTP_CLIENT_IP");  
	        }else if(getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)){  
	            $realip = getenv("REMOTE_ADDR");  
	        }else{  
	            $realip = $unknown;  
	        }  
	    }  
	    $realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;  
	    return $realip;  
	}  
	  
	function GetIpLookup($ip = ''){
	    if(empty($ip)){  
	        $ip = GetIp();  
	    }  
	    $res = @file_get_contents('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='.$ip);
	    //$res = @file_get_contents('http://www.ip138.com/ips138.asp?action=2&ip=',$ip);
	    if(empty($res)){ return false; }  
	    $jsonMatches = array();  
	    preg_match('#\{.+?\}#', $res, $jsonMatches);  
	    if(!isset($jsonMatches[0])){ return false; }  
	    $json = json_decode($jsonMatches[0], true);  
	    if(isset($json['ret']) && $json['ret'] == 1){  
	        $json['ip'] = $ip;  
	        unset($json['ret']);  
	    }else{  
	        return false;  
	    }  
	    //return $json; 
	    return $json['country']."-".$json['province']."-".$json['city']; 
	}
 
  function sqlConnect() { // ˽¾ݿᢍ
	  $sql_links = new SaeMysql();
	  if($sql_links->errno() != 0) // database connection check
	   echo "<script>alert('DB CONN FAILURE');</script>";	
    $sql_links->setCharset('utf8');
	  return $sql_links;
  }

//  function splitTime($cur_time) {
//    $split_time;
//    if( empty($cur_time) ) {
//      echo "<script>alert('[Error] splitTime parameter missed!');</script>";	
//    }
//    $slice_0 = explode(" ",$cur_time);
//    $slice_d = $slice_0[0];
//    $slice_t = $slice_0[1];
//    $slice_1 = explode("-",$slice_d);
//    $split_time['year'] = $slice_1[0];
//    $split_time['month'] = $slice_1[1];
//    $split_time['day'] = $slice_1[2];
//    $slice_2 = explode(":",$slice_t);
//    $split_time['hour'] = $slice_2[0];
//    $split_time['minute'] = $slice_2[1];
//    $split_time['second'] = $slice_2[2];
//    return $split_time;
//  }  

?>