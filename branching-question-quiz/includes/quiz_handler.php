<?php 
    global $wpdb;
    $question=json_encode($_POST['question']);
    $answer=json_encode($_POST['answer']);
    $terminate=json_encode($_POST['terminate']);
    $prize_msg=json_encode($_POST['prize_msg']);
    $html_content=$_POST['html_content'];
    $tablename = TABLE_NAME;
   if(!isset($_POST['quiz_set_id']))
   {  
       $result=$wpdb->query("INSERT INTO $tablename(question_set, answer_set, terminate_set,prize_msg,html_content) VALUES('$question', '$answer', '$terminate','$prize_msg','$html_content')");
       if($result)
       {
         echo "inseted";
       }
       else
       {
         echo "failed";
       }
       
   }
   else
   {
    $quiz_set_id=$_POST['quiz_set_id'];
    $result=$wpdb->query("UPDATE $tablename SET question_set='$question',answer_set='$answer',terminate_set='$terminate',prize_msg='$prize_msg', html_content='$html_content' WHERE id='$quiz_set_id'");
    if($result)
    {
      echo "updated";
    }
    else
    {
      echo "nothing updated";
    }
   }
   wp_die();

?>