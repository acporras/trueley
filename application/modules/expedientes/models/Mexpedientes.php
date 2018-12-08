<?php
use xfxstudios\general\GeneralClass;
use xfxstudios\general\Valid;
class Mexpedientes extends CI_model
{
    public function __construct(){
        $this->_general = new GeneralClass();
        $this->_valid   = new Valid();
        $this->_session = $this->_valid->_Check($this->session->token);
        $this->load->library('juzgados');
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

    public function _getNovedades(){
        $cod =$this->_session->data->codcliente;
        $q = $this->db->query("SELECT * FROM novedades WHERE para IN ('$cod','All') ORDER BY idNovedad DESC LIMIT 20");
        return  ($q->num_rows()>=1) ? $q->result() : false;
    }//

    public function _getLista(){
        $resp = array();

        $this->db->select('*');
        $this->db->from('expedientes');
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $this->db->where('estado =','a despacho');
        $q = $this->db->get();
        $resp['despachados'] = ($q->num_rows()>=1) ? $q->result() : false;
        
        $this->db->select('*');
        $this->db->from('expedientes');
        $this->db->where('codcliente =',$this->_session->data->codcliente);
        $this->db->where('estado =','pendiente despacho');
        $p = $this->db->get();
        $resp['pendientes'] = ($p->num_rows()>=1) ? $p->result() : false;

        return $resp;

    }//


    public function _newCaseFile($x){
           
        if($x['bis']=="si" && $x['bisdata'] != ""){
            $extra = $x['bisdata'];
            $cod = $x['expediente'].' bis'.$extra;
        }else{
            $extra = "";
            $cod = $x['expediente'];
        }

        $valid = $this->juzgados->_getCaseFile(array('expediente'=>$cod,'juzgado'=>$x['juzgado']));

        $this->db->trans_begin();

        if($valid){
            $in = array(
                'codcliente'      => $this->_session->data->codcliente,
                'expediente'      => $x['expediente'],
                'cliente'         => $x['portada'],
                'portada'         => $valid->caratula,
                'bis'             => ($x['bis']=="si") ? 1 : 0,
                'bisdata'         => $x['bisdata'],
                'basexpe'         => $x['expediente'],
                'circunscripcion' => $x['circunscripcion'],
                'localidad'       => $x['localidad'],
                'dependencia'     => $x['juzgado'],
                'juzgado'         => $valid->dependencia,
                'saliocon'        => $valid->localidad,
                'fechareg'        => $this->_general->date()->datetime,
                'fechamod'        => $this->_general->date()->datetime,
                'fechadespacho'   => date("Y-m-d H:i:s", strtotime($valid->despacho)),
                'fechaupdate'     => $this->_general->date()->datetime,
                'observacion'     => $x['observacion'],
                'estado'          => 'a despacho',
            );
            $this->db->set('expedientes','expedientes + 1',false);
            $this->db->set('despachados','despachados + 1',false);
            $this->db->where('codcliente =',$this->_session->data->codcliente);
            $this->db->update('numeros');
        }else{
            $in = array(
                'codcliente'      => $this->_session->data->codcliente,
                'expediente'      => $x['expediente'],
                'cliente'         => $x['portada'],
                'portada'         => $x['portada'],
                'bis'             => ($x['bis']=="si") ? 1 : 0,
                'bisdata'         => $x['bisdata'],
                'basexpe'         => $x['expediente'],
                'circunscripcion' => $x['circunscripcion'],
                'localidad'       => $x['localidad'],
                'dependencia'     => $x['juzgado'],
                'juzgado'         => 'Pendiente',
                'saliocon'        => 'Pendiente',
                'fechareg'        => $this->_general->date()->datetime,
                'fechamod'        => $this->_general->date()->datetime,
                'fechadespacho'   => $this->_general->date()->datetime,
                'fechaupdate'     => $this->_general->date()->datetime,
                'observacion'     => $x['observacion'],
                'estado'          => 'pendiente despacho',
            );
            $this->db->set('expedientes','expedientes + 1',false);
            $this->db->set('pendientes','pendientes + 1',false);
            $this->db->where('codcliente =',$this->_session->data->codcliente);
            $this->db->update('numeros');
        }

        $movi = array(
            'codcliente' => $this->_session->data->codcliente,
            'fecha'      => $this->_general->date()->datetime,
            'tipo'       => 'Registro',
            'info'       => 'Registro de Expediente Nro. <b>'.$in['expediente'].'</b>, Cliente: <b>'.$x['portada'].'</b>, Portada: <b>'.$in['portada'].'</b>, Dependencia: <b>'.$in['juzgado'].'</b>'
        );
        
        $this->db->insert('expedientes',$in);
        $this->db->insert('movimientos',$movi);

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollback();
            return false;
        }

    }//

