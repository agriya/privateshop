<?php
class GatewayHelper extends AppHelper
{
    var $helpers = array(
        'Form',
        'Html'
    );
    function feesAddedAmount($amount, $gateway) 
    {
        //Gateway fees in percentage for all payment
        $gateway_fees = array(
            'paypal' => '2.9'
        );
        if (empty($gateway_fees[$gateway])) {
            trigger_error('*** dev1framework: Invalid payment gateway name passed', E_USER_ERROR);
        }
        return (((((100*$gateway_fees[$gateway]) /(100-$gateway_fees[$gateway])) /100) *$amount) +$amount);
    }
    function paypal($settings = array()) 
    {
        $__default_settings = array(
            // Common fixed settings
            'action_url' => array(
                'livemode' => 'https://www.paypal.com/cgi-bin/webscr',
                'testmode' => 'https://www.sandbox.paypal.com/cgi-bin/webscr'
            ) , // Paypal URL to which the form to be posted
            'cmd' => '_xclick',
            // Overridable setting
            'is_testmode' => Configure::read('paypal.is_testmode') ,
            'notify_url' => '', // Our site URL to which the paypal will post the payment status details in background
            'cancel_return' => '', // Our site URL to which paypal transaction cancel click will return
            'return' => '', // Our site URL to which paypal transaction success click will return
            'item_name' => '', // Item/product name
            'business' => Configure::read('paypal.account') ,
            'currency_code' => Configure::read('site.currency_code') ,
            'amount' => '',
            'on0' => 'Transkey',
            'os0' => '',
        );
        if (!empty($settings['system_defined'])) {
            $__default_settings['on1'] = 'Syskey';
            $__default_settings['os1'] = '';
        }
        $settings = array_merge($__default_settings, $settings);
        if (!empty($settings['user_defined'])) {
            $ecnoded_params = base64_url_encode(gzdeflate(serialize($settings['user_defined']) , 9));
            $user_defined_hash = substr(md5(Configure::read('Security.salt') . $ecnoded_params) , 5, 5);
            $settings['os0'] = $ecnoded_params . '~' . $user_defined_hash;
        }
        $settings['action_url'] = (!empty($settings['is_testmode'])) ? $settings['action_url']['testmode'] : $settings['action_url']['livemode'];
        echo $this->Form->create(null, array(
            'class' => 'normal js-auto-submit',
            'id' => 'selPaymentForm',
            'url' => $settings['action_url']
        ));
        echo $this->Form->input('cmd', array(
            'type' => 'hidden',
            'name' => 'cmd',
            'value' => $settings['cmd']
        ));
        echo $this->Form->input('notify_url', array(
            'type' => 'hidden',
            'name' => 'notify_url',
            'value' => $this->Html->url($settings['notify_url'], true)
        ));
        echo $this->Form->input('cancel_return', array(
            'type' => 'hidden',
            'name' => 'cancel_return',
            'value' => $this->Html->url($settings['cancel_return'], true)
        ));
        echo $this->Form->input('return', array(
            'type' => 'hidden',
            'name' => 'return',
            'value' => $this->Html->url($settings['return'], true)
        ));
        echo $this->Form->input('business', array(
            'type' => 'hidden',
            'name' => 'business',
            'value' => $settings['business']
        ));
        echo $this->Form->input('item_name', array(
            'type' => 'hidden',
            'name' => 'item_name',
            'value' => $settings['item_name']
        ));
        echo $this->Form->input('currency_code', array(
            'type' => 'hidden',
            'name' => 'currency_code',
            'value' => $settings['currency_code']
        ));
        echo $this->Form->input('amount', array(
            'type' => 'hidden',
            'name' => 'amount',
            'value' => $settings['amount']
        ));
        echo $this->Form->input('on0', array(
            'type' => 'hidden',
            'name' => 'on0',
            'value' => $settings['on0']
        ));
        echo $this->Form->input('os0', array(
            'type' => 'hidden',
            'name' => 'os0',
            'value' => $settings['os0']
        ));
        echo $this->Form->input('no_shipping', array(
            'type' => 'hidden',
            'name' => 'no_shipping',
            'value' => 1
        ));
        echo $this->Form->input('no_note', array(
            'type' => 'hidden',
            'name' => 'no_note',
            'value' => 1
        ));
        echo $this->Form->submit(__l('Pay via Paypal'));
        echo $this->Form->end();
    }
}
?>