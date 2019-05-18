

<div class="container login-container2" align="left">
    <div style=" margin-top: 15%">
    <div class="row ml-auto">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div>
        <?php echo form_open('departement/update/' . $departement[0]->numDepartement,'class="m-auto"'); ?>
        <h2>Modification d'un département</h2>
        <div class="form-group">
            <label for="update_nom_departement" class="control-label">Nom du département</label>
            <input id="update_nom_departement" type="text" class="form-control" name="nomDepartement" value="<?php echo $departement[0]->nomDepartement ?>" size="30" required /> 
            <label for="update_num_departement" class="control-label">Numéro du département</label>
            <input id="update_num_departement" type="text" class="form-control" name="numeroDepartement" value="<?php echo $departement[0]->numeroDepartement ?>" size="30" required /> 
        </div>
        <div class="text-center"><input class="btn btn-primary " type="submit" value="Valider" /></div>

        </form>  
    </div>
    </div>
</div>
