<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			{foreach:user_details}
				<h2><img style='height:100px;width:auto;margin-right:10px;' src='/data/res/images/users/{{loop_element:id}}.jpg' />{{loop_element:user}}'s Profile</h2>
                
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
                            Registered:
                        </td>
                        <td>
                            {{loop_element:date}}
                        </td>  
                    </tr>
                    <tr>
                        <td>
                            Permissions
                        </td>
                        <td>
                            {{loop_element:role}}
                        </td>  
                    </tr>
                </table>
                {if:edit_profile}
                    <a href='{{SITE_ROOT}}/{{lang}}/user/edit_profile'>{{translate:edit_your_profile}}</a>		   
			    {elseif}
                {endif}
            {endforeach}
        </div>
    <div class='fill'>
    </div>
</div>