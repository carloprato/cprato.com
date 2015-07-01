<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			<h2>{{post_title}} ({{post_date}})</h2>
            
            {{post_content}}
            
            <p style='margin-top:20px'>
                <h3>Comments</h3>
                {foreach:comments}
                    <p>
                        <strong>
                            {{loop_element:name}} - {{loop_element:user}}
                        </strong>
                        ({{loop_element:date_created}}): 
                        {{loop_element:content}}
                    </p>
                {endforeach}
            </p>
            <form method='post' action='{{SITE_ROOT}}/{{lang}}/blog/add_comment/{{post_id}}'>
                <h3>Insert comment</h3>
                <textarea class='rich_editor' name='comment_content'></textarea><br/>
                <input type='submit' style='width:200px;margin:0 auto;display:block;margin-bottom:50px;' name='submitComment' value='Submit Comment'>
            </form>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>