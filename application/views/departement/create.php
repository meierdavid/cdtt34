

<div class="container" align="left">
    <div style=" margin-top: 20%">
    <div class="row">
        <div class="notification is-danger m-auto">
            <?php echo validation_errors(); ?> 
        </div> 
        <?php echo form_open("departement/create"); ?>
        <div class="form-group m-auto">
            <label for="create_nom_departement" class="control-label">Nom du departement</label>
            <input id="create_nom_departement" type="text" class="form-control" name="nomDepartement"  value="" size="30" required /> 
            <label for="create_num_departement" class="control-label">Numéro du Departement</label>
            <input id="create_num_departement" type="number" class="form-control" name="numeroDepartement" value="" size="30" required />          
        </div>
        <div class="text-center m-auto mt-5"><input class="btn-primary" type="submit" value="créer" /></div>

        </form>  
    </div>
    </div>
</div>
