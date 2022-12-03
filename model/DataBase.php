<?php
class Database
{
   //metodo que recebe o array de usuarios
   //na vida real, esse select seria em um banco de dados
    public function select($limit) : array
    {
        try {
            //json_decode — Decodifica uma string JSON
           $users= json_decode(file_get_contents(DATABASE_FILE), true);
           //slice para retornar apenas o solicitado
           $users = array_slice($users, 0, $limit);
           return $users;
           
        } catch(Exception $e) {
            throw New Exception( $e->getMessage() );
        }
        return false;
    }
}