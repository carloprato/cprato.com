<div class='content_container'>
    <div class="row content">
        <div class='col_8 content_paragraph' style='padding-left:10px;float:left;'>
 			<h2>Messages received</h2>
			{foreach:emails}                    
                E-mail: <b>{{loop_element:email}}</b> <br/>
				Name: <b>{{loop_element:name}}</b><br/>
				Date: <b>{{loop_element:date}}</b><br/>
				{{loop_element:content}}
                <hr/>
            {endforeach}
        </div>
    </div>
    <div class='fill'>
    </div>
</div>