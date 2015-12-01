<script>
function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}
</script>
<div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			{foreach:post_content}

                <h2>{{loop_element:post_title}} ({{loop_element:post_date}}) <span style='font-size:16px;'>by {{loop_element:user}}         <a  style='background-image:url("/res/images/fb_logo.png");background-repeat:no-repeat;background-color:#3B5998;border-radius:8px;padding:3px 8px;padding-left:30px;color:white;border:1px solid #0B3958;text-decoration:none;cursor:pointer;'
            onclick="PopupCenter('https://www.facebook.com/dialog/share?app_id=1612484382341510&display=popup&href=http://bipolarmalta.org{{SITE_ROOT}}/{{lang}}/blog/view_post/{{loop_element:post_id}}&redirect_uri=http://bipolarmalta.org/close_window.html', 'xtg', '555', '327')">Share on Facebook</a>
</span></h2>
                    {{loop_element:post_content}}
                {endforeach}
          
            <p style='margin-top:20px'>
                    <h3>Insert comment</h3>
            {if:user}
                {foreach:post_content}
                <form method='post' action='{{SITE_ROOT}}/{{lang}}/blog/add_comment/{{loop_element:post_id}}'>
                    <textarea class='rich_editor' name='comment_content'></textarea><br/>
                    <input type='submit' style='width:200px;margin:0 auto;display:block;margin-bottom:50px;' name='submitComment' value='Submit Comment'>            
                </form>
                {endforeach}
            {elseif}
                You need to <a href='/{{lang}}/auth'>login</a> to comment on this post. <br/><br/>
            {endif}   
                <h3>Comments</h3>
                {foreach:comments}
                    <p>
                        <strong>
                            {{loop_element:user}}
                        </strong>
                        ({{loop_element:date_created}}): 
                        {{loop_element:content}}
                    </p>
                {endforeach}
            </p>
         
        </div>
    </div>
    <div class='fill'>
    </div>
</div>