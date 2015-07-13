
<style>
    .icon {
        width:64px;
        height:64px;
        margin-top:10px;
        margin-bottom:10px;
        margin-left:10px;
        margin-right:10px;
        text-align:center;

    }
    span {
               text-align:center;
    }
</style>
<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph' style='text-align:justify;padding-left:10px;float:left;'> 
            <h2>Admin</h2>
            {if:privileges > 60}
                <span style='float:left;        text-align:center;'>
                    <img src='/res/images/icons/globe.png' class='icon'/> <br/>Translate          
                </span>
            {elseif}
            {endif}
            {if:privileges > 80}
            <span style='float:left;'>
                <img src='/res/images/icons/mail.png' class='icon'/> <br/>Newsletter <br/>           
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
            <span style='float:left;'>
            <img src='/res/images/icons/pencil.png' class='icon'/> <br/> Edit Pages<br/>        
            </span>
            {elseif}
            {endif}
            {if:privileges > 80}
            <span style='float:left;'>
            <img src='/res/images/icons/profile.png' class='icon'/>  <br/>Users <br/>           
            </span>
            {elseif}
            {endif}
            {if:privileges > 80}
            <span style='float:left;'>
            <img src='/res/images/icons/settings.png' class='icon'/> <br/> Settings <br/>
            </span>                     
            {elseif}
            {endif}

         </div>
    </div>
    <div class='fill'>
    </div>
</div>