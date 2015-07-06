<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='margin: 0 auto;'>			
    		<form method='post' action='{{SITE_ROOT}}/{{lang}}/forum/edit'>
            	{foreach:edit_reply}
				<textarea name='reply_content' class='rich_editor' rows='25'>
    					{{loop_element:content}}
    			</textarea>
				{endforeach}
                <input type='submit' name='submitButton' value='Edit reply'/>
            </form>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>