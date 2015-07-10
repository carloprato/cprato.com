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
                        <td colspan='3' style='background-color:#BCC;text-align:center'>
                            <a href='{{SITE_ROOT}}/{{lang}}/forum/add'>
                                New Topic</a>
                            Page: <a href='{{SITE_ROOT}}/{{lang}}/forum/add'>
                                1 2 3 4 5 ... 50
                            </a>
                    </tr>
            </table> 
        </div>
    </div>
    <div class='fill'>
    </div>
</div>