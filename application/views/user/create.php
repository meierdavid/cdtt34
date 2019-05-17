

<div class="container login-container2" align="left">
    <div class="row">
        <div class="notification is-danger">
            <?php echo validation_errors(); ?> 
        </div> 
        <div class="form-group">
        <h2>Création de joueurs</h2>
        </div>
        <?php echo form_open('user/create'); ?>
        <div class="form-group">
            <label for="create_num_licence" class="control-label">Numéro de licence</label>
            <input id="create_num_licence" type="number" class="form-control" name="idUser"  value="<?php echo set_value('idUser'); ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_nom_joueur" class="control-label">Nom du joueur</label>
            <input id="create_nom_joueur" type="text" class="form-control" name="nomUser"  value="<?php echo set_value('nomUser'); ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_prenom_joueur" class="control-label">Prénom du joueur</label>
            <input id="create_prenom_joueur" type="text" class="form-control" name="prenomUser"  value="<?php echo set_value('prenomUser'); ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_classement_joueur" class="control-label">Classement du joueur</label>
            <input id="create_classement_joueur" type="number" class="form-control" name="classementUser"  value="<?php echo set_value('classementUser'); ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_classementP_joueur" class="control-label">Classement provisoire du joueur</label>
            <input id="create_classementP_joueur" type="number" class="form-control" name="classementProvisoireUser"  value="<?php echo set_value('classementProvisoireUser'); ?>" size="30" required /> 
        </div>
        <div class="form-group">
            <label for="create_dateDeNaissance" class="control-label" >Date de naissance :</label>
            <input id="create_dateDeNaissance" class=" bg-light " name="dateDeNaissance" type="date" value="<?php echo set_value('dateDeNaissance'); ?>">
        </div>
        <div id="select-club">


        </div>


        <div class="text-center"><input class="btn-primary" type="submit" value="créer" /></div>

        </form>  
    </div>
</div>
<script>
    $(document).ready(function () {

        remplissage_Club();


    });
    function remplissage_Club() {

        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url('club/findAll') ?>',
            async: true,
            dataType: 'json',
            success: function (data) {

                var html = '<label for="select-club">Choisir un club :</label>';
                html += '<select name="nomClub" id="select-club" required >';
                html += '<option value="">--Selectionner un club--</option>';
                var i;
                for (i = 0; i < data.length; i++) {

                    html += '<option value="' + data[i].nomClub + '">' + data[i].nomClub + '</option>';

                }
                html += '</select>';
                $('#select-club').html(html);
            }


        });

    }



</script>