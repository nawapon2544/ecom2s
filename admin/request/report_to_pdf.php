<?php
require_once  "../lib/mpdf/vendor/autoload.php";
require_once('../../conn.php');
require_once('../lib/get_date.php');
require_once('../lib/order_status.php');
require_once('../lib/bath_format.php');

$entries = isset($_POST['entries']) ? $_POST['entries'] : '';
$page = isset($_POST['page']) ? $_POST['page'] : '';
$month = isset($_POST['month']) ?  set_full_month($_POST['month']) : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';

$sql = "SELECT * FROM orders ";


if (!empty($month) && !empty($year)) {
  $sql .= "WHERE created LIKE '%$$month%' ";
} else if (!empty($get_year)) {
  $sql .= "WHERE created LIKE '%$year-%' ";
} else if (!empty($month)) {
  $sql .=  "WHERE created LIKE '%-$month-%' ";
}

$query_row = $page * $entries;
$sql .= "LIMIT $query_row,$entries";


$table = '<table class="table table-bordered">
<thead>
<tr class="align-middle">
  <th class="text-center" style="width: 5%;" scope="col">ลำดับ</th>
  <th style="width: 10%;" scope="col">รหัสคำสั่งซื้อ</th>
  <th style="width: 10%;" scope="col">วันที่สั่งซื้อ</th>
  <th style="width: 10%;" scope="col">สถานะ</th>
  <th style="width: 15%;" scope="col">ชื่อลูกค้า</th>
  <th style="width: 15%;" scope="col">ที่อยู่</th>
  <th style="width: 10%;" scope="col">เบอร์ติดต่อ</th>
  <th style="width: 10%;" class="text-end" scope="col">ค่าขนส่ง</th>
  <th style="width: 15%;" class="text-end" scope="col">ยอดรวม</th>
</tr>
</thead>
<tbody>
';


$idx = $page * $entries + 1;
$sum_total = 0;
$sum_order_cancel = 0;
$sum_order_paid = 0;
$sum_order_progress = 0;
$sum_delivery_cost = 0;
$row = connect_db()->query($sql);
while ($order = $row->fetch(PDO::FETCH_ASSOC)) {
  $address = json_decode($order['address']);
  $status =  get_order_status($order['status']);
  
  $sum_total += $order['status'] != 'cancel' && $order['pay_status'] == 'paid'
    ? (float) $order['total'] : 0;
  $sum_order_cancel += $order['status'] == 'cancel' ? 1 : 0;
  $sum_order_paid += $order['pay_status'] == 'paid' ? 1 : 0;
  $sum_order_progress += $order['status'] == 'progress' ? 1 : 0;
  $sum_delivery_cost += (float)$order['delivery_cost'];
  $table .= '
  <tr class="align-middle" style="border:1px solid #000;">
    <td class="text-center">'
    . $idx++ .
    '</td>
    <td>'
    . $order['order_id']
    . '</td>
    <td>'
    . $order['created'] .
    '</td>
    <td>'
    . $status .
    '</td>
    <td>'
    . $order['fname'] . ' ' . $order['lname'] .
    '</td>
    <td>'
    . $address[0] . ' ' . $address[1] .
    '</td>
    <td>'
    . $order['phone'] .
    '</td>
    <td class="text-end">' .
    number_format($order['delivery_cost'], 2) . '
    </td>
    <td class="text-end">' .
    number_format($order['total'], 2) . '
    </td>
  </tr>';
}
$table .= '</tbody></table>';
$table .= "<h5>สรุป</h5>";
$table .= '<table class="table">
<thead>
  <tr class="align-middle" >
    <th class="text-center" style="width: 15%;" scope="col">ทั้งหมด</th>
    <th class="text-center" style="width: 15%;" scope="col">ยกเลิก</th>
    <th class="text-center" style="width: 15%;" scope="col">จ่ายเงินแล้ว</th>
    <th class="text-center" style="width: 15%;" scope="col">ส่งแล้ว</th>
    <th class="text-end" style="width:15%;" scope="col">รวมค่าขนส่ง</th>
    <th class="text-end" style="width:15%;" scope="col">รวมทั้งสิ้น</th>
  </tr>
</thead>
<tbody>
  <tr class="align-middle" style="border:1px solid #000;">
    <td class="text-center" style="border:1px solid #000;">' . $idx - 1 . '</td>
    <td class="text-center" style="border:1px solid #000;">' . $sum_order_cancel . '</td>
    <td class="text-center" style="border:1px solid #000;">' . $sum_order_paid . '</td>
    <td class="text-center" style="border:1px solid #000;">' . $sum_order_progress . '</td>
    <td style="border:1px solid #000;" class="text-end">' . number_format($sum_delivery_cost, 2) . '</td>
    <td style="border:1px solid #000;" class="text-end">' . number_format($sum_total, 2) . '</td>
  </tr>
</tbody>
</table>';
$table .= '<h5 class="p-2 text-end" style="background:#212121;color:#FFF;">รวมทั้งสิ้น(';
$table .= $sum_total != 0 ?
  ConvertToBathFormat($sum_total)
  : 'ศูนย์บาทถ้วน';
$table .= ')</h5>';

$mpdf = new \Mpdf\Mpdf(
  [
    'default_font' => 'sf-thonburi',
    'format' => [297, 210]
  ]
);

$header = 'รายงานคำสั่งซื้อ';

$m = !empty($month) ? get_full_month_thai((int)$month) : '';
if (!empty($month) && !empty($year)) {

  $header .= " $m $year";
} else if (!empty($month)) {
  $header .= " $m ของทุกปี";
} else if (!empty($year)) {
  $header .= " ปี $year";
}

if (empty($month) && empty($year)) {
  $header .= "ทั้งหมด";
}
$stylesheet = file_get_contents('../../bootstrap/css/bootstrap.min.css');
$mpdf_style = file_get_contents('../css/mpdf.css');
$mpdf->SetHeader($header);
$mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($mpdf_style, \Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($table, \Mpdf\HTMLParserMode::HTML_BODY);

$report_created = date_text();
$mpdf->Output("$header-$report_created.pdf", 'I');
