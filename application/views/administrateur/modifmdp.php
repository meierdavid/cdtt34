

    <div class="container">
        <div class="row">
<form class ="offset-4 mt-5 text-center" action="<?=site_url("administrateur/modifMdp")?>" method="post" >    
    <div class="form-group"> 
        <label class=" control-label">Old Password</label> 
        <div class="col-sm-10"> 
            <input type="password" class="input-group" name="oldPassword" value=""/>
            <div class="error notification text-danger is-danger"><?php echo form_error('oldPassword'); ?> </div>
        </div> 
    </div> 
    <div class="form-group"> 
        <label class="control-label">New Password</label> 
        <div class="col-sm-10"> 
            <input type="password" class="input-group" name="newPassword" value=""/>
            <div class="error notification text-danger is-danger"><?php echo form_error('newPassword'); ?> </div>
        </div> 
    </div> 
    <div class="form-group"> 
        <label class=" control-label">Confirm Password</label> 
        <div class="col-sm-10"> 
            <input  type="password" class="input-group" name="newPasswordConfirm" value=""/>
            <div class="error notification text-danger is-danger"><?php echo form_error('newPasswordConfirm'); ?> </div>
        </div> 
    </div> 
    <div class="form-group"> 
        <label class="col-sm-2 control-label">&nbsp;</label> 
        <div class="col-sm-10"> 
            <button class="btn btn-danger" type="submit">Save</button> 
        </div> 
    </div> 
    <div class="form-group"> 
        <label class="col-sm-2 control-label">&nbsp;</label> 
        <div class="col-sm-10"> 
            <?php echo validation_errors('<p class="alert alert-block alert-danger fade in">'); ?> 
        </div> 
    </div> 
</form> 
        </div>
    </div>