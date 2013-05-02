<h3>User login</h3>
<form action="" id="login-form">
<fieldset>
	<span class="text">
		<input type="text" value="Username" onFocus="if(this.value=='Username'){this.value=''}" onBlur="if(this.value==''){this.value='Username'}">
	</span>
	<span class="text">
		<input type="password" value="Password" onFocus="if(this.value=='Password'){this.value=''}" onBlur="if(this.value==''){this.value='Password'}">
	</span>
	<a href="#" class="login" onClick="document.getElementById('login-form').submit()"><span><span>Login</span></span></a>
	<br class="clear" />
	<span class="price"><a href="#">Forgot Password?</a>
	<br/><br/>
	<a href="#">Register</a></span>
</fieldset>
</form>
