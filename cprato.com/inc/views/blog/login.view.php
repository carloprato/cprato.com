  <div class='content_container'>
    <div class="row content">
        <div class='col_12 content_paragraph'>
			
			{{login_form}}
		<form name="loginform" id="loginform" action="{{SITE_ROOT}}/{{lang}}/blog/login" method="post">
			
			<p class="login-username">
				<label for="user_login">Username</label>
				<input type="text" name="log" id="user_login" class="input" value="" size="20" />
			</p>
			<p class="login-password">
				<label for="user_pass">Password</label>
				<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" />
			</p>
			
			<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> Remember Me</label></p>
			<p class="login-submit">
				<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Log In" />
				<input type="hidden" name="redirect_to" value="/en/blog/login/success" />
			</p>
			
		</form>

        </div>
    </div>
    <div class='fill'>
    </div>
</div>



