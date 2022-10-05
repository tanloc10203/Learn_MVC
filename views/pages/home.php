<h1>Trang chủ</h1>
<?php
foreach ($params['array'] as $row) {
?>
  <h1 style="color: <?= $params['color'] ?>"><?= htmlspecialchars($row['hoten']) . " --- " . htmlspecialchars($row['namsinh'])  ?></h1>
<?php
}
?>