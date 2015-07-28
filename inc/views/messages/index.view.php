<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
                <h2>Messages</h2>
                <a href='/{{lang}}/messages/send'>
                    Send a new message
                </a>
                <table>
                    <tr>
                        <th>
                            User
                        </th>
                    </tr>
				{foreach:messages}
                    <tr>
                        <td>
                            <a href='/{{lang}}/messages/thread/{{loop_element:sender}}'>
                                {{loop_element:sender_user}}
                            </a>
                        </td>
                    </tr>
				{endforeach}
                </table>
			</div>
        </div>
    <div class='fill'>
    </div>
</div>