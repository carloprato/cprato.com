<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='margin: 0 auto;'>	
            <h2>Edit {{arg}} page</h2>		
    		<form method='post' action='{{SITE_ROOT}}/{{lang}}/editor/edit/{{arg}}'>
            	<textarea name='page_content' class='rich_editor' rows='25'>
    					{{page_content}}
    			</textarea>
                <input type='submit' name='submitButton' value='Edit page'/>
            </form>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>