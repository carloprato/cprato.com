<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='margin: 0 auto;'>	
            <h2>Edit reply</h2>		

            	{foreach:edit_reply}
    		<form method='post' action='{{SITE_ROOT}}/{{lang}}/forum/edit/{{loop_element:id}}'>
				<textarea name='reply_content' class='rich_editor' rows='25'>
    					{{loop_element:content}}
    			</textarea>

                <input type='submit' name='submitButton' value='Edit reply'/>
            </form>
				{endforeach}
        </div>
    </div>
    <div class='fill'>
    </div>
</div>