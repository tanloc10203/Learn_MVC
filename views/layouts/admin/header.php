<?php

use app\controllers\admin\Member;

$user = new Member;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($params['title']) ?></title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- LINK JS CUSTOM -->
  <script src="<?= $this->getJs('toast') ?>"></script>
  <script src="<?= $this->getJs('function') ?>"></script>

  <!-- LINK CSS -->
  <link href="<?= $this->getCss('toast') ?>" rel="stylesheet" />

  <?php if (isset($params['css']) && is_array($params['css'])) : ?>
    <?php foreach ($params['css'] as $key => $value) : ?>
      <link href="<?= $this->getCss($value) ?>" rel="stylesheet" />
    <?php endforeach; ?>
  <?php endif; ?>

</head>

<body>
  <header class=" bg-light">
    <div class="container">
      <div class="row">
        <div class="col-12">

          <nav class="navbar navbar-expand-lg navbar-light px-0">
            <a class="navbar-brand" href="<?= BASE_URL . "\\admin" ?>">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <?php if ($user->getRoleUser() === 'ADMIN') : ?>
                  <li class="nav-item <?= $params['page'] === 'category' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "\\admin\\" . "category" ?>">Danh mục <span class="sr-only">(current)</span></a>
                  </li>

                  <li class="nav-item <?= $params['page'] === 'product' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "\\admin" ?>">Sản phẩm </a>
                  </li>

                  <li class="nav-item <?= $params['page'] === 'member' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "\\admin\\" . "member" ?>">Thành viên</a>
                  </li>

                  <li class="nav-item <?= $params['page'] === 'bill' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "\\admin\\" . 'bill' ?>">Đơn hàng</a>
                  </li>
                <?php else : ?>
                  <li class="nav-item <?= $params['page'] === 'category' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "\\admin\\" . "category" ?>">Danh mục <span class="sr-only">(current)</span></a>
                  </li>

                  <li class="nav-item <?= $params['page'] === 'product' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "\\admin" ?>">Sản phẩm </a>
                  </li>

                  <li class="nav-item <?= $params['page'] === 'bill' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "\\admin\\" . 'bill' ?>">Đơn hàng</a>
                  </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['user'])) : ?>
                  <li class="nav-item <?= $params['page'] === 'logout' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "\\admin\\" . "logout" ?>">Đăng xuất</a>
                  </li>
                  <li class="nav-item <?= $params['page'] === 'profile' ? 'active' : '' ?>">
                    <a class="nav-link" href="<?= BASE_URL . "\\admin\\" . "profile" ?>">Profile</a>
                  </li>
                <?php endif; ?>
              </ul>
            </div>
          </nav>

        </div>
      </div>
    </div>
  </header>