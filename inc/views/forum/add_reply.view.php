<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
  		    <h2>Insert New Reply</h2>
            {if:errors}
			         <div style='background:#FCC;border-top: 3px solid #F66;border-bottom: 3px solid #F66;padding:5px;'>
                         <h2>Error</h2>

                            Some fields were not filled in correctly. Please correct the data you inserted. <br/>
                         {foreach:new_reply_errors}
                            <li> {{loop_element:error}} <br/>  
                         {endforeach}
                     </div>
			{elseif}
		      	Your reply was inserted successfully.
                <a href='{{SITE_ROOT}}/{{lang}}/forum/view_topic/{{topic_id}}'>Back to the topic</a>
            {endif}	
        </div>
    </div>
    <div class='fill'>
    </div>
</div>