<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class My_stripe {

    public function __construct(){
        $this->production = false;//true para activar pagos reales, false para pruebas

        //Entorno Real de Produccion
        if($this->production){
            $this->secret = "sk_live_wyjZnTHget4oShwHMzEE31GU";
            $this->public ="pk_live_WYumTSNfi88Hc0l4Wark2UhT";
            \Stripe\Stripe::setApiKey($this->secretProd);
        }else{
        //Entorno de Pruebas
            $this->secret = "sk_test_alFGBGa0QpnSb0iHE9e7aeze";
            $this->public ="pk_test_xGpYIL00kK1GGn4hPD2dMwIW";
            \Stripe\Stripe::setApiKey($this->secret);
        }
    }//

    //Crear un Objeto para Retornar las Respuestas
    public function objeto($X){
        $obj = json_encode($X);
        $obj = json_decode($obj);
        return $obj;
    }//

    //Crea un Cliente en la Plataforma Stripe
    public function customer($X){
            $customer = \Stripe\Customer::create(array(
                'email'  => $X->usuario,
                'source' => $X->token
            ));
        return $customer;
    }//

    //Procesa un pago con TDC en la Plataforma Stripe
    public function charge($X){
        try{
            $charge = \Stripe\Charge::create(array(
                'customer'    => $X->id,
                'amount'      => $X->amount,
                'currency'    => 'usd',
                'description' => $X->description
            ));
            return $this->objeto($charge);
        }catch(\Stripe\Error\Card $e){

        $body = $e->getJsonBody();
        $err  = $body['error'];
        
        print('Status is:' . $e->getHttpStatus() . "\n");
        print('Type is:' . $err['type'] . "\n");
        print('Code is:' . $err['code'] . "\n");
        // param is '' in this case
        print('Param is:' . $err['param'] . "\n");
        print('Message is:' . $err['message'] . "\n");
        } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
        } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
        } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
        } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
        }
    }//

    //Retorna la Informacion de un Pago basado en la ID, recibe la ID del Pago
    public function retrieve($X){
        return $this->objeto(\Stripe\Charge::retrieve($X));
    }//

    //Lista de Todos los Compradores registrados en Stripe, recibe el limite a mostrar
    public function listCustomers($X){
        return $this->objeto(\Stripe\Customer::all(array("limit" => $X)));
    }//
    
    //Retorna la Información de un Comprador registrado en Stripe, Recibe la ID del Cliente
    public function retrieveCustomer($X){
        return $this->objeto(\Stripe\Customer::retrieve($X));
    }//

    //Elmina un Comprador registrado en Stripe, Recibe la ID del Cliente
    public function deleteCustomer($X){
        $cu = \Stripe\Customer::retrieve($X);
        return $this->objeto($cu->delete());
    }//

    //Lista de Todos los Eventos Generados, Recivbe el limite de Eventos a Mostrar
    public function retrieveAllEvents($X){
        return $this->objeto(\Stripe\Event::all(array("limit" => $X)));
    }//

    //Retorna Evento Especifico, Recibe la ID del Evento
    public function retrieveEvent($X){
        return $this->objeto(\Stripe\Event::retrieve($X));
    }//

    //Retorna el balance Disponible en Cuenta
    public function retrieveBalance(){
        return $this->objeto(\Stripe\Balance::retrieve());
    }

    //Suscribirse a un plan, recibe un objeto con la data
    public function setSuscription($X){
        $ret = \Stripe\Subscription::create(array(
                    "customer" => $X->idCliente,
                    "items" => array(
                    array(
                        "plan" => $X->idPlan,
                    ),
                    )
                ));
        return $this->objeto($ret);
    }//

    //Verificar una Suscripción, recibe la id de la suscripcion
    public function retrieveSuscription($X){
        return $this->objeto(\Stripe\Subscription::retrieve($X));
    }//

    //Cancela una Suscripcion, recibe un objeto con la id a cancelar
    public function cancelSuscription($X){
        $sub = \Stripe\Subscription::retrieve($X->idSuscription);
        return $this->objeto($sub->cancel());
    }//

    //lista el total de las suscripciones, recibe el limite a mostrar
    public function listSuscription($X){
        return $this->objeto(\Stripe\Subscription::all(array('limit'=>$X)));
    }//

}