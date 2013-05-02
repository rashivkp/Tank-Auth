<form class="form-horizontal" method="post">
    <fieldset>
        <div id="legend" class="">
            <legend class="">Reset Password</legend>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">Username</label>
            <div class="controls">
                <input name="username" placeholder="Username" class="input-xlarge" value="<?=(isset($reset_username))? $reset_username : ''?>" type="text">
                <p class="help-block"></p>
            </div>
        </div>
        <div class="control-group">

            <!-- Text input-->
            <label class="control-label" for="input01">Password</label>
            <div class="controls">
                <input name="password" placeholder="" class="input-xlarge" type="text">
                <p class="help-block">Leave blank to auto generate username as password</p>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label"></label>

            <!-- Button -->
            <div class="controls">
                <button class="btn btn-primary">Reset Password</button>
            </div>
        </div>

    </fieldset>
</form>