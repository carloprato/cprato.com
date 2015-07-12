<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			{foreach:post_content}
                <h2>{{loop_element:post_title}} ({{loop_element:post_date}}) <span style='font-size:16px;'>by {{loop_element:user}}</span></h2>
                    {{loop_element:post_content}}
                {endforeach}
          
            <p style='margin-top:20px'>
                <h3>Comments</h3>
                {foreach:comments}
                    <p>
                        <strong>
                            {{loop_element:user}}
                        </strong>
                        ({{loop_element:date_created}}): 
                        {{loop_element:content}}
                    </p>
                {endforeach}
            </p>
                    <h3>Insert comment</h3>
            {if:user}
                {foreach:post_content}
                <form method='post' action='{{SITE_ROOT}}/{{lang}}/blog/add_comment/{{loop_element:post_id}}'>
                    <textarea class='rich_editor' name='comment_content'></textarea><br/>
                    <input type='submit' style='width:200px;margin:0 auto;display:block;margin-bottom:50px;' name='submitComment' value='Submit Comment'>            
                </form>
                {endforeach}
            {elseif}
                You need to <a href='/{{lang}}/auth'>login</a> to comment on this post. <br/><br/>
            {endif}            
        </div>
    </div>
    <div class='fill'>
    </div>
</div>