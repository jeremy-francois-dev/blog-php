<!-- View for see a selected post with its comments -->

<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<div class="container mt-5 shadow rounded">
    <h2 class="mb-5 text-center text-info">
        <?= htmlspecialchars($post['title']) ?><em> le <?= $post['creation_date_fr'] ?></em>
    </h2>    
    <p>
        <?= nl2br($post['content']) ?>
    </p>
</div>
<div class="container">
    <p class="text-right">Vous souhaitez réagir? N'hésitez pas à laisser un commentaire ci-dessous.</p>
    <div class="mb-5">
        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post" class="bg-light col-lg-3 rounded shadow">    
            <p><label for="author" class="">Pseudo</label></p>
            <input type="text" id="author" name="author" class="rounded" />
            <p><label for="comment" class="">Commentaire</label></p>
            <textarea id="comment" name="comment" class="rounded"></textarea>
            <button type="submit" class="btn btn-primary mb-2 text-right">valider</button>
        </form>
    </div>
    <h4 class="mb-4">Commentaires</h4>
    <?php
        while ($comment = $comments->fetch())
        {
    ?>
    <div class="shadow p-2 rounded bg-info text-white mb-2">
        <p>
            <strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?>
            <a href="index.php?action=markComment&amp;id=<?= $comment['id'] ?>"class="btn btn-danger" 
            data-toggle="tooltip" data-placement="top" title="Signaler le commentaire" role="button">
            signaler
            </a>         
        </p>
        <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
    </div>
    <?php
        }
    ?>   
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

