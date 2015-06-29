 <div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			<h2>Blog</h2>
                {foreach:recent_posts}
                    <h3>
    					<a href="{{SITE_ROOT}}/{{lang}}/blog/view_post/{{loop_element:ID}}">
    						{{loop_element:post_title}}
    					</a>
    				</h3>  				
    				<p>
                        {{loop_element:post_content_short}}
    				</p>
    				<br/>
                {endforeach}
        </div>
    </div>
    <div class='fill'>
    </div>
</div>


