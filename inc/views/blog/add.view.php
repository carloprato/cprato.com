 <div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			<h2>Add New Post</h2>
			<form method='post' action='{{SITE_ROOT}}/{{lang}}/blog/add'>
				<table style='width:100%'>
					<tr>
						<td>
							<input type='text' class='big_text' name='post_title' placeholder='Insert post title'/>
						</td>
					</tr>
					<tr>
						<td>
							<textarea name='post_content' rows='20' cols='30' class='rich_editor'>
							</textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type='submit' name='submit_button' value='Create New Post'>
						</td>
					</tr>
				</table>
			</form>

        </div>
    </div>
    <div class='fill'>
    </div>
</div>