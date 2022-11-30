/**
 * Add Answer/option
 */
var q=1;
var question_path;
var question_path_key;
var ans=0;
var option_length=0;
jQuery(document).on('click','.add_answer_btn',function(e){
    e.preventDefault();
    question_path_key = jQuery(this).prev().attr('ques_path_key');
    option_length=parseInt(jQuery(this).next().find('.ques_option_'+question_path_key).length); 
    ans=option_length; 
    ans=ans+1;
    if(ans < 5)
    {
      jQuery(this).next().append('<br><span class="ques_option_'+question_path_key+'">'+question_path_key.split('').join('.')+'.'+(ans)+'</span><input type="text"  ans_path_key="'+question_path_key+''+ans+'" name="answer['+question_path_key+']['+ans+']" placeholder="enter answer"><button class="add_question">Add Question</button><div class="question-box"></div>');
      jQuery(this).next().next().children('select').append('<option value="'+ans+'">'+question_path_key.split('').join('.')+'.'+ans+'</option>');
    }
    else
    {
      alert("Maximum option length is 4.");
    } 
});
/**
 * Add Questions
 */
jQuery(document).on('click','.add_question',function(e){
    e.preventDefault();
    var ans_path_key = jQuery(this).prev().attr('ans_path_key');
    if(ans_path_key!=undefined)
    {
        question_path_key= ans_path_key+''+q;  
        question_path= ans_path_key.split('').join('.')+'.'+q;
    }
    else
    {
        question_path_key=q;
        question_path=q;
    }
    jQuery('input[type="submit"]').removeAttr("disabled");
    ans=0;
    jQuery(this).attr('disabled','disabled');
    jQuery(this).next().html('<span class="ques_no ques_no'+question_path_key+' ">'+question_path+'</span><input class="question-input-field" ques_path_key="'+question_path_key+'"   name="question['+question_path_key+']" type="text" placeholder="enter a quetsion" /> <button class="add_answer_btn">Add Answer</button><div class="options-box"> </div> <div class="terminate_quiz_option" ><p>You can set stop quiz otherwise skip </p><select name="terminate['+question_path_key+']"><option value="">defaul empty</option></select></div> <button class="remove">remove</button> ');
    jQuery(this).next().css('margin-left','100px');
});
/*
 //Remove questions
*/ 
jQuery(document).on('click','.remove',function(e){
    e.preventDefault();
    jQuery(this).parent().prev().removeAttr("disabled");
    jQuery(this).parent().empty();
    if (jQuery('form').find('.question-box:first').is(':empty')){
        jQuery('.final_submit').attr('disabled','disabled');
    }
});

jQuery(document).on('change','.terminate_quiz_option select',function(e){
    e.preventDefault(); 
    var terminate_option;
    var length =$(this).children('option').length;

    for(var i=1;i<length;i++)
    {
        terminate_option=jQuery(this).children("option")[i].innerHTML.split('.').join('').trim();
        console.log(terminate_option);
        jQuery('input[ans_path_key="'+terminate_option+'"]').next().removeAttr("disabled");
        jQuery('input[ans_path_key="'+terminate_option+'"]').next().next().next('p:first').remove();
    }
    terminate_option=jQuery(this).children(":selected").text().split('.').join('').trim();
    console.log("selected",terminate_option);
    jQuery('input[ans_path_key="'+terminate_option+'"]').next().attr('disabled','disabled');

    jQuery('input[ans_path_key="'+terminate_option+'"]').next().next().empty();
    var span_width=jQuery('input[ans_path_key="'+terminate_option+'"]').prev().width();
    jQuery('input[ans_path_key="'+terminate_option+'"]').next().next().after("<p class='message-box' style='margin-left:"+span_width+"px'><input name='prize_msg["+terminate_option.slice(0,-1).trim()+"]' type='text' placeholder='Enter message eg- You won watch...'/></p>");
    


   // console.log(length);

    
   
});

