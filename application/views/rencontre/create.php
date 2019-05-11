
<!doctype html>
<div class="container login-container2" align="left">

    <div class="notification is-danger">
        <?php echo validation_errors(); ?> 
    </div>
    <div class="row">
        <div>
            <h1>Saisir une rencontre</h1>
        </div>
    </div>

    <form method="post" accept-charset="utf-8" action="<?php base_url('rencontre/create') ?>">
        <div class="form-group">
            <div class="row">
                <div>
                    <label>date</label>
                    <input class="form-control" name="date" type="date">
                </div>
            </div>
            <div class="row">
                <div>
                        
                        <div id="select-tournoi">
                        </div>
                    </div>
            </div>
                    
            
            
            
            <div class='row'>
                <div class="col-sm-6 col-lg-6 col-md-6" style="background-color:aquamarine;">
                    <h1>Gagnant</h1>
                </div>
                <div class="col-sm-6 col-lg-6 col-md-6" style="background-color:red;">
                    <h1>Perdant</h1>
                </div>
            </div>
            <div class="row mb-3 ">
                <div class="col-sm-6 col-lg-6 col-md-6 " style="background-color:greenyellow;">
                    <label class="control-label">Licence</label>
                    <input type="number" class="form-control " name="numGagnant"  value="" size="30" required />
                    <label  class="control-label">Nom</label>
                    <input id="recherche-nom-Gagnant" type="text" class="form-control recherche-nom" name="nomGagnant"  value="" size="30" required />
                    <label class="control-label">Prénom</label>
                    <input type="text" class="form-control" name="prenomGagnant"  value="" size="30" required />
                </div>


                <div class="col-sm-6 col-lg-6 col-md-6" style="background-color:pink;">
                    <label class="control-label">Licence</label>
                    <input type="number" class="form-control" name="numPerdant"  value="" size="30" required />
                    <label class="control-label">Nom</label>
                    <input id="recherche-nom-Perdant" type="text" class="form-control" name="nomPerdant"  value="" size="30" required />
                    <label class="control-label">Prénom</label>
                    <input type="text" class="form-control" name="prenomPerdant"  value="" size="30" required />

                </div>
            </div>
        </div>

        <div class="text-center mb-3">
            <input class="btn btn-success" type="submit" value="créer" />
        </div>

    </form>  

</div>

<script>
     $(document).ready(function() {
         
        remplissage_Tournoi();
         
         
     });
     function remplissage_Tournoi(){

             $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url('tournoi/findAll')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    
                    var html = '<label for="select-tournoi">(facultatif) </label>';
                    html += '<select class="btn mt-2 mb-2 btn-secondary dropdown-toggle" name="nomTournoi" id="select-tournoi" required >';
                    html += '<option value="">Selectionner un tournoi</option>';
                    var i;
                    for(i=0 ; i < data.length ; i++) {
                        
                        html +='<option value="'+data[i].nomTournoi+ '">'+data[i].nomTournoi+'</option>';
                        
                    }      
                    html += '</select>';    
                    $('#select-tournoi').html(html);
                    }
                    
                    
                });
 
            }
            
var options = {
  
  url: '<?php echo base_url('user/findName')?>',

  getValue: "nomUser",

  list: {	
    match: {
      enabled: true
    }
  },

};

$("#recherche-nom-Gagnant").easyAutocomplete(options);
$("#recherche-nom-Perdant").easyAutocomplete(options);           
</script>