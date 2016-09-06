<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'>
 			<h2>Translate</h2>
                <form method='post' action='{{SITE_ROOT}}/{{lang}}/translate/update'>
                    <table style='width:800px;'>
                        {{translation_table}}                      
                            <tr>
                                <td>
                                    <input type='text' name='new_key' value=''>
                                </td>
                                <td style='width:300px'>
                                    <textarea name='new_value' style='width:300px;height:100%;'></textarea>
                                </td>
                                <td>
                                    <textarea name='new_translated' style='width:400px;height:100%;'></textarea>
                                </td>
                            <tr>
                                <td colspan='3'>
                                    <input type='submit' name='saveButton' value='Save' style='width:200px;'>
                                </td>
                            </tr>
                    </table>
                </form>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>