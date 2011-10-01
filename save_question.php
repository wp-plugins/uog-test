<?php

	include('../../../wp-config.php');

	mysql_connect(DB_HOST,DB_USER,DB_PASSWORD);
	
	mysql_select_db(DB_NAME) ;
	
		
		$question=$_POST['question'];
		$test_category=$_POST['test_category'];
		$answer_optiona=$_POST['optiona'];
		$answer_optionb=$_POST['optionb'];
		$answer_optionc=$_POST['optionc'];
		$answer_optiond=$_POST['optiond'];
		$correct_ans=$_POST['c_correct_id'];
		$purl=$_POST['purl'];
		
	

	mysql_query("INSERT INTO uog_questions (question,test_category) VALUES('" . $question . "','" . $test_category . "')");
	$question_id = mysql_insert_id();
		 
	
    mysql_query("INSERT INTO uog_answers (question_id,answer_option) VALUES('" . $question_id . "','" . $answer_optiona . "')");
	$answer[] = mysql_insert_id();
	
	mysql_query("INSERT INTO uog_answers (question_id,answer_option) VALUES('" . $question_id . "','" . $answer_optionb . "')");
	$answer[] = mysql_insert_id();
		
	mysql_query("INSERT INTO uog_answers (question_id,answer_option) VALUES('" . $question_id . "','" . $answer_optionc . "')");
	$answer[] = mysql_insert_id();
		
	mysql_query("INSERT INTO uog_answers (question_id,answer_option) VALUES('" . $question_id . "','" . $answer_optiond . "')");
	$answer[] = mysql_insert_id();
	
	$correct = 	$answer[$correct_ans - 1];
	
	mysql_query("UPDATE uog_questions SET c_answer_id='" . $correct . "' WHERE question_id='" . $question_id . "' ");
	//echo "UPDATE uog_questions SET c_answer_id='" . $correct . "' WHERE question_id='" . $question_id . "' ";
	header("Location: " . $purl . "/wp-admin/options-general.php?page=uog_test");
	
	exit;

	
	
?>