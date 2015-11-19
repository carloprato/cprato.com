<div class='footer_container'>
    <div class="row footer">
        <div class='col_6 footer_paragraph' >
            <h2 class='Home' style='border-bottom:1px solid #22620e;'>Recent Discussions</h2>
               <ul>                        
				{foreach:list_topics}
                <li><a  class="footer_link" href="/{{lang}}/forum/view_topic/{{loop_element:id}}">{{loop_element:title}}</a> </li> 
                {endforeach}
           </ul>
        </div>
        <div class='col_3 footer_paragraph'>
            <h2 class='Home' style='border-bottom:1px solid #22620e'>Menu</h2>
            <a href='/{{lang}}/home' class='footer_link'>
                Home</a>
            <br/>
            <a href='/forum' class='footer_link'>
                Forum
            <br/>
            <a href='/{{lang}}/about' class='footer_link'>
                Contact</a>
            <br/>
            <a href='/{{lang}}/admin' class='footer_link'>
                Admin Menu
                </a>
            <br/>
        </div>
        <div class='col_3 footer_paragraph'>
            <h2 class='Home' style='border-bottom:1px solid #22620e;'>Contact</h2>
            <span class='Home'>Be Positive Self Help, Malta</span>
            <br/>
            <a class='footer_link' href='mailto:selfhelp@bipolarmalta.org'>selfhelp@bipolarmalta.org</a>
            <br/>
				<span class='Home'> Be Positive - Bipolar Self Help, Mosta MST4810, Malta</span>
            <br/>
        </div>
    </div>
    <div class='row footer'>
        <div class='col_12 footer_paragraph' style='text-align:center;'>
            <a href='https://www.facebook.com/bepositivemalta'>Facebook</a> - <a  href='https://twitter.com/BipolarMalta'>Twitter</a> - <a  href='https://mt.linkedin.com/in/bipolarmalta'>Linkedin</a>
        </div>
    
    </div>
    <div class='fill' style='height:30px;'></div>
</div>
</body>
</html>