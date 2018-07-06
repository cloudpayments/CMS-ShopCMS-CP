<?php
/**
 * @connect_module_class_name cloudpayments_ru
 *
 */
class cloudpayments_ru extends PaymentModule {

    private $sets = array(
        'CONF_CLOUDPAYMENTS_PUBLICID' => array(
            'settings_value'         => '',
            'settings_title'         => 'Public ID из личного кабинета',
            'settings_description'   => 'Введите Public ID (обязательный параметр, берется в личном кабинете).',
            'settings_html_function' => 'setting_TEXT_BOX(0,',
            'sort_order'             => 10),

        'CONF_CLOUDPAYMENTS_PASSWORD' => array(
            'settings_value'         => '',
            'settings_title'         => 'Пароль для API из личного кабинета',
            'settings_description'   => 'Введите Пароль для API (обязательный параметр, берется в личном кабинете).',
            'settings_html_function' => 'setting_TEXT_BOX(0,',
            'sort_order'             => 20),

        'CONF_CLOUDPAYMENTS_TYPE' => array(
            'settings_value'         => '0',
            'settings_title'         => 'Тип оплаты',
            'settings_description'   => 'одностадийный либо двухстадийный (с холдированием) вариант оплаты.',
            'settings_html_function' => 'settingCONF_CLOUDPAYMENTS_TYPE(',
            'sort_order'             => 30),

        'CONF_CLOUDPAYMENTS_DESCRIPTION' => array(
            'settings_value'         => 'Оплата заказа #',
            'settings_title'         => 'Описание платежа',
            'settings_description'   => 'Описание платежа (вместо знака # будет подставлен номер заказа).',
            'settings_html_function' => 'setting_TEXT_BOX(0,',
            'sort_order'             => 40),

        'CONF_CLOUDPAYMENTS_STATUS_AFTER_PAY' => array(
            'settings_value'         => '0',
            'settings_title'         => 'Статус заказа после оплаты (одностадийный вариант оплаты)',
            'settings_description'   => 'Укажите, какой статус присваивать заказу после совершения платежа.',
            'settings_html_function' => 'setting_ORDER_STATUS_SELECT(',
            'sort_order'             => 50),

        'CONF_CLOUDPAYMENTS_STATUS_AFTER_AUTH' => array(
            'settings_value'         => '0',
            'settings_title'         => 'Статус заказа после холдирования средств (двухстадийный вариант оплаты)',
            'settings_description'   => 'Укажите, какой статус присваивать заказу после замораживания (холдирования) средств на счету покупателя.',
            'settings_html_function' => 'setting_ORDER_STATUS_SELECT(',
            'sort_order'             => 60),

        'CONF_CLOUDPAYMENTS_STATUS_AFTER_CONFIRM' => array(
            'settings_value'         => '0',
            'settings_title'         => 'Статус заказа после подтверждения платежа (двухстадийный вариант оплаты)',
            'settings_description'   => 'Укажите, какой статус присваивать заказу после подтверждения снятия средств со счета покупателя.',
            'settings_html_function' => 'setting_ORDER_STATUS_SELECT(',
            'sort_order'             => 70),

        'CONF_CLOUDPAYMENTS_STATUS_AFTER_REFUND' => array(
            'settings_value'         => '0',
            'settings_title'         => 'Статус заказа после возврата платежа покупателю (одностадийный и двухстадийный варианты оплаты)',
            'settings_description'   => 'Укажите, какой статус присваивать заказу после возврата средств на счет покупателя.',
            'settings_html_function' => 'setting_ORDER_STATUS_SELECT(',
            'sort_order'             => 80),

        'CONF_CLOUDPAYMENTS_STATUS_AFTER_CANCEL' => array(
            'settings_value'         => '0',
            'settings_title'         => 'Статус заказа после отмены холдирования (двухстадийный вариант оплаты)',
            'settings_description'   => 'Укажите, какой статус присваивать заказу после отмены холдирования средств на счету покупателя.',
            'settings_html_function' => 'setting_ORDER_STATUS_SELECT(',
            'sort_order'             => 90),

        'CONF_CLOUDPAYMENTS_URL_SUCCESS' => array(
            'settings_value'         => '0',
            'settings_title'         => 'Страница удачного завершения платежа',
            'settings_description'   => 'Выберите статическую страницу, куда будет перекинут клиент при удачном завершении платежа',
            'settings_html_function' => 'settingCONF_CLOUDPAYMENTS_URL(',
            'sort_order'             => 100),

        'CONF_CLOUDPAYMENTS_URL_FAIL' => array(
            'settings_value'         => '0',
            'settings_title'         => 'Страница неудачного завершения платежа',
            'settings_description'   => 'Выберите статическую страницу, куда будет перекинут клиент при неудачном завершении платежа',
            'settings_html_function' => 'settingCONF_CLOUDPAYMENTS_URL(',
            'sort_order'             => 110),

        'CONF_CLOUDPAYMENTS_TAX_RU' => array(
            'settings_value'         => '18',
            'settings_title'         => 'Ставка НДС',
            'settings_description'   => 'ставка или расчетная ставка НДС (актуально только при подключенной онлайн-кассе)',
            'settings_html_function' => 'settingCONF_CLOUDPAYMENTS_TAX_RU(',
            'sort_order'             => 120),

        'CONF_CLOUDPAYMENTS_CUST_PHONE' => array(
            'settings_value'         => 0,
            'settings_title'         => 'Поле, содержащее телефон клиента',
            'settings_description'   => 'В каком дополнительном поле хранится телефон клиента (Админка-&gt;Информация-&gt;Форма регистрации).',
            'settings_html_function' => 'settingCONF_CLOUDPAYMENTS_CUST_PHONE(',
            'sort_order'             => 130),
        );

