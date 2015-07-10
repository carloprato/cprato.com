<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
            <h2>User List</h2>
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
                            Created
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
                            {{loop_element:date}}
                        </td>
                    </tr>
            {endforeach}
            </table> 

        </div>
    <div class='fill'>
    </div>
</div>