<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
                <h2>Private conversation with {{recipient}}</h2>
                <a href='/{{lang}}/messages'>Back to messages list</a>
                <form method='post' action='{{SITE_ROOT}}/{{lang}}/messages/send'>
					<table>
						<tr>
							<td>
								<input type='text' name='recipient' value='{{recipient}}' class='big_text'>
							</td>
						</tr>
						<tr>
							<td>
								<textarea class='rich_editor' name='content'></textarea>
							</td>
						</tr>
						<tr>
							<td>
								<input type='submit' style='width:200px;margin:0 auto;display:block;' name='submitButton' value='Send Message'/>            
							</td>
						</tr>
					</table>
                </form>   
                {foreach:messages}
                    <div class='forum_post_container'>
                    <a name='reply{{loop_element:reply_id}}'></a>             
                        <div class='col_12 forum_post_content'> 
                            <p style='color:#AAA;text-align:right;'>
                                <a style='text-align:left;display:block;margin:0; padding:0;float:left' href='{{SITE_ROOT}}/{{lang}}/user/profile/{{loop_element:user_id}}'>
                                {{loop_element:sender_user}}
                            </a>
                                #{{loop_element:id}} {{loop_element:message_date}}
                            </p>
                                
                            {{loop_element:content}}
                        
                        </div>                        <div class='forum_post_footer'>

                        </div>
                    </div>
                {endforeach}
			</div>
        </div>
    <div class='fill'>
    </div>
</div>