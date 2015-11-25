<body>
    <div class='header_container'>
        <div class="row " >
            <div class='col_8'>
            </div>
            <div class='col_4' >
                {if:user}
                    Hello, <a href='{{SITE_ROOT}}/{{lang}}/user/profile/'>{{name}}</a>! <a href='{{SITE_ROOT}}/{{lang}}/auth/logout'>Logout</a>
                {elseif}
                    <a href="#" onClick="logInWithFacebook()"><img src='/res/images/fb_logo.png' style='width:32px;
                        -webkit-filter: drop-shadow(2px 2px 2px #222);
                        filter:drop-shadow(2px 2px 2px #222); '></a> - <a href='{{SITE_ROOT}}/{{lang}}/auth'>Login</a> - <a href='{{SITE_ROOT}}/{{lang}}/auth/register'>Register</a>
                {endif}
                
                <!-- 
                    <a href='/en/{{p}}'><img alt='English version of the website' width='48' height='48' style='width:48px;height:48px;' src='{{SITE_ROOT}}/data/res/flags/en.png' /></a>
                    <a href='/mt/{{p}}'><img alt='Verzjoni tal-website bil-Malti' width='48' height='48' style='width:48px;height:48px;' src='{{SITE_ROOT}}/data/res/flags/mt.png' /></a>
                -->
            </div>
        </div>
        <div class="row ">
            <div class='logo'>
                <a href='/{{lang}}/home'>
                    <div class='title'>
                    </div>
                </a>
            </div>
            <div class='nav'>
                <div class='col_3'>
                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/home'>
                        {{translate:Home}}
                    </a>
                </div>
                <div class='col_3' style='padding-left:5px;' >
                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/blog'>
                        Blog
                    </a>
                </div>
                <div class='col_3' style='padding-left:5px;' >
                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/forum'>
                        Forum
                    </a>
                </div>
                {foreach:menu_items}
                <div class='col_3' style='padding-left:5px;' >
                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/{{loop_element:file}}'>
                        {{loop_element:name}}
                    </a>
                </div>
                {endforeach}             
            </div>
            <div class='fill'></div>
        </div>
    </div>