    public function _generalUpdate(){

        $resp = array(
            'cod'    => '200',
            'nuevos' => 0,
            'viejos' => 0,
            'nada'   => 0
        );

        $this->db->select('*');
        $this->db->from('expedientes');
        $q = $this->db->get();
        if($q->num_rows()>=1){

            foreach($q->result() as $item){

                if($item->bis=="1"){
                    $valid = $this->juzgados->_getCaseFile(array('expediente'=>$item->expediente.' bis'.$item->bisdata,'juzgado'=>$item->dependencia));
                }else{
                    $valid = $this->juzgados->_getCaseFile(array('expediente'=>$item->expediente,'juzgado'=>$item->dependencia));
                }


                if($valid && $item->estado == "pendiente despacho"){
                    $this->db->set('portada',$valid->caratula);
                    $this->db->set('juzgado',$valid->dependencia);
                    $this->db->set('saliocon',$valid->localidad);
                    $this->db->set('fechamod',$this->_general->date()->datetime);
                    $this->db->set('fechadespacho',date("Y-m-d H:i:s", strtotime($valid->despacho)));
                    $this->db->set('fechaupdate',$this->_general->date()->datetime);
                    $this->db->set('estado','a despacho');
                    $this->db->where('idExpe = ',$item->idExpe);
                    $this->db->update('expedientes');

                    $resp['nuevos'] = $resp['nuevos']+1;

                    $this->db->set('despachados','despachados + 1',false);
                    $this->db->set('pendientes','pendientes - 1',false);
                    $this->db->where('codcliente =',$this->_session->data->codcliente);
                    $this->db->update('numeros');

                    $movi = array(
                        'codcliente' => $this->_session->data->codcliente,
                        'fecha'      => $this->_general->date()->datetime,
                        'tipo'       => 'Actualización',
                        'info'       => 'Actualizado de Expediente Nro. <b>'.$item->expediente.'</b>, Cliente: <b>'.$item->cliente.'</b>, Portada: <b>'.$valid->caratula.'</b>, Dependencia: <b>'.$valid->dependencia.'</b>'
                    );
                    $this->db->insert('movimientos',$movi);

                }else if($valid && $item->estado == "a despacho"){

                    $fe = date("Y-m-d H:i:s", strtotime($valid->despacho));

                    if($fe != $item->fechadespacho){
                        $this->db->set('fechamod',$this->_general->date()->datetime);
                        $this->db->set('fechadespacho',date("Y-m-d H:i:s", strtotime($valid->despacho)));
                        $this->db->set('fechaupdate',$this->_general->date()->datetime);
                        $this->db->where('idExpe = ',$item->idExpe);
                        $this->db->update('expedientes');

                        $resp['viejos'] = $resp['viejos']+1;

                        $movi = array(
                            'codcliente' => $this->_session->data->codcliente,
                            'fecha'      => $this->_general->date()->datetime,
                            'tipo'       => 'Actualización',
                            'info'       => 'Actualizado de Expediente Nro. <b>'.$item->expediente.'</b>, Cliente: <b>'.$item->cliente.'</b>, Portada: <b>'.$item->portada.'</b>, Dependencia: <b>'.$item->juzgado.'</b>'
                        );
                        $this->db->insert('movimientos',$movi);

                    }else{ }

                }else{
                    $resp['nada'] = $resp['nada']+1;
                }
            };

            return json_encode($resp);

        }else{
            $resp = array('cod' =>  '201');
        }
    }//


