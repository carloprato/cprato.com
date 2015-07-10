<div class='content_container'>
    <div class="row content">
        <div class='col_6 content_paragraph'>

				<h2>Edit Profile</h2>
            {foreach:edit_profile_errors}
                {{loop_element:error}}
            {endforeach}
            {foreach:user_details}    
                <form method='post' action=''>
                    <table>
                        <tr>
                            <td>
                                Username
                            </td>
                            <td>
                                {{loop_element:user}}
                            </td>  
                        </tr>
                        <tr>
                            <td>
                                Name
                            </td>
                            <td>
                                <input type='text' name='new_name' placeholder='{{loop_element:name}}'/>
                            </td>  
                        </tr>
                        <tr>
                            <td>
                                Password
                            </td>
                            <td style='align:right'>                                
                                <input type='password' name='old_password' placeholder='Old password'/><br/>
                                <input type='password' name='new_password' placeholder='New password'/><br/>
                                <input type='password' name='confirm_password' placeholder='Confirm new password'/>
                            </td>  
                        </tr>
                        <tr>
                            <td>
                                E-mail
                            </td>
                            <td>
                                <input type='text' name='new_email' placeholder='{{loop_element:email}}'/>
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
                        <tr>
                            <td colspan='2'>
                                <input style='margin:0 auto;display:block;width:200px' type='submit' name='editButton' value='Edit'>
                            </td>  
                        </tr>
                    </table>		   
    		      </form>
            {endforeach}
        </div>
    <div class='fill'>
    </div>
</div>