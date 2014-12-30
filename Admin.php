<!DOCTYPE>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <head>
        <link href="PLSM.ico" rel="shortcut icon" />
		<link href="admin.css" rel="stylesheet" type="text/css"/>
        <title>管理者頁面</title>
    </head>
    <body bgcolor="darkseagreen">    
         <div class="top"><a href="index.php"><img src="PLSM.png" alt="PLSM Production"/></a></div>
	     <div class="main"> 
	            <div class="input">
                <?php 
                    require_once("sql_config.php");
                    $query_string = "SELECT `passwd` FROM `user` WHERE `id`='admin';";
                    $query = mysql_query($query_string) or die('MySQL query failed.');
                    $passwd = mysql_fetch_row($query);
                    if($_GET["passwd"] != $passwd[0])                                       
                    {
                        echo "<script language='javascript'>";
                        echo "alert('密碼錯誤！');";
                        echo "window.location.href='index.php'";
                        echo "</script>";                        
                        exit(0);
                    }

                ?>
				<br>現在有 <?php  /*存取資料庫資料數*/ echo "<font color='red'>100</font>"; ?> 筆颱風資料<br>
	                <h3>加入新資料項目</h3><br>
	                <form action="dbwrite.php" method="post" id="admin_form">
						年分：<input type="text" name="year"><br>
						編號：<input type="text" name="number"><br><!--之後應該拿掉-->
	                    近台近中心最大風速(m/s)：<input type="text" name="speed"><br>
						近台近中心最低氣壓(hPa)：<input type="text" name="pressure"><br>
						侵台路徑：<select name="path">
									<option value="-1" selected="true">-1 (特殊路徑)</option>
									<option value="0">0 (未侵台)</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
								  </select><br>
						七級暴風半徑(km)：<input text="text" name="radius7"><br>
						十級暴風半徑(km)：<input text="text" name="radius10"><br>
						警報發布數：<input text="text" name="alert"><br><br>
	
						基隆市：
							<select name="keelong_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						台北市：
							<select name="taipei_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						新北市：
							<select name="new_taipei_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						桃園縣：
							<select name="taoyuan_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						新竹市：
							<select name="hsinchu_city_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						新竹縣：
							<select name="hsinchu_county_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						苗栗縣：
							<select name="miaoli_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						台中市：
							<select name="taichung_city_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						台中縣：
							<select name="taichung_county_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						 彰化縣：
							<select name="changhwa_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						雲林縣：
							<select name="yunlin_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						南投縣：
							<select name="nantou_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						嘉義市：
							<select name="chiayi_city_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						嘉義縣：
							<select name="chiayi_county_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						台南市：
							<select name="tainan_city_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						台南縣：
							<select name="tainan_county_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						高雄市：
							<select name="kaohsiung_city_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						高雄縣：
							<select name="kaohsiung_county_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						屏東縣：
							<select name="pintung_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						宜蘭縣：
							<select name="yilan_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						花蓮縣：
							<select name="hualien_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						台東縣：
							<select name="taichung_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						澎湖縣：
							<select name="ponghu_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>
						連江縣：
							<select name="lienjun_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
						 	</select><br>
						金門縣：
							<select name="jinmen_data">
								<option value="1" selected="true">正常上班上課</option>
								<option value="2">正常上班，停止上課</option>
								<option value="3">停止上班上課</option>
							 </select><br>                                  
                        <a class="css_btn_class" onclick="document.getElementById('admin_form').submit();">寫入資料庫</a>
                        <a href="mining.php" class="css_btn_class">重新 Mining</a>
	                </form>
	            </div><!--input-->
	            <div class="output">
					<h3>最新 Mining 結果</h3>
        	        <?php 
        	            /*form post 會回來本頁(因為沒有指定 action)，在此作驗證後顯示最新 Mining 結果資料*/
						$fp = fopen("output_tmp", "r");
						while(!feof($fp))
						{
							$value = fgets($fp);
							echo $value."<br>";
						}
						fclose($fp);
            	    ?>
            	</div><!--output-->
     	</div><!--main-->
    </body>
</html>
