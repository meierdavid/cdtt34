

<div class="container login-container2" align="left">
    <div class="row">
       <div class="notification is-danger">
       <?php echo validation_errors(); ?> 
        </div> 
        <form method="post" accept-charset="utf-8" action="<?php base_url('club/create')?>">
            <div class="form-group">
                <label class="control-label">Nom du club</label>
                <input type="text" class="form-control" name="nomClub"  value="" size="30" required /> 
            </div>

            <div class="text-center"><input class="btn-primary" type="submit" value="créer" /></div>

       </form>  
    </div>
</div>
