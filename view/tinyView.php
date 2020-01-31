<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
<h1 class="text-center mt-2 mb-5 text-info">Modification de billet</h1>

<!-- WYSIWYG Interface -->
<div class="shadow rounded p-2 mb-5 border border-info container">
    <h4>Créer un nouvel article</h4>
    <form action="index.php?action=updatePost&amp;id=<?= $post['id'] ?>" method="post">
        <p><label for="title">Titre de l'article</label></p>
        <textarea type="text" id="title" name="title" class="rounded"><?= $post['title'] ?></textarea>

        <p><label for="mytextarea">Contenu de l'article</label></p>
        <textarea id="mytextarea" name="mytextarea" class="rounded"><?= $post['content'] ?></textarea>
        
        <button type="submit" class="btn btn-primary mb-2 text-right"data-toggle="tooltip" data-placement="top" title="Modifier mon billet">
            Modifier mon billet
        </button>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

