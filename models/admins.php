<?php
// models/admins.php

require_once("base.php");

class Admins extends Base
{
    public function login($data) {
        
        $query = $this->db->prepare("
            SELECT admin_id, password
            FROM admins
            WHERE email = ?
        ");
        
        $query->execute([
            $data["email"]
        ]);
        
        $admin = $query->fetch();

        if(empty($admin) || !password_verify($data["password"], $admin["password"]) ) {
            return null;
        }
        
        return $admin; // admin_id and password
    }
}
