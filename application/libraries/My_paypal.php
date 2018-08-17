<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use PayPal\Api\Payment;

class My_paypal
{
    public function __construct(){
        $this->apiContext = new \PayPal\Rest\ApiContext(
                                new \PayPal\Auth\OAuthTokenCredential(
                                    'ARHrVpJvJ_hsgjQ3YGs3mNiz1v1Di4l2XrW4K073vNxKOoLjE32uIzKHNiOcCSsIETaTrw1qZuLnSAMR',
                                    'EFudzly4ivqjLWUDfDT21uFMcCjKyiPf3vEVtOInHB2n9iNkO2vmZ0iqLLXFtWJOADhYO4pIcjBRgY6_'
                                )
                            );
    }

    public function getPayment($X){
        try {

            $payment = Payment::get($X, $this->apiContext);
            return $payment;
        } catch (Exception $ex) {
            // NOTE: PLEASE DO NOT USE RESULTPRINTER CLASS IN YOUR ORIGINAL CODE. FOR SAMPLE ONLY
            //ResultPrinter::printError("Get Payment", "Payment", null, null, $ex);
            //exit(1);
        }
    }
}
