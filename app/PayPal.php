<?php

namespace App;

class PayPal
{
    private $_apiContext;
    private $shopping_cart;
    private $_clientId = 'AVjLJHZ7H7mukU5-lzieT6MM1euAmV0QSjGjAf3UVwCuihNStjFkJm0zup5bzveBt2144hWpuUc733l5';
    private $_clientSecret = 'ECTIa6lGk_nyLqFuq-2hKlPz23IT7SbXrifLV-SDU0KC_KfTmDNDkGoPYNoXAgWb84l3aqzYQSIcJHHP';
    
    public function __construct($shopping_cart){
        
        $this->_apiContext = \PaypalPayment::ApiContext($this->_clientId, $this->_clientSecret);
        
        $config = config("paypal_payment");
        $flatConfig = array_dot($config);
        
        $this->_apiContext->setConfig($flatConfig);
        
        $this->shopping_cart = $shopping_cart;
    }
    
    public function generate(){
        $payment = \PaypalPayment::payment()
                                    ->setIntent("sale")
                                    ->setPayer($this->payer())
                                    ->setTransactions([$this->transaction()])
                                    ->setRedirectUrls($this->redirectURLs());
                                    
        try {
            $payment->create($this->_apiContext);
        } catch (\Exception $exeption) {
            dd($exeption);
            exit(1);
        }
        
        return $payment;
    }
    
    public function payer(){
        //return payment's method
        return \PaypalPayment::payer()->setPaymentMethod("paypal");
    }
    
    public function redirectURLs(){
        //return transaction's urls
        $baseUrl = url("/");
        return \PaypalPayment::redirectURLs()
                                ->setReturnUrl("$baseUrl/payment/store")
                                ->setCancelUrl("$baseUrl/carrito");
    }
    
    public function transaction(){
        return \PaypalPayment::transaction()
                                ->setAmount($this->amount())
                                ->setItemList($this->items())
                                ->setDescription('Tu compra en Mi Tienda')
                                ->setInvoiceNumber(uniqid());
    }
    
    public function amount(){
        return \PaypalPayment::amount()
                                ->setCurrency('USD')
                                ->setTotal($this->shopping_cart->totalUSD());
    }
    
    public function items(){
        $items = [];
        
        $products = $this->shopping_cart->products()->get();
        
        foreach($products as $product){
            array_push($items, $product->paypalItem());
        }
        
        return \PaypalPayment::itemList()->setItems($items);
    }
    
    public function execute($paymentId, $payerId){
        $payment = \PaypalPayment::getById($paymentId, $this->_apiContext);
        
        $execution = \PaypalPayment::PaymentExecution()
                                    ->setPayerId($payerId);
                                    
        dd($payment->execute($execution, $this->_apiContext));
    }
}















