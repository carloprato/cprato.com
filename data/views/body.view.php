<body>      
    <div class='header_container'>
        <div class="row">
            <div class='col_4' style='margin:0 auto;'>
                    <a href='/{{lang}}/home'>
                    <div class='logo' style='display: table-cell; vertical-align: middle;'>
                        <div class='title'>
                            Carlo's Midis
                        </div>
                        </div>
                    </a>
                    </div>
                <div class='col_6' style='display: table-cell; vertical-align: middle;'>
                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/midi'>
                        Home</a>

                    <a class='menu_item' href='{{SITE_ROOT}}/{{lang}}/midi/all'>
                        Midi List</a>                    
                </div>

                <div class='col_4' style='display: table-cell; vertical-align: middle;'>
                    <form method='post' action='/en/midi/search'>
                        <input placeholder='Search for a MIDI file...' style='padding:2px;background:#171717;border:2px solid #c0c0c0;color:#c0c0c0;' type='text' name='search_string'>
                        <input type='submit' style='padding:2px;' value='Search'>
                    </form>
                <!--
                {if:user}
                    Hello, <a style='color:#8cf;' href='{{SITE_ROOT}}/{{lang}}/user/profile/'>{{name}}</a>! <a style='color:#8cf;' href='{{SITE_ROOT}}/{{lang}}/auth/logout'>Logout</a>
                {elseif}
                    <a style='color:#8cf;' href="#" onClick="logInWithFacebook()"><img style='height:32px;width:32px' src='/data/res/images/fblogo.png'></a> - <a style='color:#8cf;' href='{{SITE_ROOT}}/{{lang}}/auth'>Login</a> - <a style='color:#8cf;' href='{{SITE_ROOT}}/{{lang}}/auth/register'>Register</a>
                {endif}
             </div> -->
        </div>

            <div class='fill'></div>
        </div>
    </div>