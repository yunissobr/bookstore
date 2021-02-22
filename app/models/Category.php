<?php
class Category
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function create($category)
    {
        $this->db->query('INSERT INTO `categories`(`id`, `name`, `image`, `description`) VALUES (:id, :name, :image, :description)');

        // Binding values
        $this->db->bind(':id', $category['id']);
        $this->db->bind(':name', $category['name']);
        $this->db->bind(':image', $category['image']);
        $this->db->bind(':description', $category['description']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function update($category)
    {
        $this->db->query('UPDATE `categories` SET `name`= :name,`image`= :image,`description`= :description WHERE `id` = :id');
        
        // Binding values
        $this->db->bind(':id', $category['id']);
        $this->db->bind(':name', $category['name']);
        $this->db->bind(':image', $category['image']);
        $this->db->bind(':description', $category['description']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($category_id)
    {
        $this->db->query('DELETE FROM `categories` WHERE id = :id');
        // Binding values
        $this->db->bind(':id', $category_id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read_by_id($id)
    {
        $this->db->query('SELECT * FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function read_by_name($name)
    {
        $this->db->query('SELECT * FROM categories WHERE name = :name');
        $this->db->bind(':name', $name);
        return $this->db->single();
    }
    public function read_all()
    {
        $this->db->query('SELECT * FROM categories ORDER BY `created_at`');
        return $this->db->resultSet();
    }

}
