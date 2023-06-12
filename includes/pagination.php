<?php $base = $_SERVER["REQUEST_URI"];?>
<nav class="navbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php if ($paginator->previous): ?>
                    <a href="<?= $base;?>?page=<?= $paginator->previous; ?>">Previous</a>
                <?php else: ?>
                    Previous
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <?php if ($paginator->next): ?>
                    <a href="<?= $base;?>?page=<?= $paginator->next; ?>">Next</a>
                <?php else: ?>
                    Next
                <?php endif; ?>
            </li>
        </ul>
    </nav>
