<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='margin: 0 auto;'>
			<h2>Create New Page</h2>
			<form method='post' action='{{SITE_ROOT}}/{{lang}}/editor/add'>
				<table style='width:100%'>
					<tr>
						<td>
								<input type='text' class='big_text' name='page_name' placeholder='Page name'/>
						</td>
					</tr>
					<tr>
						<td>
							<textarea class="rich_editor" rows='20' cols='30' name='page_content'>
							</textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type='submit' name='submit_button' value='Create New Page'>
						</td>
					</tr>
				</table>
			</form>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>

