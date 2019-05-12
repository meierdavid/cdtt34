

<div class="container login-container2" align="left">
    <div class="row">
       <div class="notification is-danger">
       <?php echo validation_errors(); ?> 
        </div> 
        <form method="post" accept-charset="utf-8" action="<?php base_url('departement/create')?>">
            <div class="form-group">
                <label class="control-label">Nom du departement</label>
                <input type="text" class="form-control" name="nomDepartement"  value="" size="30" required /> 
                <div id="select-departement">
                
     
                </div>
            </div>

            <div class="text-center"><input class="btn-primary" type="submit" value="créer" /></div>

       </form>  
    </div>
</div>
<script>
     $(document).ready(function() {
         
        remplissage_Club();
         
         
     });
     function remplissage_Club(){

             $.ajax({
                type  : 'ajax',
                url   : '<?php echo base_url('departement/findAll')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    
                    var html = '<label for="select-club">Choisir un Departement </label>';
                    html += '<select name="nomDepartement" id="select-club" required >';
                    html += '<option value="">--Selectionner un club--</option>';
                    var i;
                    for(i=0 ; i < data.length ; i++) {
                        
                        html +='<option value="'+data[i].nomDepartement+ '">'+data[i].nomDepartement+'</option>';
                        
                    }      
                    html += '</select>';    
                    $('#select-departement').html(html);
                    }
                    
                    
                });
 
            }

     
    
</script>