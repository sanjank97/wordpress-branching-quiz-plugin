
<?php
    global $wpdb;
    $tablename=TABLE_NAME;
    if(isset($_POST['quiz_set_id']))
    {
        $quiz_set_id=$_POST['quiz_set_id'];
        $results=$wpdb->get_results("select * from $tablename where id=$quiz_set_id");
        if(!empty($results))                        
        { 
            echo json_encode($results[0]);
        }

    }
    if(isset($_POST['quiz_set_delete_id']))
    {
    $quiz_set_delete_id=$_POST['quiz_set_delete_id'];
    $results=$wpdb->query("delete  from $tablename where id=$quiz_set_delete_id");
    if($results)
    {
        echo "deleted";
    }
    else
    {
        echo "failed";
    }

    }
    wp_die();

?>