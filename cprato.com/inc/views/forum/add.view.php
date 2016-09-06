 <div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			<h2>Create New Topic</h2>

			{if:errors}
			 <div style='background:#FCC;border-top: 3px solid #F66;border-bottom: 3px solid #F66;padding:5px;'>
                    <h3>Error</h3>
                    Some fields were not filled in correctly. Please correct the data you inserted. <br/>
                    {foreach:new_topic_errors}
                        <li> {{loop_element:error}} <br/>  
                    {endforeach}
                </div>
			{elseif}
			{endif}
			<form method='post' action='{{SITE_ROOT}}/{{lang}}/forum/add'>
				<table style='width:100%'>
					<tr>
						<td>
							<input type='text' class='big_text' name='topic_title' placeholder='Insert topic title'/>
						</td>
					</tr>
					<tr>
						<td>
							<textarea name='topic_content' rows='20' cols='30' class='rich_editor'>
							</textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type='submit' name='submit_button' value='Create New Topic'>
						</td>
					</tr>
				</table>
			</form>

        </div>
    </div>
    <div class='fill'>
    </div>
</div>