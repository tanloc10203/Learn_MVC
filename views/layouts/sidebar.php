<?php

use app\core\Route;

?>

<main>
  <!-- SIDEBAR -->
  <div class="sidebar">
    <ul class="sidebar-list">
      <?php foreach (Route::list() as $key => $route) : ?>
        <li class="sidebar-list__item">
          <a href="<?= BASE_URL . $route['url'] ?>" class="<?= $params['page'] === $route['value'] ? 'active' : '' ?>">
            <?= htmlspecialchars($route['label']) ?>
          </a>
        </li>
      <?php endforeach ?>
    </ul>
  </div>