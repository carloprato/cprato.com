<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
                {foreach:topics}
                    <h2>{{loop_element:title}}</h2>
                {endforeach}
                {foreach:replies}
            
                <div style='background-color:#DEE;padding:10px 10px 5px 10px;border-bottom:2px solid #CDD;'>
                    #{{loop_element:id}} - ({{loop_element:date_created}})
                </div>
                <div style='background-color:#DEE;padding:10px 10px 5px 10px;'>
                    {{loop_element:user}}
                </div>
                <div style='background-color:#DEE;padding:10px 10px 5px 10px;margin-bottom:20px;'>
                      {{loop_element:content}}
                <div style='background-color:#BCC;padding-left:5px;margin-top:10px;'>

                        <a href='/{{lang}}/forum/delete/{{loop_element:id}}'>Delete Post</a>

                     - 
                     
                     <a href='/en/forum/edit/{{loop_element:id}}'>Edit this post</a>
                </div>
            </div>

                {endforeach}

            {if:user}
                <form method='post' action='{{SITE_ROOT}}/{{lang}}/forum/add_reply/{{id}}'>
                    <h3>Reply</h3>
                    <textarea class='rich_editor' name='reply_content'></textarea><br/>
                    <input type='submit' style='width:200px;margin:0 auto;display:block;margin-bottom:50px; ' name='submitReply' value='Submit Reply'>            
                </form>   
            {elseif}
                You need to <a href='/{{lang}}/auth'>login</a> to comment on this post.
            {endif}      
        </div>
    </div>
    <div class='fill'>
    </div>
</div>