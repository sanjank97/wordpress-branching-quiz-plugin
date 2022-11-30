 <div class="main-container">
    <form>
        <input type="hidden" value="add_new_quiz" name="action"/>
        <button class="add_question">Add Question</button>
        <div class="question-box"></div>
        <div class="options-box"></div>
        <input type="hidden" id="html_content" name="html_content">
        <input type="submit" value="Submit" disabled class="final_submit">
    </form>

</div>
<script>
/*
 //Save Question pattern with data into database.
*/
// jQuery(document).ready(function() {
//     jQuery('.final_submit').on('click', function (e) {
//         e.preventDefault();
//         var html=jQuery('form').html();
//         jQuery('#html_content').val(html);
//         var data=jQuery("form").serialize();
//         console.log(data);
//         jQuery(this).closest('form').find('.add_question:first').removeAttr("disabled");
//         jQuery(this).closest('form').find('.question-box:first').empty();
//         var form_submit_btn=jQuery(this)
//         jQuery.ajax({
//             type: 'post',
//             //  url: '<?php echo PLUGIN_URL.'includes/quiz_handler.php'?>',
//             url:branching_quiz_ajaxurl.ajax_url,
//             data: data,
//             success: function (res) {
//                 console.log(res);
//                 alert('form was submitted');
//                 form_submit_btn.attr('disabled','disabled');
//             }
//         });
//     });
// });

</script>


