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
                    <div style='background-color:#CDD;border:2px solid #ABB; min-height:100px;margin-bottom:10px;'>             
                        <div style='vertical-align:top;  border:1px solid #CDD;background-color:#DEE;margin:0 auto;  height:100%;  box-shadow:5px 0px 5px #888888;' class='col_3'>
                            <a href='{{SITE_ROOT}}/{{lang}}/user/profile/{{loop_element:user_id}}'>
                                {{loop_element:user}}
                            </a>
                            <br/>
                            Posts: {{loop_element:count_posts}} <br/>
                            Registered: {{loop_element:date_created}} <br/>
                            <img src='/data/res/images/avatar.png' style='width:100px;'/>
                        </div>
                        <div style=' margin:0;padding-left:10px' class='col_8'> 
                            {{loop_element:content}}
                        </div>
                        <div style='background-color:#BCC;padding-left:5px;box-shadow:4px 0px 5px #888888;'>
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