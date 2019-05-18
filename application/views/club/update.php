

<div class="container" align="left">
    <div style=" margin-top: 20%">
    <div class="row ml-auto">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div>
        <?php echo form_open('club/update/' . $club[0]->numClub); ?>
        <h2>Modification d'un club</h2>
        <div class="form-group">
            <label for="update_nom_club" class="control-label">Club</label>
            <input id="update_nom_club" type="text" class="form-control" name="nomClub" value="<?php echo $club[0]->nomClub ?>" size="30" required /> 
        </div>

        <div class="text-center"><input class="btn btn-primary" type="submit" value="modifier" /></div>

        </form>  
    </div>
    </div>
</div>
