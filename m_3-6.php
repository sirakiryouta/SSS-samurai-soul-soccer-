
<html>
<head>
    
</head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title></title>
</head>
<body>
	<?php

	$dataFile = "m_3-6.txt";

	if(isset($_POST['make']))
	{
		$str = (sizeof(file($dataFile))+1) . '<>' . $_POST['name'] . '<>' . $_POST['comment'] . '<>' . date('m/d/H:i') . '<>' .$_POST['password'] . "\n";
		$fp = fopen('m_3-6.txt','a');
		fwrite($fp, $str);
		fclose($fp);
	}
	
	if (isset($_POST['del']))
	{
		$file_make = file("m_3-6.txt");
		for($k = 0;$k <count($file_make); ++$k){
			$file_make[$k] = preg_replace("/\n/", "", $file_make[$k]);

			echo "fn: ".$file_make[$k]."<hr>";

			$delData = preg_split("/<>/", $file_make[$k]);

			echo "del: ".$delData[4]."<hr>";

			if(($delData[0] == $_POST['name2']) && ($delData[4] == $_POST['pass']))
			{
				echo 'in<hr>';
				array_splice($file_make, $k, 1);
				file_put_contents($dataFile, implode("", $file_make));
				echo ($_POST['pass']);echo ($delData[4]);
			}
		}

	}
	
	if (isset($_GET['edit']))
	{
		$file_edit = file("m_3-6.txt");
		for($l = 0;$l <count($file_edit); ++$l){
			$editData = explode("<>",$file_edit[$l]);
			if($editData[0] == ($_GET['name3'])) {
				$simEdit = $editData;
			}
		}

	}

	
	if (isset($_POST['make']) && isset($_POST['hidden1'])) {

		$file_edit = file("m_3-6.txt");
		for($m = 0;$m <count($file_edit); ++$m){
			$editData2 = explode("<>",$file_edit[$m]);
			if($editData2[0] == ($_POST['hidden1'])){
				$n = $_POST['hidden1'];
				$editData2[1] = $_POST['name'];
				$editData2[2] = $_POST['comment'];
				$file_edit[$m] = implode("<>", $editData2);
				file_put_contents($dataFile,implode("", $file_edit));
			}
		}#echo"hello";echo($_POST['hidden1']);
	}

	?>

	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		name:<br/>
		<input type="text" name="name" size="30" value="" /><br >
		password:<br/>
		<input type="text" name="password" size="30" value=""/><br />
		comment:<br/>
		<input type="text" name="comment" size="30" value=""/><br />

		<br />
		<input type="submit" name="make">
	</form>

	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		deleate number:<br/>
		<input type="text" name="name2" size="30" value=""/><br />
		password:<br><br/>
		<input type="text" name="pass" size ="30" placeholder="fill in password"/><br/>
		<input type="submit" name="del">
	</form>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
		<input type="hidden" name="hidden" value="<?php echo($_GET['name3']);?>">
		edit number:<br/><br/>
		<input type="text" name="name3" size="30" value="<?php echo($_GET['name3']);?> "/><br />
		<input type="submit" name="edit">

	</form>

	<?php

	$data_File = "m_3-6.txt";
	$ret_array = file($data_File);
	for($i = 0;$i <count($ret_array); ++$i){
		$piece = explode("<>", $ret_array[$i]);
		for($j = 0; $j < 4; ++$j){
			echo ($piece[$j]);
		}
		echo "<br />\n";
	}
	?>

</body></html>
		