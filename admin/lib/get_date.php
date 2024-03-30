<?php
date_default_timezone_set("ASIA/BANGKOK");
function get_full_month_thai($m)
{
  return [
    'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน',
    'พฤษภาคม', 'มิถุนายน', 'กรกฏาคม', 'สิงหาคม',
    'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
  ][$m-1];
}
function set_full_month($m)
{
  return strlen($m) == 1 ? "0$m" : $m;
}


function date_text()
{
  return date("YmdHis");
};

function get_this_year()
{
  return date("Y");
}

function get_this_month()
{
  return date("m");
}
