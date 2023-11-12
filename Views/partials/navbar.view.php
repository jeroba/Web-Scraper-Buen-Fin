<nav>
    <a href="/">Home</a>
    <?php if (Core\Auth::check()): ?>
        <a href="/my-searches">Mis Búsquedas</a>
        <span><?= $_SESSION['name'] ?></span>
        <form style="display: inline;" action="/logout" method="POST">
            <button style="background-color: transparent; border: 0px; font-size: 16px;">Salir</button>
        </form>
    <?php else: ?>
        <a href="/login">Entrar</a>
    <?php endif ?>
</nav>