    function _InitVars()
        {
        $this->title = 'Cloud payments';
        $this->description = 'Модуль оплаты через Cloud payments';
        $this->Settings = array();  // список настроек. должен совпадать с ключами массива $this->SettingsFields из _initSettingFields
        foreach ($this->sets as $key => $val) $this->Settings[] = $key;
        }

    function _initSettingFields()
        {
        $this->SettingsFields = array();
        foreach ($this->sets as $key => $val) $this->SettingsFields[$key] = $val;
        }

    function after_processing_html($orderID)
        {
        $order = _getOrderById($orderID);
        $order['order_amount'] = round($order['order_amount'],2);

        $content = array();
        foreach (ordGetOrderContent($orderID) as $product)
            {
#           пересчитаем стоимость каждого товара исходя из общей скидки и стоимости доставки, чтобы в кассовом чеке были только товары (распределим стоимость доставки по товарам).
            $product['Price'] = $product['Price'] * (1.0 - $order['order_discount']/100.0) * $order['order_amount'] / ($order['order_amount'] - $order['shipping_cost']);
            $sum = $product['Price'] * $product['Quantity'];
            $content[] = array(
#                "label"     => iconv('CP1251','UTF-8',html_entity_decode($product['name'],ENT_QUOTES,'CP1251')),
                "label"     => html_entity_decode($product['name'],ENT_QUOTES,'CP1251'),
                "price"     => number_format($product['Price'],2,'.',''),
                "quantity"  => number_format($product['Quantity'],2,'.',''),
                "amount"    => number_format($sum,2,'.',''));
            }

        $mySmarty = new Smarty;
        $mySmarty->template_dir = "core/modules/tpl/";
        if ((int)CONF_SMARTY_FORCE_COMPILE) $mySmarty->force_compile = true;
        $mySmarty->assign('order',$order);
        $mySmarty->assign('content',$content);
        $mySmarty->assign('type',$this->_getSettingValue('CONF_CLOUDPAYMENTS_TYPE'));
        $mySmarty->assign('tax',$this->_getSettingValue('CONF_CLOUDPAYMENTS_TAX_RU'));
        $mySmarty->assign('publicId',$this->_getSettingValue('CONF_CLOUDPAYMENTS_PUBLICID'));
        $mySmarty->assign('description',str_replace('#',$order['orderID'],$this->_getSettingValue('CONF_CLOUDPAYMENTS_DESCRIPTION')));
        $onSuccess = $this->_getSettingValue('CONF_CLOUDPAYMENTS_URL_SUCCESS');
        $onFail    = $this->_getSettingValue('CONF_CLOUDPAYMENTS_URL_FAIL');
        $mySmarty->assign('onSuccess',$onSuccess?CONF_FULL_SHOP_URL.'page_'.$this->_getSettingValue('CONF_CLOUDPAYMENTS_URL_SUCCESS').'.html':'');
        $mySmarty->assign('onFail',$onFail?CONF_FULL_SHOP_URL.'page_'.$this->_getSettingValue('CONF_CLOUDPAYMENTS_URL_FAIL').'.html':'');
        $mySmarty->assign('phone',$this->CustomerPhone($orderID));
        return $mySmarty->fetch('cloudpayments_ru.tpl.html');
        }

    function uninstall($_ModuleConfigID = 0)
        {
        PaymentModule::uninstall($_ModuleConfigID);
        }

    function after_payment_php($orderID, $post)
        {
# в этой функции обычно происходит обработка запроса от платежного сервиса 
#(сообщение об оплате, запрос на коректность заказа, etc).
# вызывается из helper-а. В данном модуле весь исполняемый код сделан в helper-е без вызова этой функции.
        }

    function CustomerPhone($orderID) // получим телефонный номер клиента, если он есть
        {
        $phoneID = $this->_getSettingValue('CONF_CLOUDPAYMENTS_CUST_PHONE');
        if ($phoneID == 0) return false;
        foreach (GetRegFieldsValuesByOrderID($orderID) as $field) if ($field['reg_field_ID'] == $phoneID) return $field['reg_field_value'];
        return false;
        }
    }

function settingCONF_CLOUDPAYMENTS_TYPE($settingID)
    {
    $Options = array(array('title' => 'Одностадийная', 'value' => 0),
                     array('title' => 'Двухстадийная',  'value' => 1));
    return setting_SELECT_BOX($Options, $settingID);
    }

function settingCONF_CLOUDPAYMENTS_TAX_RU($settingID)
    {
    $Options = array(array('title' => 'Без НДС', 'value' => -1),
                     array('title' => '0%',      'value' => 0),
                     array('title' => '10%',     'value' => 10),
                     array('title' => '18%',     'value' => 18),
                     array('title' => '10/110',  'value' => 110),
                     array('title' => '18/118',  'value' => 118));
    return setting_SELECT_BOX($Options, $settingID);
    }

function settingCONF_CLOUDPAYMENTS_URL($settingID)
    {
    $Options = array(array('title' => 'Не перекидывать', 'value' => 0));
    foreach (auxpgGetAllPageAttributes() as $page) $Options[] = array('title' => strlen($page['aux_page_name'])<20?$page['aux_page_name']:substr($page['aux_page_name'],0,20).'...','value' => $page['aux_page_ID']);
    return setting_SELECT_BOX($Options, $settingID);
    }

function settingCONF_CLOUDPAYMENTS_CUST_PHONE($settingID)
    {
    $Options = array(array('title' => 'Отсутствует', 'value' => 0));
    foreach (GetRegFields() as $field) $Options[] = array('title' => $field['reg_field_name'],'value' => $field['reg_field_ID']);
    return setting_SELECT_BOX($Options, $settingID);
    }

?>
