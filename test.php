<?php
	include 'Twig/Autoloader.php';
	Twig_Autoloader::register();
	try {
  			$loader = new Twig_Loader_Filesystem('templates');
  			$twig = new Twig_Environment($loader);
  			$template = $twig->loadTemplate('test.tmpl');
			ini_set ("display_errors", "1");
			error_reporting(E_ALL);
			$dbconn3 = pg_connect("host=localhost port=5432 dbname=phpLesson user=postgres password=123456");
			if($dbconn3){
				echo("success");
			}
			$result = pg_query($dbconn3, 'SELECT * FROM "Users"'); 
			while ($row = pg_fetch_array($result)) { 	
				echo $template->render(array (
					'id' => $row[0],
					'name'=> $row[1],
					'surname'=> $row[2],
					'age' => $row[3]
				));	
			}
	} catch (Exception $e) {
  			die ('ERROR: ' . $e->getMessage());
	}
?>
