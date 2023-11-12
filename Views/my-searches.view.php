<?php require('partials/head.view.php')?>

    <h1>Web Scraper</h1>

<?php require('partials/search-input.view.php')?>

<div class="lists-container">

    <div>
        <h2>Mis Búsquedas</h2>

        <?php foreach($searches as $search): ?>
            <div>
                <a href="search?keywords=<?= $search->keywords ?>" target="_blank">
                    <?= $search->keywords ?>
                </a>
                <form onsubmit="return confirm('¿Deseas realmente borrar esta búsqueda?')" style="display: inline;" action="/search/delete/<?= $search->id ?>" method="POST">
                    <button type="submit">❌</button>
                </form>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php require('partials/footer.view.php')?>