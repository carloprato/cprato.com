<div class='content_container'>
    <div class="row content">
        <div class='col_8 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'>

 				<h2>Posts</h2>
                    <?php		                       			
                        $posts = Posts::all();
                        ?>
                    <?php 
                        foreach ($posts as $post) {
                            echo $post->author . "<br/>";
                        }
                        ?>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>