<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($params['title']) ?></title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- LINK JS TOAST CUSTOM -->
  <script src="<?= $this->getJs('toast') ?>"></script>
  <script src="<?= $this->getJs('function') ?>"></script>

  <link href="<?= $this->getCss('toast') ?>" rel="stylesheet" />
  <link href="<?= $this->getCss('admin') ?>" rel="stylesheet" />

  <?php if (isset($params['css']) && is_array($params['css'])) : ?>
    <?php foreach ($params['css'] as $key => $value) : ?>
      <link href="<?= $this->getCss($value) ?>" rel="stylesheet" />
    <?php endforeach; ?>
  <?php endif; ?>

</head>

<body>
  <!-- HEADER -->
  <!-- {active ? "header-wp-fixed" : "header-wp" } -->
  <header class="header-wp">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 d-flex justify-content-between">
          <div class="header-wp__logo">
            <h1>Logo</h1>
          </div>
          <ul class="header-wp__nav-menu">
            <li class="header-wp__item">
              <a class="header-wp__link--active" href="<?= BASE_URL . "/" ?>">Home</a>
            </li>
            <li class="header-wp__item">
              <a href="<?= BASE_URL . "/introduce" ?>">Giới thiệu</a>
            </li>
            <li class="header-wp__item">
              <a href=<?= BASE_URL . "/blog" ?>>Blog</a>
            </li>
            <li class="header-wp__item header-wp__cart">
              <a href="<?= BASE_URL . "/cart" ?>">
                Cart
                <?php if (isset($_SESSION['cart']['info'])) : ?>
                  <span class="header-wp__num-cart">
                    <?= $_SESSION['cart']['info']['num_order'] ?>
                  </span>
                <?php endif ?>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <div class="header-wp__cart-response">
      <a href="/cart">
        <i class="fa-solid fa-cart-shopping"></i>
        <span class="header-wp__num-cart-response">3</span>
      </a>
    </div>

    <div class="header-wp__icon--menu">
      <i class="fa-solid fa-bars"></i>
      <!-- {close ? <i class="bi bi-x"></i> : <i class="bi bi-list"></i>} -->
    </div>
  </header>