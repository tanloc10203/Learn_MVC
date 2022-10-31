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

  <?php if (isset($params['css']) && is_array($params['css'])) : ?>
    <?php foreach ($params['css'] as $key => $value) : ?>
      <link href="<?= $this->getCss($value) ?>" rel="stylesheet" />
    <?php endforeach; ?>
  <?php endif; ?>

</head>

<body>