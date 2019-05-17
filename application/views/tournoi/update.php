

<div class="container login-container2" align="left">
    <div class="row">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div>
        <?php echo form_open('tournoi/update/' . $tournoi[0]->numTournoi); ?>
        <div class="form-group">
            <label for="update_nom_tournoi" class="control-label">Tournoi</label>
            <input id="update_nom_tournoi" type="text" class="form-control" name="nomTournoi" value="<?php echo $tournoi[0]->nomTournoi ?>" size="30" required /> 
        </div>

        <div class="text-center"><input class="btnSubmit" type="submit" value="modifier" /></div>

        </form>  
    </div>
</div>
