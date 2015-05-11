<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'>

 				<h2>Translate</h2>                        
                <form method='post' action='<?php echo SITE_ROOT . "/en/translate/update"; ?>'>
                        <?php		                       			
                            $posts = Translate::all();
                            ?>
                    <table>
                        <?php foreach ($posts as $key=>$value) : ?>
                            <?php if ($key == 'english') { continue; } ?>
                            <tr>
                                <td style='width:200px;'>
                                    <?=$key; ?>
                                </td>
                                <td>
                                    <?=htmlspecialchars($posts['english'][$key]); ?>
                                </td>
                                <td>
                                    <textarea name='<?=$key; ?>' style='width:400px;height:100%;'><?=htmlspecialchars($value); ?></textarea>
                                </td>
                            </tr>
                                                                      
                        <?php endforeach; ?>
                        <tr>
                            <td colspan='3'>
                                <input type='submit' name='saveButton' value='Save' style='width:100%'>
                            </td>
                        </tr>
                    </table>
                </form>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>