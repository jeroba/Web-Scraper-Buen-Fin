<form action="search" method="GET">
    <input type="text" class="search-input" value="<?= input('keywords') ?>" name="keywords" placeholder="Escribe lo que buscas...">
    <button type="submit" class="search-button">Buscar</button>
    <div>
        <select name="sort">
            <option <?= input('sort') == 'normal' ? 'selected' : '' ?> value="normal">Normal</option>
            <option <?= input('sort') == 'asc' ? 'selected' : '' ?> value="asc">Mas barato primero</option>
            <option <?= input('sort') == 'desc' ? 'selected' : '' ?> value="desc">Mas caro primero</option>
        </select>
    </div>
</form>