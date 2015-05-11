<div class='content_container'>
    <div class="row content">
        <div class='col_8 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'>

 				<h2>Settings</h2>
                    <?php		                       			
            			$test = ucwords($_GET['p']);
                        $class = new $test;
                        echo $class->{$_GET['action']}();
                        ?>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>