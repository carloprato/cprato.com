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
            <nav>
                <ul >
                    <li >
                        <a class='mobile_menu'>Menu
                            </a>
                    

                <ul class='dropdown'>
                    <li>
                        <a href='{{SITE_ROOT}}/{{lang}}/home'>
                            {{translate:Home}}
                        </a>
                    </li>
                    <li>
                        <a href='{{SITE_ROOT}}/{{lang}}/blog'>
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href='{{SITE_ROOT}}/{{lang}}/forum'>
                            Forum
                        </a>
                    </li>
                    {foreach:menu_items}
                    <li>
                        <a href='{{SITE_ROOT}}/{{lang}}/{{loop_element:file}}'>
                            {{loop_element:name}}
                        </a>
                    </li>
                    {endforeach}
                </li>    
                </ul>            
                </ul>
            </nav>
            <div class='fill'></div>
        </div>
    </div>