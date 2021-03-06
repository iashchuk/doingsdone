<section class="content__side">
    <?php if (isset($_SESSION['user'])): ?>
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php foreach ($projects as $item): ?>
            <li class="main-navigation__list-item">
                <a class="main-navigation__list-item-link" href="/index.php?id=<?=$item['id'];?>"><?=strip_tags($item['title']);?></a>
                <span class="main-navigation__list-item-count"><?= get_count_tasks($active_tasks, $item['id']) ?></span>
            </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button"
        href="../add-project.php" target="project_add">Добавить проект</a>

    <?php else: ?>

    <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>
    <a class="button button--transparent content__side-button" href="../auth.php">Войти</a>
    <?php endif; ?>
</section>
