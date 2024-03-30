<?php
class ConfigAdmin
{
  private static $admin = 'admin';
  private static $password = '123456';
  public static function config()
  {
    return ['admin' => self::$admin, 'password' => self::$password];
  }
}
