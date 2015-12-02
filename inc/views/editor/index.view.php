<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'>

 			<h2>Page Editor</h2>                     
            {auth:editor}


            <div style='float:left;text-align:center;clear:both;' class='admin'>      
                <a href='/{{lang}}/admin'>
                    <span class='admin_menu' style='float:left;        text-align:center; '>
                        <img src='/res/images/icons/home.png' class='icon'/><br/>Home          
                    </span>
             </a>
             <a href='/{{lang}}/editor/add'>
                <span class='admin_menu' style='float:left; text-align:center; '>
                    <img src='/res/images/icons/page_add.png' class='icon'/><br/>Add new page          
                </span>
            </a>
            </div>
            
            <p style='clear:both'>
            <table>
                <tr>
                    <th>
                        Title
                    </th>
                    <th>
                        Edit
                    </th>
                    <th>
                        Delete
                    </th>
                </tr>    
            {foreach:page_editor}
                <tr>
                    <td>
                        {{loop_element:name}}
                    </td>
                    <td>
                        <a href='/en/editor/edit/{{loop_element:name}}'>
                            Edit
                        </a>
                     </td>
                     <td>
                         <a href='/en/editor/delete/{{loop_element:name}}'>
                           <b>
                        <span style='color:red;'>
                            Delete [use with care]
                            
                        </span>
                        </b>
                        </a>
                     </td>                     
                 </tr>
            {endforeach}
            </table>
            {endauth}

        </div>
    </div>
    <div class='fill'>
    </div>
</div>

