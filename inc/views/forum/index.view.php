<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
            <h2>Forum</h2>
			<table>
                    <tr>
                        <th>
                            Title
                        </th>
                        <th>
                            Author
                        </th>
                        <th>
                            Created
                        </th>
                    </tr>
                    {foreach:topics}			
                        <tr>
                        <td>
                            <a href='{{SITE_ROOT}}/{{lang}}/forum/view_topic/{{loop_element:id}}'>
                            {{loop_element:title}}
                        </td>
                        <td>
                            <a href='{{SITE_ROOT}}/{{lang}}/user/profile/{{loop_element:author}}'>
                                {{loop_element:user}}</a>
                        </td>
                        <td>
                            {{loop_element:date_created}}
                        </td>
                    </tr>
                {endforeach}
                    <tr>
                        <th colspan='3' style='text-align:center'>
                            <b>
                            <a href='{{SITE_ROOT}}/{{lang}}/forum/add'>
                                New Topic</a></b>
                          </th>
                    </tr>
            </table> 
        </div>
    </div>
    <div class='fill'>
    </div>
</div>