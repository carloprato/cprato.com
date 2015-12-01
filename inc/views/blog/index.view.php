 <div class='content_container'>

     <div class='row ' style='padding-top:10px;'>
        <div class='evidence_paragraph'>
        <div class='col_9'>
                            <h2>Blog</h2> 
        </div>
        <div class='col_4' style='text-align:right'>
            <form method='post' action='/{{lang}}/search/results/blog'>
                <input type='text' name='search_string' placeholder='Search blog posts...' style='width:200px'/>
                <input type='submit' value='Search'/>    
            </form> 
         </div>
     </div>
     <div class="row content">

        <div class='col_12 content_paragraph'>


                {foreach:recent_posts}
                    <h3>
    					<a href="{{SITE_ROOT}}/{{lang}}/blog/view_post/{{loop_element:id}}">
    						{{loop_element:title}}
    					</a>
    				</h3>  				
    				<p>
                        {{loop_element:short_content}}...<b><a href="{{SITE_ROOT}}/{{lang}}/blog/view_post/{{loop_element:id}}">Continue reading</a>
    				</b></p>
    				<br/>
                        <hr/>
                {endforeach}
        </div>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>


