

<div class="container login-container2" align="left">
    <div class="row">
       <div class="notification is-danger">
       <?php echo validation_errors(); ?> 
        </div>
        <form method="post" accept-charset="utf-8" action="<?php base_url('club/update' . $club[0]->numClub)?>">
            <div class="form-group">
                <label class="control-label">Club</label>
                <input type="text" class="form-control" name="nomClub" value="<?php echo $club[0]->nomClub ?>" size="30" required /> 
            </div>

            <div class="text-center"><input class="btnSubmit" type="submit" value="modifier" /></div>

       </form>  
    </div>
</div>
