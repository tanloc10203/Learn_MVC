<?php

if (!isset($_SESSION['user'])) {
  $this->redirect(BASE_URL . "/admin/login");
} else {
  $this->getLayoutAdmin("header", $params);

  $this->getLayoutAdmin($params['content'], $params);

  $this->getLayoutAdmin("footer", $params);
}
