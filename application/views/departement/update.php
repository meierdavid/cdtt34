

<div class="container login-container2" align="left">
    <div class="row">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div>
        <?php echo form_open('departement/update/' . $departement[0]->numDepartement); ?>
        <div class="form-group">
            <label for="update_nom_departement" class="control-label">Departement</label>
            <input id="update_nom_departement" type="text" class="form-control" name="nomDepartement" value="<?php echo $departement[0]->nomDepartement ?>" size="30" required /> 
            <label for="update_num_departement" class="control-label">Departement</label>
            <input id="update_num_departement" type="text" class="form-control" name="numeroDepartement" value="<?php echo $departement[0]->numeroDepartement ?>" size="30" required /> 
        </div>
        <div class="text-center"><input class="btnSubmit" type="submit" value="modifier" /></div>

        </form>  
    </div>
</div>
