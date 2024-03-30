<?php
function routes($p)
{
  return [
    'add-product' =>  [
      'file' => 'add-product', 'title' => 'เพิ่มสินค้า', 'style' => [
        'add-product.css'
      ]
    ],
    'manage-product' => [
      'file' => 'product_manage', 'title' => 'จัดการสินค้า', 'style' => [
        'add-product.css'
      ]
    ],
    'product-edit' => [
      'file' => 'product-edit', 'title' => 'แก้ไขสินค้า', 'style' => [
        'add-product.css'
      ]
    ],
    'ord-prepare' => [
      'file' => 'ord_prepare', 'title' => 'สินค้าต้องจัดเตรียม', 'style' => [
        'ord_prepare.css'
      ]
    ], 'ord-send' => [
      'file' => 'ord_send', 'title' => 'สินค้าต้องจัดส่ง', 'style' => [
        'ord_send.css'
      ]
    ],
    'order-list' => [
      'file' => 'order_list', 'title' => 'คำสั่งซื้อทั้งหมด', 'style' => [
        'order_list.css'
      ]
    ],
    'order-list-detail' => [
      'file' => 'order_list_detail', 'title' => 'รายละเอียดคำสั่งซื้อ', 'style' => [
        'order_list_detail.css'
      ]
    ],
    'contact-us' => [
      'file' => 'contact_us', 'title' => 'เกี่ยวกับเรา', 'style' => [
        'contact_us.css'
      ]
    ],
    'terms-and-conditions' => [
      'file' => 'terms_and_conditions', 'title' => 'ข้อกำหนดการใช้งาน', 'style' => [
        'terms_and_conditions.css'
      ]
    ],

    'warranty-policy' => [
      'file' => 'warranty_policy', 'title' => 'การรับประกัน', 'style' => [
        'warranty_policy.css'
      ]
    ],
    'delivery' => [
      'file' => 'delivery', 'title' => 'การจัดส่งสินค้า', 'style' => [
        'delivery.css'
      ]
    ],
    'refund-product' => [
      'file' => 'refund_product', 'title' => 'การคืนสินค้า', 'style' => [
        'refund_product.css'
      ]
    ],

    'refund-money' => [
      'file' => 'refund_money', 'title' => 'การคืนเงิน', 'style' => [
        'refund_money.css'
      ]
    ],
    'order-cancel' => [
      'file' => 'order_cancel', 'title' => 'การยกเลิกสินค้า', 'style' => [
        'order_cancel.css'
      ]
    ],
    'tracking-channel' => [
      'file' => 'tracking_channel', 'title' => 'เพิ่มช่องทางการติดตาม', 'style' => [
        'tracking_channel.css'
      ]
    ],
    'tracking-channel-manage' => [
      'file' => 'tracking_channel_manage', 'title' => 'ช่องทางการติดตาม', 'style' => [
        'tracking_channel.css'
      ]
    ],
    'tracking-chanel-edit' => [
      'file' => 'tracking_channel_edit', 'title' => 'แก้ไขข้อมูลช่องทางการติดตาม', 'style' => [
        'tracking_channel.css'
      ]
    ],
    'logo' => [
      'file' => 'logo', 'title' => 'ตั้งค่าโลโก้', 'style' => [
        'logo.css'
      ]
    ],
    'icon' => [
      'file' => 'icon', 'title' => 'ตั้งค่าไอคอน', 'style' => [
        'icon.css'
      ]
    ],
    'title' => [
      'file' => 'title', 'title' => 'ตั้งค่าชื่อเว็บไซต์', 'style' => [
        'title.css'
      ]
    ],
    'slide' => [
      'file' => 'slide', 'title' => 'เพิ่มภาพสไลด์', 'style' => [
        'slide.css'
      ]
    ],
    'taxID' => [
      'file' => 'taxID', 'title' => 'เพิ่มเลขภาษี', 'style' => [
        'taxID.css'
      ]
    ],
    'set-about-us' => [
      'file' => 'set_about_us', 'title' => 'กำหนดค่าที่เกี่ยวกับเรา', 'style' => []
    ],
    'payment' => [
      'file' => 'payment', 'title' => 'เพิ่มการชำระเงิน', 'style' => [
        'payment.css'
      ]
    ],

    'payment-manage' => [
      'file' => 'payment_manage', 'title' => 'การชำระเงิน', 'style' => [
        'payment.css'
      ]
    ],
    'payment-edit' => [
      'file' => 'payment_edit', 'title' => 'แก้ไขข้อมูลการชำระเงิน', 'style' => [
        'payment.css'
      ]
    ],
    'user' => [
      'file' => 'user', 'title' => 'ผู้ใช้', 'style' => [
        'user.css'
      ]
    ],
    'admin' => [
      'file' => 'admin', 'title' => 'พนักงาน และผู้ดูแล', 'style' => []
    ],
    'admin-manage' => [
      'file' => 'admin_manage', 'title' => 'จัดการ พนักงาน และผู้ดูแล', 'style' => []
    ],
    'admin-edit' => [
      'file' => 'admin_edit', 'title' => 'แก้ไขข้อมูลพนักงาน และผู้ดูแล', 'style' => []
    ],
    'report' => [
      'file' => 'report', 'title' => 'รายงาน', 'style' => [
        'report.css'
      ]
    ],
    'xlsx' => [
      'file' => 'xlsx_file', 'title' => 'ไฟล์รายงาน', 'style' => [
        'xlsx_file.css'
      ]
    ],
    'dashboard' => [
      'file' => 'dashboard', 'title' => 'Dashboard', 'style' => [
        'dashboard.css'
      ]
    ],
    'qrcode' => [
      'file' => 'qrcode', 'title' => 'Qrcode', 'style' => [
        'qrcode.css'
      ]
    ],
    'confirm-order' => [
      'file' => 'confirm_order', 'title' => 'ยืนยันคำสั่งซื้อ', 'style' => [
        'confirm_order.css'
      ]
    ],
  ][$p];
}
