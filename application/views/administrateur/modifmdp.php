

<div class="container">
    <div class="row">
        <?php echo form_open("welcome/connexion", 'class="offset-4 mt-5 text-center"'); ?>
        <div class="form-group"> 
            <label for="update-old-password" class=" control-label">Old Password</label> 
            <div class="col-sm-10"> 
                <input  id="update-old-password" type="password" class="input-group" name="oldPassword" value=""/>
                <div  class="error notification text-danger is-danger"><?php echo form_error('oldPassword'); ?> </div>
            </div> 
        </div> 
        <div class="form-group"> 
            <label for="update-new-password" class="control-label">New Password</label> 
            <div class="col-sm-10"> 
                <input id="update-new-password" type="password" class="input-group" name="newPassword" value=""/>
                <div class="error notification text-danger is-danger"><?php echo form_error('newPassword'); ?> </div>
            </div> 
        </div> 
        <div class="form-group"> 
            <label for="confirm-new-password" class=" control-label">Confirm Password</label> 
            <div class="col-sm-10"> 
                <input  id="confirm-new-password"" type="password" class="input-group" name="newPasswordConfirm" value=""/>
                <div class="error notification text-danger is-danger"><?php echo form_error('newPasswordConfirm'); ?> </div>
            </div> 
        </div> 
        <div class="form-group"> 
            <div class="col-sm-10"> 
                <button class="btn btn-danger" type="submit">Save</button> 
            </div> 
        </div> 
        <div class="form-group"> 
            <div class="col-sm-10"> 
                <?php echo validation_errors('<p class="alert alert-block alert-danger fade in">'); ?> 
            </div> 
        </div> 
        </form> 
    </div>
</div>