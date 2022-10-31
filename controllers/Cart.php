<?php

namespace app\controllers;

use app\core\Controller;
use app\models\admin\ProductModel;

class Cart extends Controller
{
  private ProductModel $product;

  public function __construct()
  {
    $this->product = new ProductModel;
  }

  public function index()
  {
    if ($this->isPost()) {
      $data = (array) $this->getCart();

      $newData = array();

      foreach ($data as $id => $item)
        array_push($newData, $item);

      echo json_encode([
        'data_cart' => $newData,
        'data_cart_info' => $this->getInfoCart(),
        'path_img' => PUBLIC_PATH_PRODUCT_UPLOAD,
        'base_url' => BASE_URL
      ]);
      exit;
    }

    return $this->view('layoutMaster', [
      'page' => 'cart',
      'title' => 'Giỏ hàng',
      'css' => ['index', 'cart'],
      'js' => ['cart'],
    ]);
  }

  public function delete()
  {
    if (isset($_SESSION['cart'])) {
      if ($this->isPost()) {
        $data = $this->getBody();

        unset($_SESSION['cart']['buy'][$data['id']]);

        $this->update();

        echo json_encode(['message' => 'Delete success.']);
      }
    }
  }

  public function add()
  {
    if ($this->isPost()) {
      $data = $this->getBody();
      $quantity = $data['quantity'];
      $p_id = $data['p_id'];

      $product = $this->product->findOne(['id' => $p_id]);

      if (isset($_SESSION['cart']['buy'][$p_id])) {
        $p_session = $_SESSION['cart']['buy'][$p_id];
        $quantity = $data['quantity'] + $p_session['quantity'];

        if ((int)$quantity > 10) {
          exit(json_encode([
            'error' => true,
            'message' => 'Số lượng thêm đã lớn hơn 10',
          ]));
        }
      }

      $newProduct = array(
        'id' => $product->id,
        'name' => $product->name,
        'thumb' => $product->thumb,
        'price' => (int) $product->price,
        'quantity' => (int) $quantity,
        'sub_total' => $quantity * (int) $product->price
      );

      $_SESSION['cart']['buy'][$p_id] = $newProduct;

      $bill = $this->update();

      $_SESSION['message'] = array(
        'type' => 'success',
        'text' => 'Thêm giỏ hàng thành công',
        'title' => 'Success'
      );

      echo json_encode([
        'error' => false,
        'message' => 'Thêm giỏ hàng thành công.',
        'data' => $newProduct,
        'bill' => $bill,
        'base_url' => BASE_URL
      ]);
    }
  }

  public function updateQuantity()
  {
    if (isset($_SESSION['cart'])) {
      if ($this->isPost()) {
        $data = $this->getBody();

        $product = $this->product->findById($data['p_id']);

        $_SESSION['cart']['buy'][$data['p_id']]['quantity'] = $data['quantity'];
        $_SESSION['cart']['buy'][$data['p_id']]['sub_total'] = $data['quantity'] * $product['price'];

        $info_cart = $this->update();

        echo json_encode([
          'message' => 'update quantity success',
          'info_cart' => $info_cart,
        ]);
      }
    }
  }

  private function update()
  {
    if (isset($_SESSION['cart'])) {
      $num_order = 0;
      $total = 0;

      foreach ($_SESSION['cart']['buy'] as $item) {
        $num_order += $item['quantity'];
        $total += $item['quantity'] * $item['price'];
      }

      $newData = array(
        'total' => $total,
        'num_order' => $num_order,
      );

      $_SESSION['cart']['info'] = $newData;

      return $newData;
    }
  }

  private function getCart()
  {
    if (isset($_SESSION['cart'])) {
      return (array) $_SESSION['cart']['buy'];
    }
    return [];
  }

  private function getInfoCart()
  {
    if (isset($_SESSION['cart'])) {
      return (array) $_SESSION['cart']['info'];
    }
    return [];
  }
}
