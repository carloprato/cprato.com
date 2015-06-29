<style>
    table {

    }
    input[type=text] {
        width:100%;
    }
    input[type=password] {
        width:100%;
    }
    td {
        width:5%;
    }
    tr {
        line-height:40px;
    }
</style>
<div class='content'>
    <div class="row content">
        <div class='col_6 content_paragraph'>
            <h2>Register</h2>
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
            {{error}}{{success}}
        </div>
    </div>
    <div class='fill'></div>
</div>