<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Madminconfig extends CI_model
{
    public function __construct(){
        $this->_general = new GeneralClass();
        $this->_valid   = new Valid();
        $this->_session = $this->_valid->_Check($this->session->token);
    }

    private function setHistorial($x){
        $h = array(
            'fecha'       => $this->_general->date()->datetime,
            'usuario'     => $this->_session->data->nombre,
            'asunto'      => $x[0],
            'descripcion' => $x[1]
        );
        $this->db->insert('historial',$h);
    }//

    public function _getPlanes(){
        $q = $this->db->query("SELECT * FROM planes");

        return ($q->num_rows()>=1) ? $q->result() : false;
    }//

    private function _validPlan($x){
        $this->db->select('nombreplan');
        $this->db->from('planes');
        $this->db->where('nombreplan =',$x);
        $q = $this->db->get();
        return ($q->num_rows()>=1) ? true : false;
    }//

    public function _newPlan($x){
        if($this->_validPlan(strtolower(htmlentities($x['nombre'])))){
            return false;
            exit;
        }

        $codplan = 'PL-'.uniqid();
        $this->db->trans_begin();

        $reg = array(
            'codplan'      => $codplan,
            'fechareg'     => $this->_general->date()->datetime,
            'fechamod'     => $this->_general->date()->datetime,
            'usuarioreg'   => $this->_session->data->nombre,
            'usuariomod'   => $this->_session->data->nombre,
            'nombreplan'   => strtolower(htmlentities($x['nombre'])),
            'registroplan' => '0',
            'limiteplan'   => $x['limite'],
            'costodolar'   => '0',
            'costopeso'    => $x['pesos'],
            'estatus'      => '1',
            'boton'        => $x['boton']
        );

        $this->db->insert('planes',$reg);

        if($this->db->trans_complete()==TRUE){
            $this->db->trans_commit();
            $this->setHistorial(array('Nuevo Plan','Se ha registrado el Plan '.$reg['nombreplan']));
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//
    
    public function _editPlan($x){

        $this->db->trans_begin();

        $this->db->set('nombreplan',strtolower(htmlentities($x['nombre'])));
        $this->db->set('limiteplan',$x['limite']);
        $this->db->set('costodolar','0');
        $this->db->set('costopeso',$x['pesos']);
        $this->db->set('estatus',$x['estatus']);
        $this->db->set('boton',$x['boton']);
        $this->db->where('codplan =',$x['codigo']);

        $this->db->update('planes');

        if($this->db->trans_complete()==TRUE){
            $this->db->trans_commit();
            $this->setHistorial(array('Edición de Plan','Se ha editado el Plan '.$x['nombre']));
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//


    public function _getConfig(){
        $this->db->select('*');
        $this->db->from('configuracion');
        $q = $this->db->get();
        return ($q->num_rows()>=1) ? $q->row() : false;
    }//


    public function _paypal($x){
        $this->db->trans_begin();
        $this->db->set('fechaupdate',$this->_general->date()->datetime);
        $this->db->set('usuarioupdate',$this->_session->data->nombre);
        $this->db->set('paypalestatus',$x['estatus']);
        $this->db->set('paypalaccount',$x['cuenta']);
        $this->db->set('paypalclient',$x['client']);
        $this->db->set('paypalsecret',$x['secret']);
        $this->db->update('configuracion');

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            $this->setHistorial(array('Actualización PayPal','Se ha modificado la Cuenta PayPal'));
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//

    public function _mercadopago($x){
        $this->db->trans_begin();
        $this->db->set('fechaupdate',$this->_general->date()->datetime);
        $this->db->set('usuarioupdate',$this->_session->data->nombre);
        $this->db->set('mpestatus',$x['estatus']);
        $this->db->set('mpapp',$x['id']);
        $this->db->set('mpsecret',$x['secret']);
        $this->db->update('configuracion');

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            $this->setHistorial(array('Actualización Mercadopago','Se ha modificado la Cuenta Mercadopago'));
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//

    public function _messages($x){
        $this->db->trans_begin();
        switch($x[1]){
            case 'clave':
                $this->db->set('mensajeclave',$x[0]);
                $this->db->update('configuracion');
                break;
                
            case 'nuevo':
                $this->db->set('mensajenuevo',$x[0]);
                $this->db->update('configuracion');
            break;
            
            case 'politicas':
                $this->db->set('politicas',$x[0]);
                $this->db->update('configuracion');
            break;
        }
        
        if($this->db->trans_complete()===true){
            $this->db->trans_complete();
            return true;
        }else{
            $this->db->trabs_rollback();
            return false;
        }
    }//

    public function _getClients(){
        $q = $this->db->query("SELECT * FROM clientes WHERE codcliente != 'home'");
        return ($q->num_rows()>=1) ? $q->result() : false;
    }//

    public function _novedad($x){
        $this->db->trans_begin();

        $da = [
            'fecha' =>  $this->_general->date()->datetime,
            'para'  =>  $x['para'],
            'tipo'  =>  'novedad',
            'info'  =>  $x['novedad']
        ];
        $this->db->insert('novedades',$da);

        if($this->db->trans_complete()===true){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }
    }//

}//

/*
//Crear Plan
try{
    $response = $this->_client->request('POST', 'https://api.mercadopago.com/v1/plans?access_token=ACCESS_TOKEN', [
        'headers' => [
            'Accept'     => 'application/json',
            'content-type' =>'application/json'
        ],
        'json' => [
            'description'   => 'Descripcion del Plan',
            'auto_recurring' => [

                'frequency'          => 1,
                'frequency_type'     => 'months',
                'transaction_amount' => 200,
                'repetitions'        => 24,
                'debit_date'         => 1,
                'setup_fee '         => 120

            ],
        ]
    ]);
    return $response->getBody()->getContents();
}catch(Exception $e){
    return $e->getMessage();
}


//Actualizar plan
try{
    $response = $this->_client->request('PUT', 'https://api.mercadopago.com/v1/subscriptions/SUBSCRIPTION_ID?access_token=ACCESS_TOKEN', [
        'headers' => [
            'Accept'     => 'application/json',
            'content-type' =>'application/json'
        ],
        'json' => [
            'description'   => 'Descripcion del Plan',
            'auto_recurring' => [
                'frequency'          => 1,
                'frequency_type'     => 'months',
                'transaction_amount' => 200,
                'repetitions'        => 24,
                'debit_date'         => 1
                
            ],
        ]
    ]);
    return $response->getBody()->getContents();
}catch(Exception $e){
    return $e->getMessage();
}

//Pausar o Reactivar plan
try{
    $response = $this->_client->request('PUT', 'https://api.mercadopago.com/v1/subscriptions/SUBSCRIPTION_ID?access_token=ACCESS_TOKEN', [
        'headers' => [
            'Accept'     => 'application/json',
            'content-type' =>'application/json'
        ],
        'json' => [
            'status'   => 'paused'
            //'status'   => 'authorized'//Reactivarlo
        ]
    ]);
    return $response->getBody()->getContents();
}catch(Exception $e){
    return $e->getMessage();
}



//Suscribir a Plan
try{
    $response = $this->_client->request('POST', 'https://api.mercadopago.com/v1/subscriptions?access_token=ACCESS_TOKEN', [
        'headers' => [
            'Accept'     => 'application/json',
            'content-type' =>'application/json'
        ],
        'json' => [
            'plan_id'   => 'id del plan',
            'payer' => [

                'id'     => 'customer id'
            ],
        ]
    ]);
    return $response->getBody()->getContents();
}catch(Exception $e){
    return $e->getMessage();
}

*/