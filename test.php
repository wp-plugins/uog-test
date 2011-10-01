<?php
session_start();
/*
Plugin Name: UOGtest
Plugin URI: 
Description: Add Test/Sample Exams to your pages
Version: 1.0
Author: Hasnat Sami
Author URI: 
*/

/* 
This program is for online entry test.
	*/



/*add_action('admin_menu', 'wpmb_add_menu');
add_action('admin_init', 'wpmb_reg_function' );

register_activation_hook( __FILE__, 'wpmb_activate' );

function wpmb_add_menu() {
add_menu_page( __( 'Cutting Settings', 'wpmb_menu' ), __( 'Cutting Settings', 'wpmb_menu' ),
WPCF7_ADMIN_READ_CAPABILITY, 'wpmb_menu', 'wpmb_menu_function' );

add_submenu_page( 'wpmb_menu', __( 'Change Navigation', 'wpmb_menu' ), __( 'Change Navigation', 'wpmb_menu' ),
WPCF7_ADMIN_READ_CAPABILITY, 'wpmb_menu', 'wpmb_menu_function' );
add_submenu_page( 'wpmb_menu', __( 'Slider', 'wpmb_menu' ), __( 'Image Slider', 'wpns_slider_function' ),
WPCF7_ADMIN_READ_CAPABILITY, 'wpns_slider', 'wpns_slider_function' );
add_submenu_page( 'wpmb_menu', __( 'Edit Contact Forms', 'wpmb_menu' ), __( 'Contact Form', 'wpmb_menu' ),
WPCF7_ADMIN_READ_CAPABILITY, 'wpcf7', 'wpcf7_admin_management_page' );


}*/





//MAKE A SIDE BAR LINK ADD QUESTION IN DATABASE
add_action('admin_menu', 'uog_test_menu');
//add_action('admin_init', 'wpmb_reg_function' );

register_activation_hook( __FILE__, 'uog_activate' );

function uog_test_menu() {

	 add_menu_page('UOG Test', 'UOG Test', 'manage_options', 'uog_test', 'uog_test_options');
	 add_submenu_page( 'uog_test', 'Add Questions', 'Add Questions', 'manage_options', 'uog_test', 'uog_test_options');
	 add_submenu_page( 'uog_test', 'Test Results', 'Test Results', 'manage_options', 'uog_test_res', 'uog_result_options');	 
		add_submenu_page( 'uog_test', 'Question Bank', 'Question Bank', 'manage_options', 'uog_ques_bank', 'uog_ques_bank');
}

function uog_test_options() {

?>
<h1>Testing</h1><br/>

<div id="main">

	
<form method="post" action="<?php bloginfo("wpurl")?>/wp-content/plugins/uog_test/save_question.php">
	
	
	<div id="question">
	<label for="question">Question :</label><br/>
	<textarea name="question" rows="3" cols="50"></textarea>
	</div><br/>
		<div id="cate">
		   <label for="cate">Test Category:</label>
		
		  <select name="test_category" id="test_category">
			<option value="1">Web</option>
			<option value="2">Networking</option>
			<option value="3">Research</option>
			<option value="4">Database</option>
			<option value="5">Other</option>
		  </select>
			
		</div><br/>
	
		
		
			 <div id="options">
					<div id="mcqs">
					<label for="options">Select Multiple Choices:</label>
				
				  <select name="sel_options" id="sel_options" onchange="showCh();">
					<option value="2" selected="selected">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				  </select>
			  </div> <br/>
				  <div id="op1">
				  <label for="option" class="text">Option 1:</label>
				  <input type="text" name="optiona" value="" size="50" height="5px" />
				  </div><br/>
	  
					  <div id="op2">
					  <label for="option" class="text">Option 2:</label>
					  <input type="text" name="optionb" value="" size="50" />
				
					  </div><br/>
				  
					  <div id="op3" style="display:none;">
					  <label for="option" class="text">Option 3:</label>
					  <input type="text" name="optionc" value="" size="50" />
					  </div><br/>
			  <div id="op4" style="display:none;">
			  <label for="option" class="text">Option 4:</label>
			  <input type="text" name="optiond" value="" size="50" />
		
			  </div><br/>
		  </div>
		  <br/>

			 <div id="answer"> 
			   <label for="answer">Correct Answer Option:</label>
		
		  <select name="c_correct_id" id="c_correct_id">
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
		  </select>
			
			 </div><br/>
        <div id="button" style="margin-left:330px;"> 
          <input type="submit" name="submit" value="Submit" />
        </div>
		<input type="hidden" name="purl" value="<?php bloginfo("wpurl")?>" />
   </form>

</div>

<script language="javascript" type="text/javascript">
	function showCh(){
		for(var x=1;x<=4;x++){
			document.getElementById('op'+x).style.display='none';
		}
		
		var so = document.getElementById("sel_options").value;
		for(var x=1;x<=so;x++){
			document.getElementById('op'+x).style.display='block';
		}		
	}
</script>


<?php }

