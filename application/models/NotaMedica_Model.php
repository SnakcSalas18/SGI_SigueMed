<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotaMedica_Model
 *
 * @author SigueMed
 */
class NotaMedica_Model extends CI_Model {
    
    //Atributos NotaMedica
    private $table;
    public $IdNotaMedica;
    public $IdPaciente;
    public $FechaNotaMedica;
    public $IdServicio;
            
    /*
     * 
     */
    public function __construct() {
        parent::__construct();
        $this->table = "NotaMedica";
        $this->load->database();

    }
    
    private function LoadRow($row)
    {
        $this->IdPaciente = $row->IdPaciente;
        $this->IdServicio = $row->IdServicio;
        $this->IdNotaMedica = $row->IdNotaMedica;
        $this->FechaNotaMedica = $row->FechaNotaMedica;
        
    }
    
    /*
     * Descripción: Consulta el ultimo ID de la nota medica del paciente por servicio
     * Salida: Devuelve el ultimo ID de la nota medica del paciente
     */
    public function ConsultarUltimaNotaMedicaPorPaciente($IdPaciente, $IdServicio)
    {
        //Query de Consulta
        //SELECT MAX IdNotaMedica FROM NotaMedica WHERE IdPaciente = $IdPaciente AND IdServicio = IdServicio

        $this->db->select_max('IdNotaMedica', 'IdUltimaNotaMedica');
        $this->db->from($this->table);
        $this->db->where('IdPaciente', $IdPaciente);
        $this->db->where('IdServicio', $IdServicio);
        $query = $this->db->get();
        

        if ($query->num_rows() == 1) 
        {
            return $query->row_array();       
        } 
        else 
        {
            return false;
        }
    }
    
    public function ConsultarNotaMedicaPorId($IdNotaMedica)
    {
        $condition = "IdNotaMedica =" . $IdNotaMedica;
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($condition);
        $this->db->limit(1);
        $query = $this->db->get();

        if ($query->num_rows() == 1) 
        {
            $row = $query->row();
            $this->LoadRow($row);
            return $query->row_array();
        } 
        else 
        {
            return false;
        }
        
    }
    
}
