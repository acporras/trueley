<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class My_planes 
{
    public function __construct(){
        $this->basic        = (object) array(
                "monthly"       => (object) array(
                                "name"          => "Gmanager Pro Basic Monthly",
                                "code"          => "GMBM",
                                "description"   => "Suscription to Gmanager Pro Basic Monthly",
                                "amount"        => 39.00,
                                "stripeMensual" => 3900
                                ),
                "annual"      => (object) array(
                                "name"        => "Gmanager Pro Basic Annual",
                                "code"        => "GMBA",
                                "description" => "Suscription to Gmanager Pro Basic Annual",
                                "amount"      => 468.00,
                                "stripeAnual" => 46800
                                ),
                "name"          => "Gmanager Pro Basic",
                "description"   => "Gmanager Pro Basic",
        );



        $this->standard     = (object) array(
                "monthly"       => (object) array(
                                    "name"          => "Gmanager Pro Standard Monthly",
                                    "code"          => "GMSM",
                                    "description"   => "Suscription to Gmanager Pro Standard Monthly",
                                    "amount"        => 99.00,
                                    "stripeMensual" => 9900
                                ),
                "annual"      => (object) array(
                                    "name"        => "Gmanager Pro Standard Annual",
                                    "code"        => "GMSA",
                                    "description" => "Suscription to Gmanager Pro Standard Annual",
                                    "amount"      => 1188.00,
                                    "stripeAnual" => 118800
                                ),
                "name"          => "Gmanager Pro Standard",
                "description"   => "Gmanager Pro Standard",
        );



        $this->professional = (object) array(
                "monthly"       =>  (object) array(
                                    "name"  =>  "Gmanager Pro Professional Monthly",
                                    "code"  =>  "GMPM",
                                    "description"     => "Suscription to Gmanager Pro Professional Monthly",
                                    "amount" =>  199.00,
                                    "stripeMensual"   => 19900
                                ),
                "annual"        =>  (object) array(
                                    "name"  =>  "Gmanager Pro Professional Annual",
                                    "code"  =>  "GMPA",
                                    "description"     => "Suscription to Gmanager Pro Professional Annual",
                                    "amount" =>  2388.00,
                                    "stripeAnual"     => 238800
                                ),
                "name"          => "Gmanager Pro Professional",
                "description"   => "Gmanager Pro Professional",
        );
    }//

    
}