function get_category_name($test_category){

	if($test_category==1){
		return 'Web';
	}elseif($test_category==2)
	{
	return 'Networking';
	}
	elseif($test_category==3)
	{
	return 'Database';
	}
	elseif($test_category==4)
	{
	return 'Research';
	}
	else
	{
	return 'Other';
	}
}

  function uog_result_options() {				
  ?>
		<style>
			#res_table { border:1px solid #000000;  }
			#res_table tr td{ border:1px solid #000000; }
			#res_table th { background-color:#66CCFF; }
			#res_table { font-weight:bold; }
		</style>
		<h1 align="center">Student Test Result</h1><br/>
		
		<div id="main" align="center">
		
		
		<?php
		echo "<table  width='90%' align='center' id='res_table' >
		<tr bgcolor='black'>";
	
		echo "<th width='15%'>" .'Student ID'. "</th>" ;
		echo "<th width='25%'>".'Student Name'."</th>";
	
		echo "<th width='15%'>".'Total(25)'."</th>";
		echo "<th width='25%'>".'Test Category'."</th>";
			
		echo "</tr>";
		
	
		
		global $wpdb; 
		$r_table=$wpdb->get_results("SELECT * FROM uog_result");

		foreach ($r_table as $row){
			echo "<tr>";
			echo "<td align='center'>".$row->std_id."</td>";
			echo "<td align='center'>".$row->std_name."</td>";
			
			echo  "<td align='center'>".$row->obtain_marks."</td>";
			echo "<td align='center'>". get_category_name($row->test_category) . "</td>";
			echo "</tr>";
		}
	echo "</table>";
	?></div>
	
	<?php }
//MAKE A SIDE BAR LINK FOR PROJECT LIST
//add_action('admin_menu', 'uog_project_menu');

/*function uog_project_menu() {
	add_options_page('Project List', 'UOG Project List', 'manage_options', 'uog_project', 'uog_project_options');
                          }*/

  function uog_ques_bank() {?>
		<style>
			#bank_table { border:1px solid #000000;  }
			#bank_table tr td{ border:1px solid #000000; }
			#bank_table th { background-color:#66CCFF; }
			#bank_table { font-weight:bold; }
		</style>
		<h1 align="center">Question Bank</h1><br/>
		
		<div id="main" align="center">
		
		
		<?php
		echo "<table  width='90%' align='center' id='bank_table' >
		<tr bgcolor='black'>";
	
		echo "<th width='60%'>" .'Questions'. "</th>" ;
		echo "<th width='15%'>".'Category'."</th>";
		
			
		echo "</tr>";
		
	
		
		global $wpdb; 
		$r_table=$wpdb->get_results("SELECT * FROM uog_questions");
		$x=0;
		foreach ($r_table as $row){
			$x++;
			echo "<tr>";
			echo "<td >".$row->question;
			echo "<br /><a href='#' onClick='showAnswer(".$x.")'>Show Answer</a>";
			$ans_op=$wpdb->get_results("SELECT * FROM uog_answers WHERE question_id=" . $row->question_id);
			echo "<div id = 'ans_".$x."' style='display:none;'>";
		    foreach ($ans_op as $rows){			
				echo "<table id='answers'>
					<tr>
						<td>".$rows->answer_option."</td>";
			
				echo "</tr>";
				echo "</table>";
			}
			echo "</div>";

			echo "<td align='center'>". get_category_name($row->test_category) ."</td>";
			
			echo "</tr>";
		}
	echo "</table>";
	?></div>
<script language="javascript">
	function showAnswer(x){
		v = document.getElementById("ans_" + x).style.display;
		if(v=="block"){
			document.getElementById("ans_" + x).style.display="none"
		}else{
			document.getElementById("ans_" + x).style.display="block"
		}
	}
</script>


	
<?php
  }
// GET INFORMATION OF CURRENT USER AND SAVE INTO RESULT TABLE
function uog_test(){
	$test_category=$_POST['test_category'];

	
	
	global $current_user,$wpdb;

	get_currentuserinfo();
	$uid = $current_user->user_login;
	$uname = $current_user->user_firstname;
	
	//print($uid . "----". $uname);

	
	if(!isset($_SESSION['marks'])){
		$_SESSION['marks'] =0;
	}
	
	require_once("functions.php");
	
	$qno = $_POST["qno"];
	if(isset($qno) && !empty($qno)){
		$val = uog_test_check_question();
		if($val==true){
			$_SESSION['marks'] = $_SESSION['marks'] + 1;
		}
		$ask = uog_test_ask_question();
		
		if($ask=="done"){
			echo "Test Completed, You got : " . $_SESSION['marks'] . " marks.";
				$wpdb->query ("INSERT INTO uog_result (std_id,std_name,obtain_marks,test_category) VALUES 								   										('" . $uid . "','" . $uname . "','" . $_SESSION['marks'] . "','" . $test_category . "')");		
	                      }
		
	}else{
		uog_exam_startbutton("Let's Start");
	     }
}
?>