<?php
class Order
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }


    public function create($order)
    {
        $this->db->query('INSERT INTO `orders`(`id`, `user_id`, `amount`, `status`) 
        VALUES (:id,:user_id,:amount,:status)');

        // Binding values
        $this->db->bind(':id', $order['id']);
        $this->db->bind(':user_id', $order['user_id']);
        $this->db->bind(':amount', $order['amount']);
        $this->db->bind(':status', $order['status']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function create_order_books($order_books)
    {
        $this->db->query('INSERT INTO `order_books`(`book_id`, `order_id`) VALUES (:book_id,:order_id)');

        // Binding values
        $this->db->bind(':book_id', $order_books['book_id']);
        $this->db->bind(':order_id', $order_books['order_id']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function update($order)
    {
        $this->db->query('UPDATE `orders`SET
        `user_id`= :user_id,
        `amount`= :amount,
        `status`= :status
        WHERE id = :id');
        
        // Binding values
        $this->db->bind(':id', $order['id']);
        $this->db->bind(':user_id', $order['user_id']);
        $this->db->bind(':amount', $order['amount']);
        $this->db->bind(':status', $order['status']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($order_id)
    {
        $this->db->query('DELETE FROM `orders` WHERE id = :id');
        // Binding values
        $this->db->bind(':id', $order_id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function read_by_id($order_id)
    {
        $this->db->query('SELECT * FROM orders WHERE id = :id');
        $this->db->bind(':id', $order_id);

        $row = $this->db->single();

        // check row
        if ($this->db->rowCount() > 0) {
            return $row;
        } else {
            return false;
        }
    }
    public function read_by_user($user_id)
    {
        $this->db->query('SELECT * FROM orders WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);

        return $this->db->resultSet();
    }
    public function read_all()
    {
        $this->db->query('SELECT * FROM orders ORDER BY `created_at` DESC');
        return $this->db->resultSet();
    }
    public function read_last_7_days()
    {
        $this->db->query('SELECT count(created_at) \'Total\', DAY(created_at) \'Day\',created_at FROM `orders` GROUP BY DAY(created_at) ORDER BY created_at ASC LIMIT 7
        ');
        return $this->db->resultSet();
    }
    public function read_month_orders()
    {
        $this->db->query('SELECT * FROM orders WHERE MONTH(CURRENT_TIMESTAMP) = MONTH (created_at)
        ');
        return $this->db->resultSet();
    }


}
