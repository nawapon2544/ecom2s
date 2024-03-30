<?php


class CreateDashboard

{
  public string $sql = '';
  function __construct($sql)
  {
    $this->sql = $sql;
  }

  public static function order_total($sql)
  {
    $total = 0;
    $row = connect_db()->query($sql);
    while ($ord = $row->fetch(PDO::FETCH_ASSOC)) {
      $total += (float) $ord['total'];
    }

    return $total;
  }


  public function  getProductID()
  {
    $row = connect_db()->query($this->sql);

    $product_list =  [
      'product_id' => [],
      'quantity' => [],
      'total' => [],
    ];


    while ($order = $row->fetch(PDO::FETCH_ASSOC)) {
      $product = json_decode($order['product']);
      foreach ($product as $p) {
        $idx =   array_search($p->product_id, $product_list['product_id']);
        $total = (float) $p->total * (int) $p->quantity;
        if (gettype($idx) == 'boolean') {
          array_push($product_list['product_id'], $p->product_id);
          array_push($product_list['quantity'], 1);
          array_push($product_list['total'], $total);
        }
        if (gettype($idx) == 'integer') {
          $product_list['quantity'][$idx]++;
          $product_list['total'][$idx] += $total;
        }
      }
    }
    return  $product_list;
  }

  public function product_total_list()
  {
    $product_list = $this->getProductID();
    if (count($product_list['product_id']) > 0) {
      $product_list_id =  array_map(function ($id) {
        return "'$id'";
      }, $product_list['product_id']);
      $product_text_id = implode(',', $product_list_id);
      $sql = "SELECT product_name,product_id FROM products WHERE product_id IN ($product_text_id) ";
      $row = connect_db()->query($sql);
      while ($product = $row->fetch(PDO::FETCH_ASSOC)) {
        $id = $product['product_id'];
        $name = $product['product_name'];
        $idx = array_search($id, $product_list['product_id']);
        $product_name_list[$idx] = $name;
        array_splice($product_list['product_id'], $idx, 1, $name);
      }
    }

    return $this->max_total_in_array('product_id', $product_list);
  }

  public function productcategory_total_list()
  {
    $product_list = $this->getProductID();
    $product_category_list = [
      'product_category' => [],
      'quantity' => [],
      'total' => []
    ];
    for ($i = 0; $i < count($product_list['product_id']); $i++) {
      $id = $product_list['product_id'][$i];
      $qty = (int)$product_list['quantity'][$i];
      $total = (float) $product_list['total'][$i];
      $sql = "SELECT product_category FROM products WHERE product_id='$id' ";
      $result = connect_db()->query($sql);
      $p = $result->fetch(PDO::FETCH_ASSOC);

      $type = str_ireplace(' ', '', $p['product_category']);
      $idx = array_search($type, $product_category_list['product_category']);

      if (gettype($idx) == 'boolean') {
        array_push($product_category_list['product_category'], $type);
        array_push($product_category_list['quantity'], $qty);
        array_push($product_category_list['total'], $total);
      }
      if (gettype($idx) == 'integer') {
        $product_category_list['quantity'][$idx] += $qty;
        $product_category_list['total'][$idx] += $total;
      }
    }
    return $this->max_total_in_array('product_category', $product_category_list);
  }
  public function producttype_total_list()
  {
    $product_list = $this->getProductID();
    $product_type_list = [
      'product_type' => [],
      'quantity' => [],
      'total' => []
    ];
    for ($i = 0; $i < count($product_list['product_id']); $i++) {
      $id = $product_list['product_id'][$i];
      $qty = (int)$product_list['quantity'][$i];
      $total = (float) $product_list['total'][$i];
      $sql = "SELECT product_type FROM products WHERE product_id='$id' ";
      $ptype_result = connect_db()->query($sql);
      $ptype = $ptype_result->fetch(PDO::FETCH_ASSOC);

      $type = str_ireplace(' ', '', $ptype['product_type']);
      $idx = array_search($type, $product_type_list['product_type']);

      if (gettype($idx) == 'boolean') {
        array_push($product_type_list['product_type'], $type);
        array_push($product_type_list['quantity'], $qty);
        array_push($product_type_list['total'], $total);
      }
      if (gettype($idx) == 'integer') {
        $product_type_list['quantity'][$idx] += $qty;
        $product_type_list['total'][$idx] += $total;
      }
    }

    return   $this->max_total_in_array('product_type', $product_type_list);
  }

  public function max_total_in_array($column, $tota_list)
  {
    $max_total_list = [
      'subject' => [],
      'total' => [],
      'quantity' => []
    ];
    $round = count($tota_list['total']);
    for ($i = 0; $i < $round; $i++) {
      $max_round = max($tota_list['total']);
      $max_idx = array_search($max_round, $tota_list['total']);
      array_push($max_total_list['subject'], $tota_list["$column"][$max_idx]);
      array_push($max_total_list['total'], $tota_list['total'][$max_idx]);
      array_push($max_total_list['quantity'], $tota_list['quantity'][$max_idx]);
      array_splice($tota_list['total'], $max_idx, 1);
      array_splice($tota_list['quantity'], $max_idx, 1);
      array_splice($tota_list["$column"], $max_idx, 1);
    }

    return $max_total_list;
  }
}
