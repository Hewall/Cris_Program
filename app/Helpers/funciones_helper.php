<?php

    // *****************************************************************************
    // **************************** FUNCIONES ESPECIALES ***************************
    // *****************************************************************************

    //Funcion para establecer el horario en México
    date_default_timezone_set("America/Mexico_City");

    // *****************************************************************************
    // *************************** FUNCIONES PRIMORDIALES **************************
    // *****************************************************************************

    // =======================================================
    // Funciones para crear un mensaje y mostrarlo en la vista
    // =======================================================
    function mensaje($texto = "", $tipo = 5, $tiempo = 1000){
        $mensaje = array();
        $mensaje['texto'] = $texto;
        $mensaje['tipo'] = $tipo;
        $mensaje['tiempo'] = $tiempo;
        session()->set('mensaje', $mensaje);
    }//end of function asignar_mensaje

    function fecha_actual(){
        return date('Y-m-d');
    }//end fecha_actual

    function mostrar_mensaje() {
        $html = '';
        $session = session();
        $mensaje = $session->get("mensaje");
        $session->set("mensaje",null);

        if($mensaje == null){
            return "";
        }//end if no existe mensaje

        switch($mensaje['tipo']){
            case 1:
                //Satisfactoriamente
                $tipoMensaje = "success";
                $titulo = "¡Correcto!";
            break;
            case 2:
                //Error
                $tipoMensaje = "danger";
                $titulo = "¡Error!";
            break;
            case 3:
                //Atencion
                $tipoMensaje = "warning";
                $titulo = "¡Atención!";
            break;
            default:
                $tipoMensaje = "info";
                $titulo = "¡Bienvenido!";
            break;
        }//end switch

        $html = '
                $.notify(
                    "<strong>'.$titulo.'</strong> <br>'.$mensaje["texto"].'",
                    {
                        type: "'.$tipoMensaje.'",
                        allow_dismiss: true,
                        timer: '.$mensaje['tiempo'].',
                        showProgressbar: false,
                        placement: {
                            from: "top",
                            align: "center"
                        },
                        animate: {
                            enter: "animated fadeInDown",
                            exit: "animated fadeOutUp"
                        }
                    }
                );
            ';
        return $html;
    }//end mostrar_mensaje

