<div class='evidence_container'>
    <div class="row evidence">
        <div class='col_4 evidence_paragraph'>
            <h2>About Me</h2>My name is Carlo, I’m a 20 year old from Italy. I love webdesign, music, retrogaming and reading! If you want to know more about me feel free to read <a href="/<?=$_GET['lang']; ?>/about">here</a> or in <a href="/blog">my blog</a>.
        </div>
        <div class='col_4 evidence_paragraph'>
            <h2>Skills</h2>I’m proficient in PHP/MySQL programming, and website design using Adobe Photoshop for the creation of the mock-up that I convert into real websites later on. I know my way around Java and Python too.
        </div>
        <div class='col_4 evidence_paragraph'>
            <h2>Contact</h2>If you want to contact me feel free to send an e-mail to carlo@cprato.com. I’m currently looking for a part-time job as webdesigner or programmer.
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