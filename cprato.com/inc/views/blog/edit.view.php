 <div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			<h2>Edit Post</h2>
			{foreach:post_to_edit}
			<form method='post' action='{{SITE_ROOT}}/{{lang}}/blog/edit/{{loop_element:post_id}}'>
				<table style='width:100%'>
					<tr>
						<td>
							<input type='text' class='big_text' name='post_title' placeholder='{{loop_element:post_title}}'/>
						</td>
					</tr>
					<tr>
						<td>
							<textarea name='post_content' rows='20' cols='30' class='rich_editor'>
								{{loop_element:post_content}}
							</textarea>
						</td>
					</tr>
					<tr>
						<td>
							<input type='submit' name='submit_button' value='Edit Post'>
						</td>
					</tr>
				</table>
			</form>
				{endforeach}
        </div>
    </div>
    <div class='fill'>
    </div>
</div>