


<div class="container login-container2" align="left">
    <div class="row">
       <div class="notification is-danger">
       <?php echo validation_errors(); ?> 
        </div> 
        <form method="post" accept-charset="utf-8" action="<?php base_url('user/update' . $user[0]->idUser)?>">
            <div class="form-group">
                <label class="control-label">Numéro de licence</label>
                <input type="text" class="form-control" name="idUser"  value="<?php echo $user[0]->idUser ?>" size="30" required /> 
            </div>
            <div class="form-group">
                <label class="control-label">Nom du joueur</label>
                <input type="text" class="form-control" name="nomUser"  value="<?php echo $user[0]->nomUser ?>" size="30" required /> 
            </div>
            <div class="form-group">
                <label class="control-label">Prénom du joueur</label>
                <input type="text" class="form-control" name="prenomUser"  value="<?php echo $user[0]->prenomUser ?>" size="30" required /> 
            </div>
            <div class="form-group">
                <label class="control-label">Classement du joueur</label>
                <input type="numeric" class="form-control" name="classementUser"  value="<?php echo $user[0]->classementUser ?>" size="30" required /> 
            </div>
            <div class="form-group">
                <label class="control-label">Classement provisoire du joueur</label>
                <input type="numeric" class="form-control" name="classementProvisoireUser"  value="<?php echo $user[0]->classementProvisoireUser ?>" size="30" required /> 
            </div>
             <div class="form-group">
             <label class="h4" for="dateDeNaissance">date de naissance :</label>
             <input id="dateDeNaissance" class=" bg-light " name="dateDeNaissance" type="date" value="<?php echo $user[0]->dateDeNaissance ?>">
            </div>
            <div class="form-group">
                <label class="control-label">Club du joueur</label>
                <input type="text" class="form-control" name="numClub"  value="<?php echo $user[0]->numClub ?>" size="30" required /> 
            </div>
            
            <div class="text-center"><input class="btn-primary" type="submit" value="créer" /></div>

       </form>  
    </div>
</div>