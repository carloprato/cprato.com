<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'> 
            <h2>Admin</h2>
            {if:privileges > 60}
                <span style='float:left;        text-align:center; text-decoration:line-through'>
                    <img src='/res/images/icons/globe.png' class='icon'/> <br/>Translate          
                </span>
            {elseif}
            {endif}
            {if:privileges > 80}
            <span style='float:left;text-align:center; text-decoration:line-through'>
                <img src='/res/images/icons/mail.png' class='icon'/> <br/>Newsletter<br/>           
            </span>
            {elseif}
            {endif}
            {if:privileges > 70}
            <span style='float:left;        text-align:center;'>
            <img src='/res/images/icons/news.png' class='icon'/> <br/> Blog <br/>
            </span>
            {elseif}
            {endif}
            {if:privileges > 70}
            <a href='/{{lang}}/editor'>
            <span style='float:left;text-align:center;'>
            <img src='/res/images/icons/pencil.png' class='icon'/> <br/> Edit Pages<br/>        
            </span>
            {elseif}
            {endif}
            {if:privileges > 80}
            <a href='/{{lang}}/user/list_all'>
            <span style='float:left;text-align:center;'>
            <img src='/res/images/icons/profile.png' class='icon'/>  <br/>Users <br/>           
            </span>
            </a>
            {elseif}
            {endif}
            {if:privileges > 80}
            <span style='float:left;text-align:center;'>
            <img src='/res/images/icons/settings.png' class='icon'/> <br/> Settings <br/>
            </span>                     
            {elseif}
            {endif}

         </div>
    </div>
    <div class='fill'>
    </div>
</div>