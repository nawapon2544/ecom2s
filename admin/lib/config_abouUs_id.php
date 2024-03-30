<?php
class ConfigABoutUsID
{
  private static  $contact_id = '00-0100-about';
  private static  $terms_id = '00-0200-terms';
  private static  $warranty_policy_id = '00-0300-WPCY';
  private static  $delivery_id = '00-0400-dvry';
  private static  $refund_product_id = '00-0500-rfndp';
  private static  $refund_money_id = '00-0600-rfnm';
  private static  $order_cancel_id = '00-0700-ordcn';
  private static  $logo_id = '00-0800-logo';
  private static  $title_web_id = '00-0900-title';
  private static  $tax_id = '00-1000-taxID';
  private static  $icon_id = '00-1100-Icon';
  private static  $view_id = '00-1200-View';
  private static  $qrcode_id = '00-1300-qrcode';

  public static function get_contact_id()
  {
    return self::$contact_id;
  }
  public static function get_terms_id()
  {
    return self::$terms_id;
  }
  public static function get_warranty_policy_id()
  {
    return self::$warranty_policy_id;
  }

  public static function get_delivery_id()
  {
    return self::$delivery_id;
  }

  public static function get_refund_product_id()
  {
    return self::$refund_product_id;
  }

  public static function get_refund_money_id()
  {
    return self::$refund_money_id;
  }

  public static function get_order_cancel_id()
  {
    return self::$order_cancel_id;
  }
  public static function get_logo_id()
  {
    return self::$logo_id;
  }
  public static function get_title_id()
  {
    return self::$title_web_id;
  }
  public static function get_tax_id()
  {
    return self::$tax_id;
  }
  public static function get_icon_id()
  {
    return self::$icon_id;
  }
  public static function get_view_id()
  {
    return self::$view_id;
  }

  public static function get_qrcode_id()
  {
    return self::$qrcode_id;
  }
}
