<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
                <h2>Send a new message</h2>
                <form method='post' action='{{SITE_ROOT}}/{{lang}}/messages/send'>
					<table>
						<tr>
							<td>
								<input type='text' name='recipient' placeholder='Send to...' class='big_text'>
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
            </div>
        </div>
    <div class='fill'>
    </div>
</div>