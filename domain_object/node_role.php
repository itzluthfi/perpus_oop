<?php

class Role {
    public $role_id;
    public $role_nama;
    public $role_deskripsi;
    public $role_status;
    public function __construct($role_id,$role_nama,$role_deskripsi,$role_status)
    {
        $this->role_id = $role_id;
        $this->role_nama = $role_nama;
        $this->role_deskripsi = $role_deskripsi;
        $this->role_status = $role_status;
        
    }

}