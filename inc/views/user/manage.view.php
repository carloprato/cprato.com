<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
            <h2>Manage Users</h2>
            	{if:user_list}
                <table>
                    <tr>
                        <th>
                            Username
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            Email
                        </th>
                        <th>
                        </th>
                    </tr>
                    {foreach:user_list}			
                        <tr>
                        <td>
                            <a href='{{SITE_ROOT}}/{{lang}}/user/profile/{{loop_element:id}}'>
                            {{loop_element:user}}
                        </td>
                        <td>
                            {{loop_element:name}}
                        </td>
                        <td>
                            {{loop_element:email}}
                        </td>                     
                        <td>
                            <a href='/{{lang}}/user/accept/{{loop_element:id}}'>Accept user</a> - <b><a href='/{{lang}}/user/refuse/{{loop_element:id}}'><span style='color:#F00';>Refuse user</span></a></b>
                        </td>
                        </tr>
            {endforeach}
            </table> 
            {elseif}
                All users have been accepted.
            {endif}


        </div>
    <div class='fill'>
    </div>
</div>