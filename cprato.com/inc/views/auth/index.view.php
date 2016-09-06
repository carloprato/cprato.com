<div class='content'>
    <div class="row content">
        <div class='col_6 content_paragraph'>
            <h2>Login</h2>
            <div style='background:#ADF;border-top: 3px solid #06F;border-bottom: 3px solid #06F;padding:5px;'>
                <h3>Information</h3>
                You need to login to access all the website features. The forum can not be viewed by visitors.
            </div>
             <br/>
              <br/>
            <form method='post' action='{{SITE_ROOT}}/{{lang}}/auth/login'>
                <table>
                    <tr>
                        <td>
                            <input type='text'  name='user' placeholder='Username'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type='password'  name='password' placeholder='Password'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                          <input type='checkbox' name='remember_me' value='1' id='remember'> 
                          <label for='remember'>
                              Remember Me
                          </label>
                        </td>
                    </tr>   
                    <tr>
                        <td>
                            <input type='submit' name='submitButton' value='Login'>
                        </td>
                    </tr>                   
                </table>
            </form>
        </div>
    </div>
    <div class='fill'></div>
</div>