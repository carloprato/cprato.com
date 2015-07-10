<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
                <h2>{{topic_title}}</h2>
                
                Page:
                {foreach:pagination}
                     <a href='{{SITE_ROOT}}/{{lang}}/forum/view_topic/{{topic_id}}/{{loop_element:page}}'>
                        {{loop_element:open_b_tag}}{{loop_element:page_name}}{{loop_element:close_b_tag}}</a>
                {endforeach}
                <p style='margin-bottom:10px;'></p> 
                {foreach:replies}
                    <div class='forum_post_container'>             
                        <div class='col_3 forum_post_user'>
                            <a href='{{SITE_ROOT}}/{{lang}}/user/profile/{{loop_element:user_id}}'>
                                {{loop_element:user}}
                            </a>
                            <br/>
                            Posts: {{loop_element:count_posts}} <br/>
                            Registered: {{loop_element:date_created}} <br/>
                            <img src='/data/res/images/avatar.png' style='width:100px;'/>
                        </div>
                        <div class='col_8 forum_post_content'> 
                            {{loop_element:content}}
                        </div>
                        <div class='forum_post_footer'>
                            <a href='/{{lang}}/forum/delete/{{loop_element:reply_id}}'>Delete Post</a>
                            -
			                <a href='/en/forum/edit/{{loop_element:reply_id}}'>Edit this post</a>
                        </div>
                    </div>
                {endforeach}
                
                Page:
                {foreach:pagination}
                     <a href='{{SITE_ROOT}}/{{lang}}/forum/view_topic/{{topic_id}}/{{loop_element:page}}'>
                        {{loop_element:open_b_tag}}{{loop_element:page_name}}{{loop_element:close_b_tag}}</a>
                {endforeach}
                {if:user}
                    <form method='post' action='{{SITE_ROOT}}/{{lang}}/forum/add_reply/{{topic_id}}'>
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