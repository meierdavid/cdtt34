


<div class="container login-container2" align="left">
    <div class="row">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div> 
        <?php echo form_open('user/update/' . $user[0]->idUser,'class="m-auto"'); ?>
        <h2>Modification d'un joueur</h2>
        <div class="form-group">
            <label for="update_num_licence" class="control-label">Numéro de licence</label>
            <input id="update_num_licence"  type="text" class="form-control" name="idUser"  value="<?php echo $user[0]->idUser ?>" size="30" required disabled /> 
        </div>
        <div class="form-group">
            <label for="update_nom_joueur" class="control-label">Nom du joueur</label>
            <input id="update_nom_joueur" type="text" class="form-control" name="nomUser"  value="<?php echo $user[0]->nomUser ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="update_prenom_joueur" class="control-label">Prénom du joueur</label>
            <input id="update_prenom_joueur" type="text" class="form-control" name="prenomUser"  value="<?php echo $user[0]->prenomUser ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="update_classement_joueur" class="control-label">Classement du joueur</label>
            <input id="update_classement_joueur" type="numeric" class="form-control" name="classementUser"  value="<?php echo $user[0]->classementUser ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="update_classementP_joueur" class="control-label">Classement provisoire du joueur</label>
            <input id="update_classementP_joueur" type="numeric" class="form-control" name="classementProvisoireUser"  value="<?php echo $user[0]->classementProvisoireUser ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label class="h4" for="update_dateDeNaissance" >date de naissance :</label>
            <input id="update_dateDeNaissance" class=" bg-light " name="dateDeNaissance" type="date" value="<?php echo $user[0]->dateDeNaissance ?>">
        </div>
        <div class="form-group">
            <label for="update_club" class="control-label">Club du joueur</label>
            <input id="update_club" type="text" class="form-control" name="nomClub"  value="<?php echo $club[0]->nomClub ?>" size="30" required /> 
        </div>

        <input class=" btn btn-primary" type="submit" value="Valider" />

        </form>  
    </div>
</div>