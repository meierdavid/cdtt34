
<div class="row justify-content-md-center mt-5 mb-5">
    
    <div class="text-center">
        <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
        <?php echo form_open("administrateur/create");?>
             <label for="create_email" class="sr-only">Email address</label>
      
            <input type="email" id="create_email" class="form-control mb-1" name="mail" value=""  placeholder="Email address" required autofocus />
            
            <label for="create_password" class="sr-only">Password</label>
            <input id="create_password" class="form-control mb-1" type="password" name="newPassword" value="" placeholder="Password" required />
            <div class="error notification text-danger is-danger"><?php echo form_error('newPassword'); ?> </div>
            <label for="create_password2" class="sr-only">Confirm Password</label>
            <input id="create_password2" class="form-control mb-1" type="password" name="newPasswordConfirm" value="" placeholder="Password" required />
            <div class="error notification text-danger is-danger"><?php echo form_error('newPasswordConfirm'); ?> </div>
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="Ajouter l'administrateur" value="Connexion">
        </form>
    </div>
</div>

