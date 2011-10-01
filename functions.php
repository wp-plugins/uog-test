<?php

function uog_exam_startbutton($button_text) {?>
	<style type="text/css">
	<!--
	.style1 {color: #ECE9D8}
	.style2 {color: #FFFFFF}
	-->
	</style>
	

	
	<span class="style1"></span>
	<form method="post" action="<?php get_permalink();?>">
	
	
   <label for="cate">Test Category:</label>

  <select name="test_category" id="test_category">
	<option value="1">Web</option>
	<option value="2">Networking</option>
	<option value="3">Research</option>
	<option value="4">Database</option>
	<option value="5">Other</option>
  </select><br/>
	

		<input type="hidden" name="qno" value="1" />
		<input type="hidden" name="scr" value="0" /><br />
		<input type="submit" name="submit" value="<?php echo $button_text ?>" />
	</form>
	<?php
	$_SESSION['rid']="";
	$_SESSION['marks'] = 0;
}
	
	   
	function uog_test_ask_question(){
		global $wpdb;
		$test_category = $_POST['test_category'];
		$qno = $_POST['qno'];
		$qno = $qno +1; 
		
		if($qno>4){
			return 'done';
		}
		
		$max_q = $wpdb->get_results("SELECT question_id FROM uog_questions where test_category = ". $test_category); 
		
		$only_ids = array();
		
		foreach($max_q as $max){
			$only_ids[] = $max->question_id;
		}

		
		$rq_no = array_rand($only_ids);

		$q_arr = explode(",",$_SESSION['rid']);

		while(in_array($rq_no,$q_arr)){
			$rq_no = array_rand($only_ids);
		}
		
		$sel_qno = $only_ids[$rq_no];
		
		$qa = $wpdb->get_results("SELECT qs.*, ans.*
                     FROM uog_answers ans
                     LEFT JOIN uog_questions qs
                     ON ans.question_id = qs.question_id 
					 WHERE qs.question_id= " . $sel_qno . "
					 AND qs.test_category = ". $test_category
					 );

		foreach ($qa as $q){
			$question = $q->question;
			$question_id = $q->question_id;	
			$answer_option[] = $q->answer_option;
			$answer_id[] = $q->answer_id ;
		}
		if($_SESSION['rid']==""){
			$_SESSION['rid'] = $question_id;			
		}else{
			$_SESSION['rid'] = $_SESSION['rid'] . "," . $question_id;
		}
		 ?>
	
         <script type="text/javascript">
             
			function startTimeCount(){
				var x=setTimeout("redTime()",1000);
			}
			
			function redTime(){
				  var v = parseInt(document.getElementById("dTime").innerHTML);
				  document.getElementById("dTime").innerHTML = v-parseInt(1);
				  startTimeCount();
			}
			 function timeMsg(){
			 	
	          	var t=setTimeout("sendForm()",60000);
              }
             function sendForm(){
		          document.main_form.submit();
               }
			  
			  startTimeCount();
              timeMsg();
             </script>
         <span class="style2"></span>
	 
		<form method="post" name="main_form" id="main_form">
			<div id="sec">Remaining Seconds :</div> <div id="dTime">60</div>
			<?php echo "Q " . ($qno-1) . "- " . $question . '<br />'; 
			for($x=0;$x<count($answer_option);$x++){?>
				<?php echo ($x+1);?>- <input type="radio" name="option" value="<?php echo $answer_id[$x];?>"/><?php  echo $answer_option[$x] . '<br />'; ?>
			<?php }?>
			<input type="hidden" name="qno" value="<?php echo $qno ;?>" />
			<input type="hidden" name="question_id" value="<?php echo $question_id;?>" />
			<input type="hidden" name="test_category" value="<?php echo $test_category;?>" />
			<input type="submit" name="btnSubmit" value="Next" />
			
		</form>
		
			
		<?php
	};//End uog_test_check_question
	
	function uog_test_check_question(){
		global $wpdb;
		$quid=$_POST['question_id'];
		$sel_ans=$_POST['option'];
		
		$qn = $wpdb->get_results("SELECT * FROM uog_questions WHERE question_id=$quid AND c_answer_id=$sel_ans");
		
		   if(count($qn)){
				return true;
		   }else{
				return false;
		   }
	   };
       ?>
