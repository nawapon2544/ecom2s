<?php
function set_text_social($social)
{
  return [
    'facebook' => '<i class="fa-brands fa-facebook"></i>',
    'instagram' => '<i class="fa-brands fa-square-instagram"></i>',
    'tiktok' => '<i class="fa-brands fa-tiktok"></i>',
    'youtube' => '<i class="fa-brands fa-youtube"></i>',
    'twitter' => '<i class="fa-brands fa-twitter"></i>',
    'line' => '<i class="bi bi-line"></i>',

  ][$social];
}
