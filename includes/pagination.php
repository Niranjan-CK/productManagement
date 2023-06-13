<div class="container text-center">
<nav class="navbar navbar-expand-lg">
        <ul class="navbar-nav">
            <li class="nav-item card m-3">
                <?php if ($paginator->previous): ?>
                    <a class="btn btn-primary" href="?page=<?= $paginator->previous; ?>">Previous</a>
                <?php else: ?>
                    <span class="btn">Previous</span>
                <?php endif; ?>
            </li>
            <li class="nav-item card m-3">
                <?php if ($paginator->next): ?>
                    <a class="btn btn-primary" href="?page=<?= $paginator->next; ?>">Next</a>
                <?php else: ?>
                    <span class="btn">Next</span>
                <?php endif; ?>
            </li>
        </ul>
    </nav>
</div>
