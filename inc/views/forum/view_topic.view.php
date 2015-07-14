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
                                                    <a name='reply{{loop_element:reply_id}}'></a>             
                        <div class='forum_post_user col_3'>
                            <a style='text-align:center;display:block;margin:0; padding:0;' href='{{SITE_ROOT}}/{{lang}}/user/profile/{{loop_element:user_id}}'>
                                {{loop_element:user}}
                            </a>
                            <img src='/data/res/images/users/{{loop_element:user_id}}.jpg' style='width:100px;margin:0 auto;display:block'/>
                            <span style='text-align:center;display:block;'>{{loop_element:role}}</span>
                            <span style='text-align:center;display:block;'>{{loop_element:count_posts}} posts</span>
                            <span style='text-align:center;display:block;'>Registered: {{loop_element:date}}</span>
                        </div>
                        <div class='col_8 forum_post_content'> 
                            <p style='color:#AAA;text-align:right;'>
                                #{{loop_element:reply_id}} {{loop_element:date_created}}
                            </p>
                            {{loop_element:content}}
                        </div>
                        <div class='forum_post_footer'>
                            {if:user_id == {{loop_element:author}}}
                            <a href='/{{lang}}/forum/delete/{{loop_element:reply_id}}'>Delete</a>
                            -
			                <a href='/en/forum/edit/{{loop_element:reply_id}}'>Edit</a>
                            {elseif}
                            {endif}
                        </div>
                    </div>
                {endforeach}
                
                Page:
                {foreach:pagination}
                     <a href='{{SITE_ROOT}}/{{lang}}/forum/view_topic/{{topic_id}}/{{loop_element:page}}'>
                        {{loop_element:open_b_tag}}{{loop_element:page_name}}{{loop_element:close_b_tag}}</a>
                {endforeach}
                    <form method='post' action='{{SITE_ROOT}}/{{lang}}/forum/add_reply/{{topic_id}}'>
                        <h3>Reply</h3>
                        <textarea class='rich_editor' name='reply_content'></textarea><br/>
                        <input type='submit' style='width:200px;margin:0 auto;display:block;margin-bottom:50px; ' name='submitReply' value='Submit Reply'>            
                    </form>       
            </div>
        </div>
    <div class='fill'>
    </div>
</div>