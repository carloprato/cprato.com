<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'> 
            <h2>Blog Admin</h2>

            {auth:editor}

            <div style='float:left;text-align:center;clear:both;' class='admin'>      
                <a href='/{{lang}}/admin'>
                    <span class='admin_menu' style='float:left;        text-align:center; '>
                        <img src='/res/images/icons/home.png' class='icon'/><br/>Home          
                    </span>
             </a>
             <a href='/{{lang}}/blog/add'>
                <span class='admin_menu' style='float:left; text-align:center; '>
                    <img src='/res/images/icons/news.png' class='icon'/><br/>Add new post          
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
            {foreach:blog_editor}
                <tr>
                    <td>
                        {{loop_element:title}}
                    </td>
                    <td>
                        <a href='/en/blog/edit/{{loop_element:id}}'>
                            Edit
                        </a>
                     </td>
                     <td>
                         <a href='/en/blog/delete/{{loop_element:id}}'>
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
            </p>
         </table>
         </div>
    </div>
    <div class='fill'>
    </div>
</div>