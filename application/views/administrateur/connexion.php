<div class="row mt-5 mb-5">
        <p class="text-warning text-center">Cette page de connexion est dédiée </p>
        <p class="text-warning text-center">aux responsables départemental</p>
        <h1 class="h3 mb-3 font-weight-normal">Se connecter</h1>
        <?php echo form_open("welcome/connexion",'class="ml-5 mr-5 m-auto"'); ?>
        <div class="form-group">
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" class="form-control mb-1" name="identifiant" value=""  placeholder="Email address" required autofocus />
        </div>
        <div class="form-group">
        <label for="inputPassword" class="sr-only">Password</label>
        <input id="inputPassword" class="form-control mb-1" type="password" name="password" value="" placeholder="Password" required />
        </div>
        <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Connexion">
        </form>
</div>
