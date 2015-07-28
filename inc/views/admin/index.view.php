<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'> 
            <h2>Admin</h2>
            <div class='admin'>
                {auth:user}
                    <span class='admin_menu current' style='float:left;        text-align:center; '>
                        <img src='/res/images/icons/home.png' class='icon'/><br/>Home          
                    </span>
                {endauth}
                {auth:translator}
                    <span class='admin_menu' style='float:left;        text-align:center; text-decoration:line-through'>
                        <img src='/res/images/icons/globe.png' class='icon'/><br/>Translate          
                    </span>
                {endauth}
                {auth:editor}
                <span class='admin_menu' style='float:left;text-align:center; text-decoration:line-through'>
                    <img src='/res/images/icons/mail.png' class='icon'/><br/>Newsletter<br/>           
                </span>
                {endauth}
                {auth:editor}
                <a href='/{{lang}}/blog/menu'>            
                <span class='admin_menu' style='float:left;        text-align:center;'>
                <img src='/res/images/icons/news.png' class='icon'/><br/>Blog<br/>
                </span>
                </a>
                {endauth}
                {auth:editor}
                <a href='/{{lang}}/editor'>
                <span class='admin_menu' style='float:left;text-align:center;'>
                <img src='/res/images/icons/pencil.png' class='icon'/><br/> Edit Pages<br/>        
                </span>
                {endauth}
                {auth:moderator}
                <a href='/{{lang}}/user/list_all'>
                <span class='admin_menu' style='float:left;text-align:center;'>
                <img src='/res/images/icons/profile.png' class='icon'/><br/>Users <br/>           
                </span>
                </a>
                {endauth}
                {auth:admin}
                    <span class='admin_menu' style='float:left;text-align:center;'>
                       <img src='/res/images/icons/settings.png' class='icon'/><br/> Settings <br/>
                    </span>                     
                {endauth}
            </div>
         </div>
    </div>
    <div class='fill'>
    </div>
</div>