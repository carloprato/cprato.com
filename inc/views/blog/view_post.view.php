 <div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			<h2>{{post_title}} ({{post_date}})</h2>
            
            {{post_content}}
            
            <p style='margin-top:20px'>
                <h3>Comments</h3>
                {foreach:comments}
                    {{loop_element:content}}
                {endforeach}
            </p>
        </div>
    </div>
    <div class='fill'>
    </div>
</div>