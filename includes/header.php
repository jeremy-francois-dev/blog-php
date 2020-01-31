<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php">Accueil</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">         
            <?php 
                if (empty($_SESSION['pseudo'])) {
            ?>
            <!-- Form for the administrator connexion -->
            <form class="form-inline my-2 my-lg-0" action="index.php?action=connexion" method="post">
                <input class="form-control mr-sm-2" type="text" name="pseudo" placeholder="Pseudo">
                <input class="form-control mr-sm-2" type="password" name="userPass" placeholder="Mot de passe"/>
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Connexion</button> 
            </form>
            <?php
                } 
                else {
            ?>
                <li class="nav-link"><a class="text-primary" href="index.php?action=login">Dashboard</a></li>
                <li class="nav-link"><a class="text-danger" href="index.php?action=logout">Déconnexion</a></li>     
            <?php
                }
            ?>
        
            <?php 
                if (!empty($_SESSION['pseudo'])) {
                ?>
             <em>Salut <?= $_SESSION['pseudo'] ?> !</em>
            <?php
                } 
            ?>
        </div>
    </nav>
</header>