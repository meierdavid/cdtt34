

<div class="container" >
    <div style=" margin-top: 15%">
    <div class="row ml-auto">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div> 
        <?php echo form_open("departement/create",'class="m-auto"'); ?>
        <h2>Ajout un département</h2>
        <div class="form-group">
            <label for="create_nom_departement" class="control-label">Nom du departement</label>
            <input id="create_nom_departement" type="text" class="form-control" name="nomDepartement"  value="<?php echo set_value('nomDepartement'); ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_num_departement" class="control-label">Numéro du Departement</label>
            <input id="create_num_departement" type="number" class="form-control" name="numeroDepartement" value="<?php echo set_value('numeroDepartement'); ?>" size="30" required />          
        </div>
        <div class="mt-2"><input class=" btn btn-primary" type="submit" value="Enregistrer" /></div>

        </form>  
    </div>
    </div>
</div>
