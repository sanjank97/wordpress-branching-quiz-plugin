
<table class="branching-quiz-table">
  <tr>
     <th>Quiz Set</th>
     <th>Quiz ID</th>
     <th>Edit</th>
     <th>Delete</th>
     <th>Shortcode </th>
  </tr>
<?php 
  global $wpdb;
  $tablename=TABLE_NAME;
  $results=$wpdb->get_results('select * from '.$tablename);

  if(!empty($results))                        
  { 
    $k=1;
    foreach($results as $row){ 
    {
        ?>
            <tr>
                <td><?php echo $k.'.';?></td>
                <td><?php echo '#'.$row->id;?></td>
                <td><a class="edit-quiz-set" data="<?php echo $row->id?>"> <i class="fa fa-pencil" aria-hidden="true"></i></a></td>  
                <td><a class="delete-quiz-set" data="<?php echo $row->id?>"> <i class="fa fa-trash" aria-hidden="true"></i></a></td> 
                <td><?php echo "[braching_quiz id=$row->id]"?></td> 
            </tr>
            <tr id="<?php echo 'quiz-id'.$row->id;?>">
                <td  class="appendTd" colspan="5">
                  <div class="main-container1">
                      <div class="quiz-info">
                          <span>Quiz set - <?php echo $k;?></span>
                          <span>Quiz ID -<?php echo '#'.$row->id?></span>
                          <span ><i class="fa fa-times remove-quiz-set" data="<?php echo $row->id?>" aria-hidden="true"></i></span>

                       </div>
                      <form>

                      </form>
                  </div>
                </td>
            </tr>
        <?php
      $k++;
    }
  }
}
?>
</table>

<script>
    //  // Display All Quiz Sets
    // jQuery(document).ready(function(){
    //     jQuery('.edit-quiz-set').click(function(){
    //         var quiz_set_id = jQuery(this).attr('data');
    //         jQuery('#quiz-id'+quiz_set_id+' td').css('display','table-cell');
    //         jQuery.ajax({
    //             // url: '<?php echo PLUGIN_URL.'includes/quiz_ajax.php'?>',
    //             url:branching_quiz_ajaxurl.ajax_url,
    //             type: 'post',
    //             data: {'action':'all_fetch_quiz','quiz_set_id':quiz_set_id},            
    //             success: function (res) {  
    //               if(JSON.parse(res).html_content.indexOf('quiz_set_id') !== -1)
    //               {                  
    //                 jQuery('#quiz-id'+quiz_set_id+' form').html(JSON.parse(res).html_content);
    //               }
    //               else
    //               {
    //                 jQuery('#quiz-id'+quiz_set_id+' form').html('<input type="hidden" name="quiz_set_id" value="'+quiz_set_id+'"/> '+JSON.parse(res).html_content);
    //               }
    //                 var question_set=JSON.parse(res).question_set;
    //                 var answer_set=JSON.parse(res).answer_set;
    //                 var terminate_set=JSON.parse(res).terminate_set;
    //                 let a=JSON.parse(question_set);
    //                 let b=JSON.parse(answer_set);
    //                 let c=JSON.parse(terminate_set);
    //                 Object.keys(a).forEach(function(key) {
    //                   jQuery('#quiz-id'+quiz_set_id+' form input[name="question['+key+']"]').val(a[key]);

    //                 });
    //                 Object.keys(b).forEach(function(key) {
    //                   Object.keys(b[key]).forEach(function(key2) {   
    //                     jQuery('#quiz-id'+quiz_set_id+' form input[name="answer['+key+']['+key2+']"]').val(b[key][key2]);
    //                   });
    //                 });

    //                 Object.keys(c).forEach(function(key) {
    //                   jQuery('#quiz-id'+quiz_set_id+' form select[name="terminate['+key+']"]').val(c[key]).change();

    //                 });
                       
    //             }
    //         });
    //     });
    //     //Hide displayed Quiz set
    //    jQuery('.remove-quiz-set').click(function(){
    //       var quiz_set_id=jQuery(this).attr('data');
    //       jQuery('#quiz-id'+quiz_set_id+' td').css('display','');
    //    });
    //    //Delete Quiz sets
    //    jQuery('.delete-quiz-set').click(function(){
    //     var quiz_set_id = jQuery(this).attr('data');
    //     jQuery.ajax({
    //             // url: '<?php echo PLUGIN_URL.'includes/quiz_ajax.php'?>',
    //             url:branching_quiz_ajaxurl.ajax_url,
    //             type: 'post',
    //             data: {'action':'all_fetch_quiz','quiz_set_delete_id':quiz_set_id},
    //             success: function (res) { 
    //                console.log(res);
    //                location.reload();
    //              }
    //     });
    //    });

    // }) 
</script>
<script>
// // Update each Quiz set
// jQuery(document).on('click','.final_submit',function(e){
//   e.preventDefault();
//    var form = jQuery(this).parents('form:first') //selelet current form of current submit buttom
//    var html=form.html();
//    jQuery(this).prev().val(html);
//     jQuery.ajax({
//       type: 'post',
//       url: '<?php echo PLUGIN_URL.'includes/quiz_handler.php'?>',
//       data: form.serialize(),
//       success: function (res) {
//          console.log(res);
//          alert('form was updated');
       
//       }
//     });
// });
</script>

