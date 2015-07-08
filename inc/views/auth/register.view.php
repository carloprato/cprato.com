<style>
    table, td {
        border: 0;
        background-color:#DEE;

    }
    th {
        background-color:#BCC;
    }
    table {
        width:100%;
        border-collapse: collapse;
         border-radius:8px;
    }
    td, th {
    padding:10px;
    vertical-align: center;
         border-radius:8px 8px 0px 0px;
         border-bottom:1px solid #AAA;
    }
</style>

<div class='content'>
    <div class="row content">
        <div class='col_8 content_paragraph'>
            <h2>Register</h2>
                {if:registration_errors}
                <div style='background:#FCC;border-top: 3px solid #F66;border-bottom: 3px solid #F66;padding:5px;'>
                    <h3>Error</h3>
                    Some fields were not filled in correctly. Please correct the data you inserted. <br/>
                    {foreach:registration_errors}
                        <li> {{loop_element:error}} <br/>  
                    {endforeach}
                </div>
                {elseif}
                {endif}
 
                {if:success}                    
                <div style='background:#CFC;border-top: 3px solid #6F6;border-bottom: 3px solid #6F6;padding:5px;'>                    
                    <h3>Success!</h3>
                        {{success}}
                </div>   
                {elseif}                 
                {endif}
                
            <form method='post' action='{{SITE_ROOT}}/{{lang}}/auth/register'>
                <table>
                    <tr>
                        <td>
                            Username
                        </td>
                        <td>
                            <input type='text'  name='user'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Password
                        </td>
                        <td>
                            <input type='password'  name='password'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Confirm password
                        </td>
                        <td>
                            <input type='password'  name='confirm_password'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Name and surname
                        </td>
                        <td>
                            <input type='text'  name='name'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            E-Mail
                        </td>
                        <td>
                            <input type='text'  name='email'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Invitation code
                        </td>
                        <td>
                            <input type='text'  name='invitation_code'>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <input type='submit' style='width:80px;margin:0 auto;display:block;' name='submitButton' value='Register'>
                        </td>
                    </tr>                   
                </table>
            </form>
            </div>
        </div>
    </div>
    <div class='fill'></div>
</div>