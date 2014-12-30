<!DOCTYPE>
<html>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <head>
        <link href="PLSM.ico" rel="shortcut icon">
        <link href="index.css" rel="stylesheet" type="text/css"/>
        <title>可能放颱風假嗎？</title>
    </head>
    <body bgcolor="dodgerblue"> 
      <div class="container">   
         <div class="top"><img src="PLSM.png" alt="PLSM Production"/></div>
         <div class="main" id="main" height="120px"> 
            <div class="input">
                <br>現在有 <?php  /*存取資料庫資料數*/ echo "<font color='red'>100</font>"; ?> 筆颱風資料<br>
                <h3>想看看你在的地方明天可能會放假嗎？請輸入以下資料讓我們幫你看看～</h3><br>
                <form action="result.php" method="post" id="user_form">
                    <a class="css_btn_class" onclick="document.getElementById('user_form').submit();">看結果</a><br><br>
					<!--
                    年分：<input type="text" name="year"><br>
					編號：<input type="text" name="number"><br>    
                    -->
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
					近台近中心最低氣壓(hPa)：<input type="text" name="pressure" value="1000"><br>
                    近台近中心最大風速(m/s)：<input type="text" name="speed" value="17.2"><br>
					七級暴風半徑(km)：<input text="text" name="radius7" value="100"><br>
					十級暴風半徑(km)：<input text="text" name="radius10" value="0"><br>
					警報發布數：<input text="text" name="alert" value="0"><br>
					想知道的縣市：<select name="county">
							<option value="keelong" selected="true">基隆市</option>
							<option value="taipei">台北市</option>
							<option value="new_taipei">新北市</option>
							<option value="taoyuan">桃園縣</option>		<!--arff uses "taoyaun"-->
							<option value="hsinchu_city">新竹市</option>
							<option value="hsinchu_county">新竹縣</option>
							<option value="miaoli">苗栗縣</option>
							<option value="taichung_city">台中市</option>
							<option value="taichung_county">台中縣</option>
							<option value="changhwa">彰化縣</option>
							<option value="yunlin">雲林縣</option>
							<option value="nantou">南投縣</option>
							<option value="chiayi_city">嘉義市</option>
							<option value="chiayi_county">嘉義縣</option>
							<option value="tainan_city">台南市</option>
							<option value="tainan_county">台南縣</option>
							<option value="kaohsiung_city">高雄市</option>	<!--arff uses "kaosiung"-->
							<option value="kaohsiung_county">高雄縣</option>
							<option value="pintung">屏東縣</option>
							<option value="yilang">宜蘭縣</option>
							<option value="hualien">花蓮縣</option>
							<option value="taitung">台東縣</option>
							<option value="ponghu">澎湖縣</option>
							<option value="lienjun">連江縣</option>
							<option value="jinmen">金門縣</option>
						  </select><br>
					想知到的結果：<select name="result">
							<option value="1" selected="true">正常上班上課 (1)</option>
							<option value="2">正常上班，停止上課 (2)</option>
							<option value="3">停止上班上課 (3)</option>
						 <br></select><br><br>
                     ☝￣ω￣&nbsp;&nbsp;空格中皆為預設值，請刪除後填入！                 
                    <br><br><br>
                    已知多個縣市放假情況的話，可以按按鈕來新增縣市放假資料，並刪除縣市名後輸入 1~3 (tmp)<br>
                    新增縣市:<select id="known_county">
                            <option value="keelong" selected="true">基隆市</option>
							<option value="taipei">台北市</option>
							<option value="new_taipei">新北市</option>
							<option value="taoyuan">桃園縣</option>		<!--arff uses "taoyaun"-->
							<option value="hsinchu_city">新竹市</option>
							<option value="hsinchu_county">新竹縣</option>
							<option value="miaoli">苗栗縣</option>
							<option value="taichung_city">台中市</option>
							<option value="taichung_county">台中縣</option>
							<option value="changhwa">彰化縣</option>
							<option value="yunlin">雲林縣</option>
							<option value="nantou">南投縣</option>
							<option value="chiayi_city">嘉義市</option>
							<option value="chiayi_county">嘉義縣</option>
							<option value="tainan_city">台南市</option>
							<option value="tainan_county">台南縣</option>
							<option value="kaohsiung_city">高雄市</option>	<!--arff uses "kaosiung"-->
							<option value="kaohsiung_county">高雄縣</option>
							<option value="pintung">屏東縣</option>
							<option value="yilang">宜蘭縣</option>
							<option value="hualien">花蓮縣</option>
							<option value="taitung">台東縣</option>
							<option value="ponghu">澎湖縣</option>
							<option value="lienjun">連江縣</option>
							<option value="jinmen">金門縣</option>
                            </select>
                        <input type="button" value="新增縣市" onclick="add_element(this)"><br><br>                  
                </form>
                <script language="javascript">
                    function add_element(object)
                    {                 
                      if( document.getElementById("known_county").length == 0)
                      {
                        alert("已無法加入");
                        return;
                      }
                   
                        county_name = document.getElementById("known_county").value;      
                        county_index = document.getElementById("known_county").selectedIndex;                                                            
                        county_text = document.getElementById("known_county").options[county_index].innerText;

                                                
                        /*add textbox*/
                        var new_county = document.createElement("input");
                        new_county.type = "text";
                        new_county.name = county_name;
                        new_county.value = county_text;

                        object.form.appendChild(new_county);

                        /*add newline*/
                        var s = document.createElement("br");                    
                        object.form.appendChild(s);
                        
                        /*remove or hide this county*/
                        //document.getElementById("known_county").options.namedItem("keelong").style.visibility="hidden";
                        //document.getElementById("known_county").options.namedItem("keelong") = null;
                        document.getElementById("known_county").options[county_index] = null; 
                        
                        /*dynamic resize main div*/
                        //doucument.getElementById("main").style.cssText=".main{height: 900px;}";
                    }
                </script>
            </div><!--end of div input-->
            <div class="output">
<!--考慮用 iframe 連結 result.php-->
            </div><!--end of div output-->
         </div><!--end of div main-->
		 <div class="bottom">
		 	PLSM Production | <a onclick="logging_varify()" onmoveover="/*字變紅色*/">Admin Loggin</a><br>
			Copyrigth©2013 All Rights Reserved.<br>
            Programming Language and Software Methodology Laboratory  National Cheng Chi University<br>       
            <script language="javascript">
            function logging_varify()
            {
                do{ var passwd = prompt("請輸入密碼"); }while(passwd == "" || passwd == null);
                location.href="Admin.php?passwd=" + passwd;
            }            
            </script>
		 </div>
      </div><!--end of div container-->
    </body>
</html>
