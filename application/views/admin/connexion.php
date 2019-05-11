
<div class="row justify-content-md-center mt-5 mb-5">
    
    <div id="body">
        <h1>Login</h1>
        <form action="<?=site_url("admin/connexion")?>" method="post" >
            <p>Identifiant :</p>
            <code><input type="text" name="identifiant" value="" /></code>
            <p>Mot de passe :</p>
            <code><input type="password" name="password" value="" /></code>
            
            <input type="submit" name="login" value="Connexion">
        </form>
    </div>
</div>