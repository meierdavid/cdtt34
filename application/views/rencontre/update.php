

<div class="container login-container2" align="left">
    <div class="row">
        <div class="notification is-danger">
       <?php echo validation_errors(); ?> 
        </div>
        <form method="post" accept-charset="utf-8" action="<?php base_url('rencontre/update' . $rencontre[0]->numRencontre)?>">
            <div class="form-group">
                <label class="control-label">Rencontre</label>
                <input type="text" class="form-control" name="nomRencontre" value="<?php echo $rencontre[0]->nomRencontre ?>" size="30" required /> 
            </div>

            <div class="text-center"><input class="btnSubmit" type="submit" value="modifier" /></div>

       </form>  
    </div>
</div>
