

<div class="container login-container2" align="left">
    <div style=" margin-top: 20%">
        <div class="row">
            <div class="notification is-danger">
                <?php echo validation_errors(); ?> 
            </div>
            <?php echo form_open('tournoi/create', 'class="m-auto"'); ?>
            <h2>Créer un Tournoi</h2>
            <div class="form-group">
                <label for="create_nom_tournoi" class="control-label">Nom du tournoi</label>
                <input id="create_nom_tournoi" type="text" class="form-control" name="nomTournoi"  value="" size="30" required /> 
            </div>

            <div class="text-center"><input class="btn-primary" type="submit" value="Enregistrer" /></div>

            </form>  
        </div>
    </div>
</div>
