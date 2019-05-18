

<div class="container login-container2" align="left">
    <div style=" margin-top: 20%">
    <div class="row">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div>
        <?php echo form_open('tournoi/update/' . $tournoi[0]->numTournoi,'class="m-auto"'); ?>
        <h2>Modification d'un tournoi</h2>
        <div class="form-group">
            <label for="update_nom_tournoi" class="control-label">Tournoi</label>
            <input id="update_nom_tournoi" type="text" class="form-control" name="nomTournoi" value="<?php echo $tournoi[0]->nomTournoi ?>" size="30" required /> 
        </div>

        <div class="text-center"><input class="btnSubmit btn-primary" type="submit" value="Valider" /></div>

        </form>  
    </div>
    </div>
</div>
