
<?php $title = "Panneau d'administration"; ?>

<?php ob_start(); ?>
<div class="container-fluid">
    <h1 class="text-center mt-2 mb-5 text-info">Panneau d'administration</h1>
    <p>Vous pouvez :</p>
    <ul>
        <li>Créer un nouveau billet</li>
        <li>Supprimer/modifier un billet</li>
        <li>Modérer les commentaires</li>
    </ul>
    <!-- WYSIWYG Interface -->
    <div class="shadow rounded p-2 mb-5 border border-info">
        <h4>Créer un nouveau billet</h4>
        <form action="index.php?action=addPost" method="post">
            <p><label for="title">Titre de l'article</label></p>
            <textarea type="text" id="title" name="title" class="rounded"></textarea>
        
            <p><label for="mytextarea">Contenu de l'article</label></p>
            <textarea id="mytextarea" name="mytextarea" class="rounded"></textarea>
            <button type="submit" class="btn btn-primary mb-2 text-right" data-toggle="tooltip" data-placement="top" title="Créer un billet">
                Créer mon nouveau billet
            </button>
        </form>
    </div>
    <div class="row">
        <div class="col-lg-6">
    <!-- List of posts -->
            <h4 class="text-center">Liste des billets du site</h4>
            <p class="text-center mb-5">Vous pouvez modifier ou supprimer un billet en cliquant sur les boutons associés.</p>
            <?php
                while ($data = $posts->fetch())
                {
            ?>
            <div class="container bg-info text-white text-justify rounded shadow p-2 mb-5">
                <h5 class="text-center">
                    <?= htmlspecialchars($data['title']) ?>
                </h5>
                <p><u>le <?= $data['creation_date_fr'] ?></u></p>  
                <p><?= substr($data['content'], 0, 300). "..." ?></p>
                <p class="text-right">          
                    <a href="index.php?action=goToTiny&amp;id=<?= $data['id'] ?>" class="btn btn-success" role="button"
                    data-toggle="tooltip" data-placement="top" title="Modifier le billet">
                    modifier
                    </a>
                    <a href="index.php?action=deletePost&amp;id=<?= $data['id'] ?>"class="btn btn-danger" role="button"
                        data-toggle="tooltip" data-placement="top" title="Supprimer le billet">
                        supprimer
                    </a>
                </p>
            </div>
            <?php
                }
                $posts->closeCursor();
            ?>
        </div>
        <div class="col-lg-6">
        <!-- List of comments -->
            <h4 class="text-center">Liste des commentaires signalés du site</h4>
            <p class="text-center mb-5">Vous pouvez enlever le signalement (afin de restaurer le commentaire) ou le supprimer.</p>
            <?php
                while ($comment = $comments->fetch())
            {
            ?>
            <div class="container bg-danger text-white text-justify rounded shadow p-2 mb-5">
                <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
                <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                <p class="text-right">
                    <a href="index.php?action=unmarkComment&amp;id=<?= $comment['id'] ?>"class="btn btn-success" role="button" 
                    data-toggle="tooltip" data-placement="top" title="Restaurer le commentaire">
                    enlever le signalement
                    </a>
                    <a href="index.php?action=deleteComment&amp;id=<?= $comment['id'] ?>"class="btn btn-dark" role="button"
                    data-toggle="tooltip" data-placement="top" title="Supprimer le commentaire">
                    supprimer
                    </a>    
                </p>
            </div>
            <?php
                }
                $comments->closeCursor();
            ?>
        </div>
    </div>
</div>
 
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>