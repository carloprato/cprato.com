<div class='footer_container'>
    <div class="row footer">
        <div class='col_6 footer_paragraph' >
            <h2 class='Home' style='border-bottom:1px solid #c1c1c1;'>Recent Posts</h2>
               <ul>                
                <?php /* Replacing Wordpress dynamic request to static HTML  
						$args=array( 'post_status'=> 'publish', 'numberposts' => '3'); 
						$recent_posts = wp_get_recent_posts($args);
						foreach( $recent_posts as $recent ){ 
						echo '
                <li><a style="color:#8cf" class="Home" href="' . get_permalink($recent[" ID "]) . '">' . $recent["post_title"].'</a> </li> '; } 
                */            
                ?>             

				<li><a style="color:#8cf" class="Home" href="http://www.cprato.com/blog/?p=86">Carlo Prato - A Little Thought</a> </li> <li><a style="color:#8cf" class="Home" href="http://www.cprato.com/blog/?p=78">Lily - Prerelease</a> </li> <li><a style="color:#8cf" class="Home" href="http://www.cprato.com/blog/?p=70">My i3 Budget Build</a> </li> 				</ul>
            </ul>
        </div>
        <div class='col_3 footer_paragraph'>
            <h2 class='Home' style='border-bottom:1px solid #c1c1c1;'><?php echo $language->string("Menu");?></h2>
            <a href='/<?=$_GET["lang"];?>/home' class='footer_link'>
                <?php echo $language->string("Home");?></a>
            <br/>
            <a href='/blog' class='footer_link'>
                <?php echo $language->string("Blog");?></a>
            <br/>
            <a href='/<?=$_GET["lang"];?>/about' class='footer_link'>
                <?php echo $language->string("About");?></a>
            <br/>
        </div>
        <div class='col_3 footer_paragraph'>
            <h2 class='Home' style='border-bottom:1px solid #c1c1c1;'><?php echo $language->string("Contact");?></h2>
            <span class='Home'>Carlo Prato</span>
            <br/>
            <a class='footer_link' href='mailto:carlo@cprato.com'>carlo@cprato.com</a>
            <br/>
            <span class='Home'>Mosta, Malta</span>
            <br/>
        </div>
    </div>
    <div class='row footer'>
        <div class='col_12 footer_paragraph' style='text-align:center;'>
            <a href='https://www.facebook.com/carlo.prato.14' style='color:#8cf'>Facebook</a> - <a style='color:#8cf' href='https://plus.google.com/101496594498860425286/about'>Google+</a> - <a style='color:#8cf' href='https://www.linkedin.com/in/cprato'>Linkedin</a>
        </div>
    </div>
    <div class='row footer'>
        <div class='col_12 footer_paragraph'>
            <div class='quote'>
                <blockquote>
                    I will not say do not weep, for not all tears are an evil.
                </blockquote>J. R. R. Tolkien, The Lord of the Rings
            </div>
        </div>
    </div>
    <div class='fill'></div>
</div>
</body>
</html>