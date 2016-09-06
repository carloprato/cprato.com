<div class='content_container'>
    <div class="row content">
        <div class='col_10 content_paragraph'>

				<h2>Edit Profile</h2>
            {foreach:edit_profile_errors}
                {{loop_element:error}}
            {endforeach}
            {foreach:user_details}    
                <form method='post' action='' enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>
                                Username
                            </td>
                            <td>
                                {{loop_element:user}}
                            </td>  
                            <td>
                            </td>   
                        </tr>
                        <tr>
                            <td>
                                Name
                            </td>
                            <td>
                                <input type='text' name='new_name' placeholder='{{loop_element:name}}'  {{input_disabled}}/>
                            </td>  
                            <td>
                                Hidden <input type='checkbox' name='profile_visibility[]' value='1' {{loop_element:name_visibility}}/>
                            </td>  
                        </tr>
                        <tr>
                            <td>
                                Password
                            </td>
                            <td style='align:right'>
                                {if:fb_user}
                                    Authentication via Facebook
                                {elseif}                                                          
                                <input type='password' name='old_password' placeholder='Old password' /><br/>
                                <input type='password' name='new_password' placeholder='New password' /><br/>
                                <input type='password' name='confirm_password' placeholder='Confirm new password' />
                                {endif}
                            </td>  
                            <td>
                            </td>                            
                        </tr>
                        <tr>
                            <td>
                                E-mail
                            </td>
                            <td>
                                <input type='text' name='new_email' placeholder='{{loop_element:email}}' {{input_disabled}} />
                            </td>
                            <td>
                                Hidden <input type='checkbox' name='profile_visibility[]' value='2' {{loop_element:email_visibility}}/>
                            </td>    
                        </tr>
                        <tr>
                            <td>
                                Facebook ID
                            </td>
                            <td>
                                {if:fb_user}
                                    {{loop_element:fb_user}}
                                {elseif}
                                Not linked
                                {endif}
                            </td>  
                            <td>
                            </td>    
                        </tr>
                        <tr>
                            <td>
                                Permissions
                            </td>
                            <td>
                                {{loop_element:role}}
                            </td>
                            <td>
                            </td>                               
                        </tr>

                        <tr>
                            <td>
                                Profile Image
                            </td>
                            <td>
                                <img src='/data/res/images/users/{{loop_element:id}}.jpg' style='width:100px;'/><br/>
                                <input type='file' name='profile_image' id='profile_image'>
                            </td>  
                            <td>
                            </td>   
                        </tr>
                        <tr>
                            <td colspan='3'>
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