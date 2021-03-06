
<!doctype html>
<div class="container login-container2 " align="left">



    <div class="text-center">
        <h1>Saisir une rencontre</h1>
    </div>

    <?php echo form_open('rencontre/create', 'onsubmit="return(validate())" class="m-auto" '); ?>
    <div class="form-group">
        <div class="row">
            <div class="mb-3">
                <?php if(isset($message)){
                                
                                echo "<p class=\"text-warning\">".$message."</p>";
                            }
                ?>
                <label class="h4" for="date_rencontre">* date :</label>
                <input id="date_rencontre" class=" bg-light " name="date" type="date" value="<?php echo set_value('date'); ?>">
                <div class="error notification text-danger is-danger"><?php echo form_error('date'); ?> </div>
            </div>
        </div>
        <div class="row">
            <div>

                <div class="mb-3" id="select-tournoi">
                </div>
            </div>
        </div>


        <div class="row mb-3 mb-3">

            <div id="saisie-gagnant" class="col-sm-6 col-lg-6 col-md-6 bg-light   border-white border-right">
                <div class="" >
                    <h1 class="text-primary">Gagnant</h1>
                </div>
                <label  for="licence_gagnant" class="control-label">Licence</label>
                <input id="licence_gagnant" type="number" class="form-control " name="numGagnant"  value="<?php echo set_value('numGagnant'); ?>" size="30" required />
                <label  for="recherche-nom-Gagnant" class="control-label">Nom</label>
                <input id="recherche-nom-Gagnant" type="text" class="form-control recherche-nom" name="nomGagnant"  value="<?php echo set_value('nomGagnant'); ?>" size="30" required />
                <div class="error notification text-danger is-danger "><?php echo form_error('nomGagnant'); ?> </div>
                <label for="recherche-prenom-Gagnant" class="control-label">Prénom</label>
                <input id="recherche-prenom-Gagnant" type = "text" class="form-control" name="prenomGagnant"  value="<?php echo set_value('prenomGagnant'); ?>" size="30" required />
                <div class="error notification text-danger is-danger"><?php echo form_error('prenomGagnant'); ?> </div>
            </div>


            <div class="col-sm-6 col-lg-6 col-md-6 bg-light" >
                <div class="col-sm-6 col-lg-6 col-md-6" >
                    <h1 class="text-danger">Perdant</h1>
                </div>
                <label for="licence_perdant" class="control-label">Licence</label>
                <input id="licence_perdant" type="number" class="form-control" name="numPerdant"  value="<?php echo set_value('numPerdant'); ?>" size="30" required />
                <label for="recherche-nom-Perdant" class="control-label">Nom</label>
                <input id="recherche-nom-Perdant" type="text" class="form-control" name="nomPerdant"  value="<?php echo set_value('nomPerdant'); ?>" size="30" required />
                <div class="error notification text-danger is-danger"><?php echo form_error('nomPerdant'); ?> </div>
                <label for="recherche-prenom-Perdant" class="control-label">Prénom</label>
                <input id="recherche-prenom-Perdant" type="text" class="form-control" name="prenomPerdant"  value="<?php echo set_value('prenomPerdant'); ?>" size="30" required />
                <div class="error notification text-danger is-danger"><?php echo form_error('prenomPerdant'); ?> </div>
            </div>
        </div>
    </div>

    <div class="text-center mb-3">
        <input class="btn  btn-info" type="submit" value="Valider" />
    </div>

</form>  

</div>

<script>
    $(document).ready(function () {

        remplissage_Tournoi();


    });
    function remplissage_Tournoi() {

        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url('tournoi/findAll') ?>',
            async: true,
            dataType: 'json',
            success: function (data) {

                var html = '';
                html += '<select class="btn mt-2 mb-2 btn-secondary bg-dark  dropdown-toggle" name="nomTournoi" id="select-tournoi" >';
                html += '<option disabled selected value="">Sélectionner un tournoi (facultatif)</option >';
                var i;
                for (i = 0; i < data.length; i++) {

                    html += '<option value="' + data[i].nomTournoi + '">' + data[i].nomTournoi + '</option>';

                }
                html += '</select>';
                $('#select-tournoi').html(html);
            }


        });

    }
    function validate()
    {

        var nomG = document.getElementById("recherche-nom-Gagnant").value;
        var prenomG = document.getElementById("recherche-prenom-Gagnant").value;
        var nomP = document.getElementById("recherche-nom-Perdant").value;
        var prenomP = document.getElementById("recherche-prenom-Perdant").value;

        var str = " Vous confirmez que " + prenomG + " " + nomG + " a gagné contre " + prenomP + " " + nomP;

        var r = confirm(str)
        if (r == true)
            return true;
        else
            return false;
    }

    var optionsprenom = {

        url: '<?php echo base_url('user/findFirstName') ?>',

        getValue: "prenomUser",

        list: {
            match: {
                enabled: true
            }
        },

    };

    var optionsnom = {

        url: '<?php echo base_url('user/findLastName') ?>',

        getValue: "nomUser",

        list: {
            match: {
                enabled: true
            }
        },

    };
    $("#recherche-prenom-Gagnant").easyAutocomplete(optionsprenom);
    $("#recherche-prenom-Perdant").easyAutocomplete(optionsprenom);

    $("#recherche-nom-Gagnant").easyAutocomplete(optionsnom);
    $("#recherche-nom-Perdant").easyAutocomplete(optionsnom);
</script>