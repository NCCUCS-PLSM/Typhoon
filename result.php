<?php
require_once("sql_config.php");

$index = 0;
$county_array = array();

foreach($_POST as $key => $value)
{
	echo $key."+".$value."<br>";
	$$key = $value; /* PHP support use variable name as variable name*/          
	if($index > 7) // 7 index of $_POST["result"], start storing county from next index
	{
		if(!empty($value) && $key != $county)                 
			array_push($county_array, $key);                                        
	}
	$index ++;
}

/*tag for multicounty*/
$multicounty_mode = 0;
/* 檢驗是否已知其他縣市 */
if( $keelong || $taipei || $new_taipei || $taoyuan || $hsinchu_city || $hsinchu_county
 || $miaoli || $taichung_city || $taichung_county || $changhwa || $yunlin || $nantou
 || $chiayi_city || $chiayi_county || $tainan_city || $tainan_county || $kaohsiung_city
 || $kaohsiung_county || $pintung || $yilang || $hualien || $taitung || $ponghu
 || $lienjun || $jinmen)
	$multicounty_mode = 1;

$time = time();

try
{
	if(!$multicounty_mode)       
	{
		$file = "arff/single".$time.".arff";
		$fsingle = "single".$time.".arff";
		if(!copy("single_sample.arff", $file))
			throw new Exception("試算檔產生失敗");

		/*修改檔案內容 (只需要代換)*/
		file_put_contents($file, str_replace("county", $county, file_get_contents($file)));
		file_put_contents($file, str_replace("pa,", $path.',', file_get_contents($file)));
		file_put_contents($file, str_replace("pr,", $pressure.',', file_get_contents($file)));
		file_put_contents($file, str_replace("sp,", $speed.',', file_get_contents($file)));
		file_put_contents($file, str_replace("r7", $radius7, file_get_contents($file)));
		file_put_contents($file, str_replace("r10", $radius10, file_get_contents($file)));
		file_put_contents($file, str_replace("alt", $alert, file_get_contents($file)));
		file_put_contents($file, str_replace("xy", $result, file_get_contents($file)));


		$output = "output".$time.".txt";
		$long_out = "arff/".$output;

		$model = "models/".$county.".model";
		/*
		   $fq = fopen("arff/queue", "a+");
		   fwrite($fq, $fsingle." ".$output."\n");
		   fclose($fq);
		 */
		$outfile = fopen($long_out, "w+");
		$outstring = shell_exec("java -cp weka.jar weka.classifiers.bayes.NaiveBayes -T ".$file." -l ".$model);
		fwrite($outfile, $outstring);
		fclose($outfile);

		/* remove temporary training and testing file */
		unlink($file);
	}
	else
	{
		$train_time = time();
		$train_file = "arff/multiple_train".$train_time.".arff";
		if(!copy("multiple_sample.arff", $train_file))
			throw new Exception("試算檔案產生失敗");

		$test_time = time(); 
		$test_file = "arff/multiple".$test_time.".arff";
		if(!copy("multiple_sample.arff", $test_file))
			throw new Exception("試算檔案產生失敗");

		/*用 $county 取代 @ATTRIBUTE county {1,2,3} 的 county*/
		file_put_contents($train_file, str_replace("county", $county, file_get_contents($train_file)));
		file_put_contents($test_file, str_replace("county", $county, file_get_contents($test_file)));

		$fptrain = fopen($train_file, "a+");
		$fptest = fopen($test_file, "a+");

		$tmp_index = 0;
		while(($t = $county_array[$tmp_index]) != null)
		{
			$query_county = $query_county.", `".$t."`";                                
			$tmp_index = $tmp_index + 1;

			/*加入其他 county 屬性*/
			fwrite($fptrain, "\n@ATTRIBUTE ".$t." {1,2,3}");
			fwrite($fptest, "\n@ATTRIBUTE ".$t." {1,2,3}");

		}
		fwrite($fptrain, "\n\n@Data\n\n");
		fwrite($fptest, "\n\n@Data\n\n");

		/*去資料庫抓資料做成 training arff*/
		$query_string = "SELECT `path`, `pressure`, `speed`, `radius7`, `radius10`, `alert`, `".$county."`".$query_county." FROM `weka_typhoon`;";
		//$query_string = "SELECT  `".$county."`".$query_county." FROM `weka_typhoon`;";

		$query = mysql_query($query_string) or die("SQL connection failed.");
		while(($training = mysql_fetch_row($query)) != null)
		{
			for($i=0; $i<count($training); $i++)
			{
				if($i == (count($training)-1))
					$write_train = $write_train.$training[$i];
				else
					$write_train= $write_train.$training[$i].",";
			}             
			$write_train = $write_train."\n";

			/*抓取資料寫入 training arff*/
			fwrite($fptrain, $write_train);            
		}           


		/*使用者輸入寫成 test arff*/
		$test_index = 0;
		foreach($_POST as $key => $value)
		{
			echo "=>".$key."+".$value."<br>";

			if($test_index != count($_POST)-1 && $key != "county")
				$write_test = $write_test.$value.",";
			else if($key != "county")
				$write_test = $write_test.$value;

			$test_index++; 
		}
		fwrite($fptest, $write_test);              

		fclose($fptrain);
		fclose($fptest);

		/*祐甫的 dynamic modeling program*/
		$trainf = "multiple_train".$train_time.".arff";
		$testf = "multiple".$test_time.".arff";
		$output = "output".time().".txt";
		$long_out = "arff/".$output;
		//$train_model = "/var/www/Typhoon/arff/multiple_train_model".time().".model";

		/*下面方法都沒有辦法成功使用 model 得到結果*/
		/*system("java weka.classifiers.bayes.NaiveBayes -t ".$trains." -i -d ".$train_model." -c 7");
		  /shell_exec("java weka.classifiers.bayes.NaiveBayes -T ".$tests." -l ".$train_model." -c 7 > ".$output);*/
		//system("arff/process ".$filef." ".$testf." ".$output);

		$outfile = fopen($long_out, "w+");
		$outstring = shell_exec("java -cp weka.jar weka.classifiers.bayes.NaiveBayes -t ".$train_file." -T ".$test_file);
		fwrite($outfile, $outstring);
		fclose($outfile);

		/* remove temporary trainng and testing file */
		unlink($train_file);
		unlink($test_file);

		/* 本來是要輸出給 process.php 用的 queue	
		   $fq = fopen("arff/queue", "a+");
		   fwrite($fq, $trainf." ".$testf." ".$output."\n");
		   fclose($fq);
		 */
	}//end of else


	/*導向文志的輸出結果檔案*/
	echo "<script language='javascript'>location.href='arff/display.php?output=$output'</script>";

	/*本來是會去讀另一支程式 process.php 產生 output ，因可能還沒處理完(那邊 sleep(1))，要等待
	  if(!$fresult = fopen("arff/".$output, "r"))
	  {
	  sleep(6);
	  $fresult = fopen("arff/".$output, "r");
	  echo "arff/".$output;
	  }

	 */

} // end of try on line 31         
catch (Exception $e)
{
	//self logger function;
	echo "服務不能：".$e->getMessage();
	exit(0);
}


?>
