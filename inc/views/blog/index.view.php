 <div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			<h2>Blog</h2>
                {foreach:recent_posts}
                    <h3>
    					<a href="{{SITE_ROOT}}/{{lang}}/blog/view_post/{{loop_element:short_title}}">
    						{{loop_element:title}}
    					</a>
    				</h3>  				
    				<p>
                        {{loop_element:short_content}}...<b><a href="{{SITE_ROOT}}/{{lang}}/blog/view_post/{{loop_element:short_title}}">Continue reading</a>
    				</b></p>
    				<br/>
                {endforeach}
        </div>
    </div>
    <div class='fill'>
    </div>
</div>


