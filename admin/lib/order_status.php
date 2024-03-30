<?php
function get_order_status($status)
{
  return [
    'prepare' => 'กำลังจัดเตรียม', 'send' => 'ต้องจัดส่ง',
    'progress' => 'ส่งแล้ว', 'cancel' => 'ยกเลิก'
  ][$status];
}

function settext_order_status($status)
{
  return [
    'prepare' => 'bg-warning',
    'send' => 'text-warning',
    'progress' => 'text-light bg-success',
    'cancel' => 'text-light bg-danger'
  ][$status];
}
