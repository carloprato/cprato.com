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
<?php /* Replacing Wordpress dynamic request to static HTML
            <h2>Latest Blog Posts</h2>
            <?php $posts=get_posts( 'posts_per_page=3&order=DESC&orderby=post_date'); foreach ($posts as $post) : setup_postdata( $post ); ?>
            <?php the_date(); echo "<br />"; ?>
            <h3><?php the_title(); ?></h3>
            <?php the_excerpt(); ?>
            <?php endforeach; ?>
        */
        ?>
 				<h2>Latest Blog Posts</h2>
				    4th May 2015<br />
                    <h3>Carlo Prato &#8211; A Little Thought</h3>
                                                       
                    20th March 2015<br />
                    <h3>My i3 Budget Build</h3>
                  
        </div>
    </div>
    <div class='fill'>
    </div>
</div>