    public function _lineUpdate($x){

        $this->db->select('*');
        $this->db->from('expedientes');
        $this->db->where('idExpe =',$x);
        $q = $this->db->get();

        if($q->num_rows()>=1){

                $item = $q->row();

                if($item->bis=="1"){
                    $valid = $this->juzgados->_getCaseFile(array('expediente'=>$item->expediente.' bis'.$item->bisdata,'juzgado'=>$item->dependencia));
                }else{
                    $valid = $this->juzgados->_getCaseFile(array('expediente'=>$item->expediente,'juzgado'=>$item->dependencia));
                }

                
                if($valid && $item->estado == "pendiente despacho"){
                    $this->db->set('portada',$valid->caratula);
                    $this->db->set('juzgado',$valid->dependencia);
                    $this->db->set('saliocon',$valid->localidad);
                    $this->db->set('fechamod',$this->_general->date()->datetime);
                    $this->db->set('fechadespacho',date("Y-m-d H:i:s", strtotime($valid->despacho)));
                    $this->db->set('fechaupdate',$this->_general->date()->datetime);
                    $this->db->set('estado','a despacho');
                    $this->db->where('idExpe = ',$item->idExpe);
                    $this->db->update('expedientes');

                    $this->db->set('despachados','despachados + 1',false);
                    $this->db->set('pendientes','pendientes - 1',false);
                    $this->db->where('codcliente =',$this->_session->data->codcliente);
                    $this->db->update('numeros');

                    $movi = array(
                        'codcliente' => $this->_session->data->codcliente,
                        'fecha'      => $this->_general->date()->datetime,
                        'tipo'       => 'Actualización',
                        'info'       => 'Actualizado de Expediente Nro. <b>'.$item->expediente.'</b>, Cliente: <b>'.$item->cliente.'</b>,  Portada: <b>'.$valid->caratula.'</b>, Dependencia: <b>'.$valid->dependencia.'</b>'
                    );
                    $this->db->insert('movimientos',$movi);
                    return true;

                }else if($valid && $item->estado == "a despacho"){

                    $fe = date("Y-m-d H:i:s", strtotime($valid->despacho));

                    if($fe != $item->fechadespacho){
                        $this->db->set('fechamod',$this->_general->date()->datetime);
                        $this->db->set('fechadespacho',date("Y-m-d H:i:s", strtotime($valid->despacho)));
                        $this->db->set('fechaupdate',$this->_general->date()->datetime);
                        $this->db->where('idExpe = ',$item->idExpe);
                        $this->db->update('expedientes');

                        $movi = array(
                            'codcliente' => $this->_session->data->codcliente,
                            'fecha'      => $this->_general->date()->datetime,
                            'tipo'       => 'Actualización',
                            'info'       => 'Actualizado de Expediente Nro. <b>'.$item->expediente.'</b>, Cliente: <b>'.$item->cliente.'</b>, Portada: <b>'.$item->portada.'</b>, Dependencia: <b>'.$item->juzgado.'</b>'
                        );
                        $this->db->insert('movimientos',$movi);
                        return true;

                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
        }else{
            return false;
        }
    }//


    public function _lineDelete($x){

        $this->db->trans_begin();

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usuario =',$this->_session->data->usuario);
        $u = $this->db->get()->row();

        if(password_verify($x[1],$u->pass)){
            $this->db->select('*');
            $this->db->from('expedientes');
            $this->db->where('idExpe =',$x[0]);
            $q = $this->db->get()->row();

            $this->db->where('idExpe =',$x[0]);
            $this->db->delete('expedientes');

            $movi = array(
                'codcliente' => $this->_session->data->codcliente,
                'fecha'      => $this->_general->date()->datetime,
                'tipo'       => 'Eliminación',
                'info'       => 'Se ha eliminado el Expediente Nro. <b>'.$q->expediente.'</b>, Cliente: <b>'.$q->cliente.'</b>,  Portada: <b>'.$q->portada.'</b>, Dependencia: <b>'.$q->juzgado.'</b>'
            );
            $this->db->insert('movimientos',$movi);


            $this->db->set('expedientes','expedientes - 1',false);
            if($q->estado=="a despacho"){
                $this->db->set('despachados','despachados - 1',false);
            }else{
                $this->db->set('pendientes','pendientes - 1',false);
            }
            $this->db->where('codcliente =',$this->_session->data->codcliente);
            $this->db->update('numeros');


            if($this->db->trans_complete()===TRUE){
                $this->db->trans_commit();
                return true;
            }else{
                $this->db->trans_rollback();
                return false;
            }
        }else{
            return false;
        }
    }//

    public function _getFullData($x){
        $q = $this->db->query("SELECT * FROM expedientes WHERE idExpe = '$x'");

        if($q->num_rows()==1){
            return json_encode($q->row());
        }else{
            return false;
        }

    }//

    public function _editCaseFile($x){
        
        $this->db->trans_begin();

        $valid = $this->juzgados->_getCaseFile(array('expediente'=>$x['expediente'],'juzgado'=>$x['juzgado']));

        $this->db->set('expediente',$x['expediente']);
        $this->db->set('cliente',$x['portada']);
        $this->db->set('portada', ($valid) ? $valid->caratula : '');
        $this->db->set('bis',($x['bis']=="si") ? '1' : '0');
        $this->db->set('bisdata', ($x['bis']=="si") ? $x['bisdata'] : '');
        $this->db->set('basexpe',$x['expediente']);
        $this->db->set('circunscripcion',$x['circunscripcion']);
        $this->db->set('localidad',$x['localidad']);
        $this->db->set('dependencia',$x['juzgado']);
        $this->db->set('saliocon', ($valid) ? $valid->localidad : 'Pendiente');
        $this->db->set('fechamod', $this->_general->date()->datetime );
        $this->db->set('fechaupdate', $this->_general->date()->datetime );
        $this->db->set('observacion',$x['observacion']);
        $this->db->set('estado', ($valid) ? 'a despacho' : 'pendiente despacho');
        $this->db->where('idExpe =',$x['id']);

        $this->db->update('expedientes');

        if($this->db->trans_complete()===TRUE){
            $this->db->trans_commit();
            return true;
        }else{
            $this->db->trans_rollbacK();
            return false;
        }

    }//




}
