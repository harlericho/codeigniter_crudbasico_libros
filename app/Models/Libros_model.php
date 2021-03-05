<?php

namespace App\Models;

use CodeIgniter\Model;

class Libros_model extends Model
{
    /*
    protected $table = 'libros';
    protected $primarykey = 'id';
    protected $allowedFiels = ['nombres', 'descripcion'];
    */
    //------------------------Query Builder-----------------------------
    //* listar
    public function getTest()
    {
        $data = $this->db->query("call procedure_libros");
        return $data->getResult();
    }
    //* crear
    public function entries($array)
    {
        $data = $this->db->table('libros');
        return $data->insert($array);
    }
    //* obtener los datos
    public function getTestID($id)
    {
        $data = $this->db->table('libros');
        $data->where('id', $id);
        return $data->get()->getRow();
    }
    //? actualizar
    public function entries_update($array)
    {
        $data = $this->db->table('libros');
        $data->set($array);
        $data->where('id', $array['id']);
        return $data->update();
    }
    //! eliminar
    public function destroy($array)
    {
        $data = $this->db->table('libros');
        $data->set($array);
        $data->where('id', $array['id']);
        return $data->update();
        //* codigo para borrar registro
        /*
        $data = $this->db->table('libros');
        $data->where($id);
        return $data->delete();
        */
    }
}
