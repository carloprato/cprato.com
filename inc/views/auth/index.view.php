<div class='content'>
    <div class="row content">
        <div class='col_6 content_paragraph'>
            <form method='post' action='{{SITE_ROOT}}/{{lang}}/auth/login'>
                <table>
                    <tr>
                        <td>
                            <input type='text'  name='user'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type='text'  name='password'>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type='submit' name='submitButton' value='Login'>
                        </td>
                    </tr>                   
                </table>
            </form>
            {{user_details}}
        </div>
    </div>
    <div class='fill'></div>
</div>