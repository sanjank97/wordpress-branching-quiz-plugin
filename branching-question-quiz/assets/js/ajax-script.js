/*
 //Save Question pattern with data into database.
*/
jQuery(document).on('click','.final_submit',function(e){
        e.preventDefault();
        var check_form=$("input[name='quiz_set_id']").length;
        if(check_form >0)
        {
            // Updated Quiz sets
            var form = jQuery(this).parents('form:first') //selelet current form of current submit buttom
            var html=form.html();
            jQuery(this).prev().val(html);
            jQuery.ajax({
                type: 'post',
                // url: '<?php echo PLUGIN_URL.'includes/quiz_handler.php'?>',
                url:branching_quiz_ajaxurl.ajax_url,
                data: form.serialize(),
                success: function (res) {
                console.log(res+"****");
                alert('form was updated');
                
                }
            });
        }
        else
        {
            // Added Quiz sets
            var html=jQuery('form').html();
            jQuery('#html_content').val(html);
            var data=jQuery("form").serialize();
            jQuery(this).closest('form').find('.add_question:first').removeAttr("disabled");
            jQuery(this).closest('form').find('.question-box:first').empty();
            var form_submit_btn=jQuery(this)
            jQuery.ajax({
                type: 'post',
                //  url: '<?php echo PLUGIN_URL.'includes/quiz_handler.php'?>',
                url:branching_quiz_ajaxurl.ajax_url,
                data: data,
                success: function (res) {
                    console.log(res+"----");
                    alert('form was submitted');
                    form_submit_btn.attr('disabled','disabled');
                }
            });
        }
      
    });


         // Display All Quiz Sets
         jQuery(document).ready(function(){
            jQuery('.edit-quiz-set').click(function(){
                var quiz_set_id = jQuery(this).attr('data');
                jQuery('#quiz-id'+quiz_set_id+' td').css('display','table-cell');
                jQuery.ajax({
                    // url: '<?php echo PLUGIN_URL.'includes/quiz_ajax.php'?>',
                    url:branching_quiz_ajaxurl.ajax_url,
                    type: 'post',
                    data: {'action':'all_fetch_quiz','quiz_set_id':quiz_set_id},            
                    success: function (res) {  
                      if(JSON.parse(res).html_content.indexOf('quiz_set_id') !== -1)
                      {                  
                        jQuery('#quiz-id'+quiz_set_id+' form').html(JSON.parse(res).html_content);
                      }
                      else
                      {
                        jQuery('#quiz-id'+quiz_set_id+' form').html('<input type="hidden" name="quiz_set_id" value="'+quiz_set_id+'"/> '+JSON.parse(res).html_content);
                      }
                        var question_set=JSON.parse(res).question_set;
                        var answer_set=JSON.parse(res).answer_set;
                        var terminate_set=JSON.parse(res).terminate_set;
                        var prize_msg=JSON.parse(res).prize_msg;
                        let a=JSON.parse(question_set);
                        let b=JSON.parse(answer_set);
                        let c=JSON.parse(terminate_set);
                        let d=JSON.parse(prize_msg);
                        Object.keys(a).forEach(function(key) {
                          jQuery('#quiz-id'+quiz_set_id+' form input[name="question['+key+']"]').val(a[key]);
    
                        });
                        Object.keys(b).forEach(function(key) {
                          Object.keys(b[key]).forEach(function(key2) {   
                            jQuery('#quiz-id'+quiz_set_id+' form input[name="answer['+key+']['+key2+']"]').val(b[key][key2]);
                          });
                        });
    
                        Object.keys(c).forEach(function(key) {
                          jQuery('#quiz-id'+quiz_set_id+' form select[name="terminate['+key+']"]').val(c[key]).change();
    
                        });

                        Object.keys(d).forEach(function(key) {
                          jQuery('#quiz-id'+quiz_set_id+' form input[name="prize_msg['+key+']"]').val(d[key]);
    
                        });
                           
                    }
                });
            });
            //Hide displayed Quiz set
           jQuery('.remove-quiz-set').click(function(){
              var quiz_set_id=jQuery(this).attr('data');
              jQuery('#quiz-id'+quiz_set_id+' td').css('display','');
           });
           //Delete Quiz sets
           jQuery('.delete-quiz-set').click(function(){
            var quiz_set_id = jQuery(this).attr('data');
            jQuery.ajax({
                    // url: '<?php echo PLUGIN_URL.'includes/quiz_ajax.php'?>',
                    url:branching_quiz_ajaxurl.ajax_url,
                    type: 'post',
                    data: {'action':'all_fetch_quiz','quiz_set_delete_id':quiz_set_id},
                    success: function (res) { 
                       console.log(res);
                       location.reload();
                     }
            });
           });
    
        }) 


