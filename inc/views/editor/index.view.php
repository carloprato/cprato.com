<div class='content_container'>
    <div class="row content">
        <div class='col_8 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'>

 			<h2>Page Editor</h2>
                             <a href='/en/editor/add'>
            <span style='float:left;text-align:center;clear:both;'>

                <img src='/res/images/icons/add.png' class='icon'/>	<br/>		
                Add new page<br/>          
            </span>
</a>
<br/><br/><br/><br/><br/><br/>
			Modify Page<br/>
            {foreach:page_editor}
            <li><a href='/en/editor/edit/{{loop_element:page_id}}'>
                {{loop_element:page_id}}
            </a> 

            {endforeach}

        </div>
    </div>
    <div class='fill'>
    </div>
</div>

