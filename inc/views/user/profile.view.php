<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			{foreach:user_details}
				<h2>{{loop_element:user}}'s Profile</h2>
                
                <table>
                    <tr>
                        <td>
                            Name
                        </td>
                        <td>
                            {{loop_element:name}}
                        </td>  
                    </tr>
                    <tr>
                        <td>
                            E-mail
                        </td>
                        <td>
                            {{loop_element:email}}
                        </td>  
                    </tr>
                    <tr>
                        <td>
                            Permissions
                        </td>
                        <td>
                            {{loop_element:privileges}}
                        </td>  
                    </tr>
                </table>		   
			{endforeach}
        </div>
    <div class='fill'>
    </div>
</div>