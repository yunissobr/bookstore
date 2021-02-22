<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function create($user)
    {
        $this->db->query('INSERT INTO `users`(`id`, `fullname`, `email`, `password`,`image`,`description`, `type`) VALUES (:id,:fullname,:email,:password,:image,:description,:type)');

        // Binding values
        $this->db->bind(':id', $user['id']);
        $this->db->bind(':fullname', $user['fullname']);
        $this->db->bind(':email', $user['email']);
        $this->db->bind(':password', $user['password']);
        $this->db->bind(':image', $user['image']);
        $this->db->bind(':description', $user['description']);
        $this->db->bind(':type', $user['type']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function update($user)
    {
        $this->db->query('UPDATE `users`SET
        `fullname`= :fullname,
        `image`= :image,
        `description`= :description,
        `type`= :type,
        `password`= :password
        WHERE id = :id');
        
        // Binding values
        $this->db->bind(':id', $user['id']);
        $this->db->bind(':fullname', $user['fullname']);
        $this->db->bind(':image', $user['image']);
        $this->db->bind(':description', $user['description']);
        $this->db->bind(':type', $user['type']);
        $this->db->bind(':password', $user['password']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($user_id)
    {
        $this->db->query('DELETE FROM `users` WHERE id = :id');
        // Binding values
        $this->db->bind(':id', $user_id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    

    public function read_by_email($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }


    public function read_by_reset_password($reset_password)
    {
        $this->db->query('SELECT * FROM users WHERE reset_password = :reset_password');
        $this->db->bind(':reset_password', $reset_password);

        $row = $this->db->single();

        // check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
   

    public function read_by_id($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function read_by_name($fullname)
    {
        $this->db->query('SELECT * FROM users WHERE fullname = :fullname');
        $this->db->bind(':fullname', $fullname);
        return $this->db->single();
    }
    public function read_top($limit = 10)
    {
        $this->db->query('SELECT users.id,users.fullname,users.image,COUNT(books.author_id) \'total_books\' FROM `users` INNER JOIN books WHERE users.id = books.author_id GROUP BY books.author_id ORDER BY total_books DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
    public function read_by_type($type)
    {
        $this->db->query('SELECT * FROM users WHERE type = :type');
        $this->db->bind(':type', $type);
        return $this->db->resultSet();
    }
    public function read_all()
    {
        $this->db->query('SELECT * FROM users ');
        return $this->db->resultSet();
    }

    public function read_month_users()
    {
        $this->db->query('SELECT * FROM users WHERE MONTH(CURRENT_TIMESTAMP) = MONTH (created_at)
        ');
        return $this->db->resultSet();
    }
    

    public function update_reset_password($user)
    {
        $this->db->query('UPDATE `users` SET `reset_password`= :reset_password WHERE email = :email');
        
        // Binding values
        $this->db->bind(':reset_password', $user['reset_password']);
        $this->db->bind(':email', $user['email']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

    }

}
