<?php
class Site
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function create($site)
    {
        $this->db->query('INSERT INTO `site_settings`(`sales_goal`, `orders_goal`, `users_goal`) VALUES (:sales_goal,:orders_goal,:users_goal)');

        // Binding values
        $this->db->bind(':sales_goal', $site['sales_goal']);
        $this->db->bind(':orders_goal', $site['orders_goal']);
        $this->db->bind(':users_goal', $site['users_goal']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function update($site)
    {
        $this->db->query('UPDATE `site_settings`
        SET `id`= :id,
        `sales_goal`= :sales_goal,
        `orders_goal`=:orders_goal,
        `users_goal`= :users_goal
        WHERE id = :id');
        
        // Binding values
        $this->db->bind(':id', $site['id']);
        $this->db->bind(':sales_goal', $site['sales_goal']);
        $this->db->bind(':orders_goal', $site['orders_goal']);
        $this->db->bind(':users_goal', $site['users_goal']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM `site_settings` WHERE id = :id');
        // Binding values
        $this->db->bind(':id', $id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function read_by_id($id)
    {
        $this->db->query('SELECT * FROM site_settings WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        // check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
   
    public function read_all()
    {
        $this->db->query('SELECT * FROM site_settings ORDER BY `created_at` DESC');
        return $this->db->resultSet();
    }


}
