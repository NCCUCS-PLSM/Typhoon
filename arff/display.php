<!DOCTYPE html>
<html>
  <head>
    <title>可能放颱風假嘛</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
     <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	 <meta charset="UTF-8">
  </head>
  
  <body>
    <h1>    </h1>
    <script src="http://code.jquery.com/jquery.js"></script>
     <script src="bootstrap/js/bootstrap.min.js"></script>
   	
	



<!-- title  -->
<div class="jumbotron">
  <div class="container">
    <h1>TYPHOON<h1>
    <p></p>
	<!--  保留
    <p><a class="btn btn-primary btn-lg">Learn more</a></p>
	 -->
  </div>
  
</div>



<div class="container" ><!-- 固定寬度  -->
      <table class="table">
       	
        <tbody>
		            <tr class="active">		   
            <td>根據您輸入的資料，判斷明天是否放颱風假的的結果為:</td>
            
		  </tr>
         		  
        </tbody>
      </table>
<a href="../index.php">回首頁</a>
</div>
      
<?php
   $read_output = $_GET["output"];

   
   
       /*測試用-by文志*/
  /*   $read_output="output.txt";*/
	   
    $file = fopen($read_output, "r");

	if( $file==null)  //確認檔案是否存在
 {  
     /* echo "FILE NOT FOUND"." <br>\n";*/
	 
      echo "資料輸入錯誤 請回上一頁重新輸入"." <br>\n";
	
	  
 }else{
   
   
  /* echo " <br> 根據您輸入的資料，判斷明天是否放颱風假的的結果為: <br>";*/

	
   while(! feof($file))
    {
        $pic = fgets($file);

        if($pic[1]=='a' && $pic[3]=='b' && $pic[5]=='c')
          break;

      /*  echo $pic."<br>";*/
    }
  

   while(! feof($file))
   {
      $pic = fgets($file);
  
      if($pic[1]=='1')     //如果判斷為A
      {
        /*echo "a <br>";*/
      /*  echo "有上班有上課 <br>";
		echo "(~>_<~)  <br>";*/
		
			  
			  
?>
	  
	  <div class="container" ><!-- 固定寬度  -->
      <table class="table">
        
		
        <tbody>
		  
         
          <tr class="warning">
            <td>有上班有上課(~>_<~)</td>
            
          </tr>
          
          
		  
        </tbody>
      </table>
</div>
	  
	  
	  
	  
	  
	  <?php
		
		
      }
      else if($pic[3]=='1')      //如果判斷為B
      {
       /* echo "b <br>";*/
      /*  echo "有上班沒上課 <br>";
		echo "(^▽^)  <br>";*/
		
		  ?>
		  <div class="container" ><!-- 固定寬度  -->
      <table class="table">
       
		
        <tbody>
		  
          <tr class="success">
            <td>有上班沒上課(^▽^)</td>
           
          </tr>
		 		  
        </tbody>
      </table>
</div>
		  
		  
		  
	  <?php
		
		
		
      }
      else if($pic[5]=='1')      //如果判斷為C
      {
       /* echo "c <br>";*/
      /*  echo "沒上班沒上課 <br>";
		echo "*\(^0^)/*  <br>";*/
		
		
		  ?>
		  
		  <div class="container" ><!-- 固定寬度  -->
      <table class="table">
        
		
        <tbody>
		 
	
          <tr class="danger">
            <td>沒上班沒上課*\(^0^)/*</td>
         
          </tr>
          
		  
        </tbody>
      </table>
</div>
		  
		  
		  
		  
	  <?php
		
		
		
      } 
    }
     fclose($file);
	
	 echo "<br>";
	 echo "<br>";
     echo "<br>";	 
	 echo "_____________________________ <br>";
	 echo "以下資料是列印出MINING後的OUTPUT檔案 <br>";
	    
    
	/*列印出MINING的OUTPUT檔案*/
	$file = fopen($read_output, "r");
	while(! feof($file))
    {
        $pic2 = fgets($file);

         echo $pic2."<br>";
    }
	
		 fclose($file);
		 unlink($read_output);	
	
	
}
?>






	
	
  </body>
</html>
