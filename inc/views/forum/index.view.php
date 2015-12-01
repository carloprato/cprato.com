<div class='content_container'>

        <div class='row ' style='padding-top:10px;'>
                    <div class='evidence_paragraph'>
                  			    <div class='col_9'>
                                    <h2>Forum</h2>
                                </div>
			    <div class='col_4' style='text-align:right'>
                    <form method='post' action='/{{lang}}/search/results/forum'>
                    <input type='text' name='search_string' placeholder='Search forum posts...' style='width:200px'/>
                    <input type='submit' value='Search'/>    
                    </form> 
                </div>
         </div>   
    <div class="row content">

        <div class='col_12 content_paragraph'>

			<table>
                    <tr>
                        <th>
                            Title
                        </th>
                        <th  style='text-align:center;'>
                            Started
                        </th>
                        <th  style='text-align:center;'>
                            Replies
                        </th>
                        <th  style='text-align:center;'>
                            Last reply
                        </th>
                    </tr>
                    {foreach:topics}			
                        <tr>
                        <td>
                            <a href='{{SITE_ROOT}}/{{lang}}/forum/view_topic/{{loop_element:topic_id}}'>
                            {{loop_element:title}}                    </a><br/><span style='font-size:14px;color:#AAA;'>     by    
                              </span><a href='{{SITE_ROOT}}/{{lang}}/user/profile/{{loop_element:author}}'><span style='font-size:14px;color:#AAA;'>    
                                {{loop_element:user}}</span></a>
                        </td>
                        <td style='text-align:right;'>
                            {{loop_element:date_created}}
                        </td>
                        <td style='text-align:right;'>
                            {{loop_element:count_replies}}
                        </td>
                        <td style='text-align:right;'>
                            {{loop_element:last_reply_date}} 
                        </td>
                    </tr>
                {endforeach}
                    <tr>
                        <th colspan='4' style='text-align:center'>
                            <b>
                            <a href='{{SITE_ROOT}}/{{lang}}/forum/add'>
                                New Topic</a></b>
                          </th>
                    </tr>
            </table> 
        </div>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>