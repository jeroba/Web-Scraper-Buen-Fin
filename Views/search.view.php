<?php require('partials/head.view.php')?>

    <h1>Web Scraper</h1>

<?php require('partials/search-input.view.php')?>
<?php if (Core\Auth::check()): ?>
    <?php require('partials/save-search.view.php')?>
<?php endif ?>

<div class="lists-container">

    <div class="list">
        <h2>Amazon</h2>

        <?php foreach($amazonResults as $result): ?>
            <div class="list-item">
                <div><img src="<?= $result['image'] ?>"></div>
                <div>
                    <div> <a href="https://amazon.com<?= $result['url'] ?>" target="_blank"><?= $result['title'] ?></a></div>
                    <div class="price"><?= $result['price'] ?></div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <div class="list">
        <h2>Ebay</h2>

        <?php foreach($ebayResults as $result): ?>
            <div class="list-item">
                <div><img src="<?= $result['image'] ?>"></div>
                <div>
                    <div> <a href="<?= $result['url'] ?>" target="_blank"><?= $result['title'] ?></a></div>
                    <div class="price"><?= $result['price'] ?></div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>

<?php require('partials/footer.view.php')?>