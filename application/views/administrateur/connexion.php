<div class="row justify-content-md-center mt-5 mb-5">

    <div class="text-center">
        
        <h1 class="h3 mb-3 font-weight-normal">Se connecter</h1>
        <?php echo form_open("welcome/connexion"); ?>
        <label for="inputEmail" class="sr-only">Email address</label>

        <input type="email" id="inputEmail" class="form-control mb-1" name="identifiant" value=""  placeholder="Email address" required autofocus />

        <label for="inputPassword" class="sr-only">Password</label>
        <input id="inputPassword" class="form-control mb-1" type="password" name="password" value="" placeholder="Password" required />

        <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Connexion">
        </form>
        
    </div>
    <div class="text-center">
        <p>Cette page de connection est dédié aux responsables départemental</p>
    </div>

</div>
