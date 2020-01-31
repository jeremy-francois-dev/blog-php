<?php $title = 'Accueil du blog'; ?>

<?php ob_start(); ?>
<img src="public/images/alaska.png" class="img-fluid entete mb-5" alt="billet pour l'alaska">
<h1 class="text-center mt-2 mb-5 text-info">Découvrez ci-dessous mes derniers billets</h1>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="container bg-info text-white text-justify rounded shadow p-2 mb-5">
        <h2 class="text-center">
            <?= htmlspecialchars($data['title']) ?>
        </h2>
        <p><u>le <?= $data['creation_date_fr'] ?></u></p>
        <p class="text-justify">
            <?= substr($data['content'], 0, 800). "..." ?>
        </p>    
        <p class="text-right">
            <a href="index.php?action=post&amp;id=<?= $data['id'] ?>" class="btn btn-danger" role="button">Lire l'article</a>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>