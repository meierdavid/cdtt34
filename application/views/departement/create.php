

<div class="container login-container2" align="left">
    <div class="row">
       <div class="notification is-danger">
       <?php echo validation_errors(); ?> 
        </div> 
        <?php echo form_open("departement/create");?>
            <div class="form-group">
                <label for="create_nom_departement" class="control-label">Nom du departement</label>
                <input id="create_nom_departement" type="text" class="form-control" name="nomDepartement"  value="" size="30" required /> 
                <label for="create_num_departement" class="control-label">Numéro du Departement</label>
                <input id="create_num_departement" type="text" class="form-control" name="numeroDepartement" value="<?php echo $departement[0]->numeroDepartement ?>" size="30" required />          
            </div>
            <div class="text-center"><input class="btn-primary" type="submit" value="créer" /></div>

       </form>  
    </div>
</div>
