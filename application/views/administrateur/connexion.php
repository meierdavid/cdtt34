<div class="container" >
    <div style=" margin-top: 20%">
    <div class="row ml-auto">
        <?php echo form_open("welcome/connexion",'class="m-auto"'); ?>
        <p class="text-warning">Cette page de connexion est dédiée aux responsables départementaux</p>

        <h1 class="h3 mb-3 font-weight-normal">Se connecter</h1>
        <label for="inputEmail" class="sr-only">Email address</label>

        <input type="email" id="inputEmail" class="form-control mb-1" name="identifiant" value=""  placeholder="Email address" required autofocus />

        <label for="inputPassword" class="sr-only">Password</label>
        <input id="inputPassword" class="form-control mb-1" type="password" name="password" value="" placeholder="Password" required />

        <input class="btn btn-lg btn-primary btn-block" type="submit" name="login" value="Connexion">
        </form>
        
    </div>
    
    </div>
        

</div>
