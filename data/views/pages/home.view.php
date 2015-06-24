<div class='evidence_container'>
    <div class="row evidence">
        <div class='col_4 evidence_paragraph'>
            {{translate:about_me_home}}
        </div>
        <div class='col_4 evidence_paragraph'>
            {{translate:skills_home}}
        </div>
        <div class='col_4 evidence_paragraph'>
            {{translate:contact_me_home}}
        </div>
    </div>
    <div class='fill'></div>
</div>
<div class='content_container'>
    <div class="row content">
        <div class='col_8 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'>

            <h2>Latest Blog Posts</h2>
                <?php 
						$args=array( 'post_status'=> 'publish', 'numberposts' => '3'); 
						$recent_posts = wp_get_recent_posts($args);
						foreach( $recent_posts as $recent ){ 
						if (strlen($recent["post_content"]) > 300)	
							$recent["post_content"] = substr($recent["post_content"], 0, 300) . '...<a href="/blog/?p='. $recent["ID"] . '"> Continue Reading</a>';
				echo '
                <h3>
					<a href="/blog/?p='. $recent["ID"] . '">
						'. $recent["post_title"].'
					</a>
				</h3>
				
				'. $recent["post_content"] . '
				<br/>'; } 
           
                ?> 

 				
                  
        </div>
    </div>
    <div class='fill'>
    </div>
</div>