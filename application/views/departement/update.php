

<div class="container login-container2" align="left">
    <div class="row">
       <div class="notification is-danger">
       <?php echo validation_errors(); ?> 
        </div>
        <form method="post" accept-charset="utf-8" action="<?php base_url('departement/update' . $departement[0]->numDepartement)?>">
            <div class="form-group">
                <label class="control-label">Departement</label>
                <input type="text" class="form-control" name="nomDepartement" value="<?php echo $departement[0]->nomDepartement ?>" size="30" required /> 
                <label class="control-label">Departement</label>
                <input type="text" class="form-control" name="numeroDepartement" value="<?php echo $departement[0]->numeroDepartement ?>" size="30" required /> 
            
            </div>

            <div class="text-center"><input class="btnSubmit" type="submit" value="modifier" /></div>

       </form>  
    </div>
</div>
