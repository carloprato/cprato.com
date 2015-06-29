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

            {foreach:recent_posts}        
                <h3>
					<a href="{{SITE_ROOT}}/{{lang}}/blog/view_post/{{loop_element:ID}}">
						{{loop_element:post_title}}
					</a>
				</h3>
				
				<p>{{loop_element:post_content_short}}
				</p>
				<br/>
             {endforeach}     
        </div>
    </div>
    <div class='fill'>
    </div>
</div>