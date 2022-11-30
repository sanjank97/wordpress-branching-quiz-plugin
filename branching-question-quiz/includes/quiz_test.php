<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div>
     <h4>Click Start button and win the prize to  give correct answer..</h4>
      <button class="start_quiz_btn">Start</button>
</div>



<div class="main-container2">
    <form id="user-quiz-form"></form>
    <div class="preview_content"></div>
</div>
<script>
    var question_set;
    var answer_set;
    var terminate_set;
    var prize_msg;
    let a;
    let b;
    let c;
    let d;
    var result_set={}; 
    var qno;
    var res = <?php echo json_encode($shortcode_value[0]); ?>;
    jQuery(document).ready(function(){ 
        jQuery('.start_quiz_btn').click(function(){
          jQuery('.preview_content').html("");
          jQuery('.preview-quiz-wrapper').html("");
            qno=1;
            result_set={};
            question_set=res.question_set;
            a=JSON.parse(question_set);
            answer_set=res.answer_set;
            b=JSON.parse(answer_set);  
            terminate_set=res.terminate_set;
            c=JSON.parse(terminate_set);
            prize_msg =res.prize_msg;
            d=JSON.parse(prize_msg);

            var quizhtml="";                   
            quizhtml+= '<h3><span>'+qno+'.</span>'+a[1]+'</h3>';
            quizhtml+='<input type="hidden" value="1" name="ques_key"/>';
            if(b!=null)
            {
              Object.keys(b[1]).forEach(function(key) {
              quizhtml+= '<p><span> ' +key+ '.</span><input type="radio" value="'+key+'"  name="ans_key">'+b[1][key]+'</p>';
            });
              quizhtml+='<div class="quiz-next-btn-wrapper"><button class="quiz-next-btn" >Save</button></div>';
            }
            jQuery('#user-quiz-form').html(quizhtml);    
        });
                                       
    });
    jQuery(document).on('click','#user-quiz-form input',function(e){
          //e.preventDefault();
          var ques_key= jQuery('input[name="ques_key"]').val();
          var ans_key=jQuery(this).val();
          var new_ques_key=parseInt(ques_key+''+ans_key+'1');
    });
    jQuery(document).on('click','.quiz-next-btn',function(e){
         e.preventDefault();
         qno=qno+1;
         var ques_key= jQuery('input[name="ques_key"]').val();
         var ans_key=jQuery('input[name="ans_key"]:checked').val();
         result_set[ques_key]=ans_key;
       
         if(ans_key==undefined)
         {
            alert("first select option then proceed to next question");
         }
         else
         {
   
          if(c[ques_key]!="" && c[ques_key]==ans_key)
          {
            alert(d[ques_key]);
            jQuery('#user-quiz-form').html("");
            jQuery('#user-quiz-form').after("<div class='preview-quiz-wrapper'><button class='preview-quiz'>Preview Quiz</button><span>"+d[ques_key]+"</span></div>");
          }
          else
          {
              var new_ques_key=parseInt(ques_key+''+ans_key+'1');
              var quizhtml="";
              if(a[new_ques_key]!=undefined)
              {
                
                quizhtml+= '<h3><span>'+qno+ ' .</span>'+a[new_ques_key]+'</h3>';
                quizhtml+='<input type="hidden" value="'+new_ques_key+'" name="ques_key"/>';
                if(b[new_ques_key]!=undefined)
                {
                  Object.keys(b[new_ques_key]).forEach(function(key) {
                  quizhtml+= '<p><span> ' +key+ '.</span><input type="radio" value="'+key+'"  name="ans_key">'+b[new_ques_key][key]+'</p>';

                  });
                  quizhtml+='<div class="quiz-next-btn-wrapper"><button class="quiz-next-btn" >Save</button></div>';
                  jQuery('#user-quiz-form').html(quizhtml);
                }
                else
                {
                  alert("Better Luck Next Time");
                  jQuery('#user-quiz-form').html("");
                  jQuery('#user-quiz-form').after("<div class='preview-quiz-wrapper'><button class='preview-quiz'>Preview Quiz</button><span>Better Luck Next Time</span></div>");
                }
               
              }
              else
              {
                  alert("Better Luck Next Time");
                  jQuery('#user-quiz-form').html("");
                  jQuery('#user-quiz-form').after("<div class='preview-quiz-wrapper'><button class='preview-quiz'>Preview Quiz</button><span>Better Luck Next Time</span></div>");
              }
          }
    
         }
       
    });

    jQuery(document).on('click','.preview-quiz',function(e){
      var prehtml="";
      qno=1;
       Object.keys(result_set).forEach(function(key) { 
            prehtml+='<h3><span>'+(qno++)+ '.</span> ' +a[key]+'</h3>';
            Object.keys(b[key]).forEach(function(key2) {
              if(result_set[key]==key2)
              {
                prehtml+= '<p><span>'+key2+ '.</span><input type="radio" value="'+key2+'"   checked />'+b[key][key2]+'</p>';
              }
              else
              {
                prehtml+= '<p><span>'+key2+ '.</span><input type="radio" value="'+key2+'"   />'+b[key][key2]+'</p>';
              }
              
            });

       });
       jQuery('.preview_content').html(prehtml);
    });



   
</script> 
