<?php

class Usuario_m extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

      public function traerusuarios() {

        $r = $this->db->query("SELECT persona.nombres,persona.apellidos,persona.telefono,persona.correo,persona.direccion,'Trabajador' AS Rol,persona.dni FROM persona
            INNER JOIN trabajador ON persona.dni = trabajador.dni
            where trabajador.estado=1
            UNION
            SELECT persona.nombres,persona.apellidos,persona.telefono,persona.correo,persona.direccion,
            'Cliente' AS Rol,persona.dni
            FROM persona
            INNER JOIN cliente ON cliente.dni = persona.dni
            where cliente.estado=1");
        return $r->result();
    }

  

}

?>