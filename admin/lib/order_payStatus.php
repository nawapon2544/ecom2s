<?php

function order_pay_status($status)
{
  return [
    'paid' => 'จ่ายแล่ว', 'unpaid' => 'ยังไม่จ่าย', 'progress' => 'รอการยืนยัน'
  ][$status];
}

function set_text_pay_status($status)
{
  return  [
    'paid' => 'text-light bg-primary', 'unpaid' => 'text-light bg-danger',
    'progress' => 'text-light bg-secondary'
  ][$status];
}
