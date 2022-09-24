<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_m extends CI_Model
{
    private $_table = "product";

    public $id;
    public $name;
    public $picture;

    public function rules()
    {
        return [
            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'qty',
            'label' => 'Qty',
            'rules' => 'numeric'],
            
            ['field' => 'pictures',
            'label' => 'Pictures',
            'rules' => 'required']
        ];
    }

    public function getAll()
    {
        $this->db->where('isActive', '1');
        return $this->db->get($this->_table)->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->result();
    }

    public function save($id,$name,$picture,$qty,$expiredAt,$isActive)
    {
        $post = $this->input->post();
        $this->id = $id;
        $this->name = $name;
        $this->qty = $qty;
        $this->picture = $picture;
        $this->expiredAt = $expiredAt;
        $this->isActive = $isActive;
        $save = $this->db->insert($this->_table, $this);
        if($save){
            return true;
        }else{
            return false;
        } 
    }

    public function update($id,$name,$picture,$qty,$expiredAt)
    {
        if($picture){
            $update = [
                'name' => $name,
                'picture' =>$picture,
                'qty' => $qty,
                'expiredAt' => $expiredAt
            ];
        }else{
            $update = [
                'name' => $name,
                'qty' => $qty,
                'expiredAt' => $expiredAt
            ];
        }
       
        $update = $this->db->update($this->_table, $update, array('id' => $id));
        if($update){
            return 1;
        }else{
            return 0;
        }
    }

    public function soft_delete($id){
      
        $update = [
            'isActive' => 0,
        ];
        $delete = $this->db->update($this->_table, $update, array('id' => $id));

        if($delete){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
}