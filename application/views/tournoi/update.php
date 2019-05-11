

<div class="container login-container2" align="left">
    <div class="row">
        <div class="notification is-danger">
       <?php echo validation_errors(); ?> 
        </div>
        <form method="post" accept-charset="utf-8" action="<?php base_url('tournoi/update' . $tournoi[0]->numTournoi)?>">
            <div class="form-group">
                <label class="control-label">Tournoi</label>
                <input type="text" class="form-control" name="nomTournoi" value="<?php echo $tournoi[0]->nomTournoi ?>" size="30" required /> 
            </div>

            <div class="text-center"><input class="btnSubmit" type="submit" value="modifier" /></div>

       </form>  
    </div>
</div>
