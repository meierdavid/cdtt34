
<div class="row justify-content-md-center mt-5 mb-5">
    
    <div class="text-center">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <form class="" action="<?=site_url("administrateur/create")?>" method="post" >
             <label for="inputEmail" class="sr-only">Email address</label>
      
            <input type="email" id="inputEmail" class="form-control mb-1" name="mail" value=""  placeholder="Email address" required autofocus />
            
            <label for="inputPassword" class="sr-only">Password</label>
            <input id="inputPassword" class="form-control mb-1" type="password" name="newPassword" value="" placeholder="Password" required />
            <div class="error notification text-danger is-danger"><?php echo form_error('newPassword'); ?> </div>
            <label for="inputPassword" class="sr-only">Password</label>
            <input id="inputPassword" class="form-control mb-1" type="password" name="newPasswordConfirm" value="" placeholder="Password" required />
            <div class="error notification text-danger is-danger"><?php echo form_error('newPasswordConfirm'); ?> </div>
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="Ajouter l'administrateur" value="Connexion">
        </form>
    </div>
</div>

