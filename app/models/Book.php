<?php
class Book
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function create($book)
    {
        $this->db->query('INSERT INTO `books`
        (`id`, `name`, `category_id`, `author_id`, `promo_price`,`price`,`image`,`book_file`,`description`) VALUES (:id, :name, :category_id, :author_id,:promo_price,:price,:image,:book_file,:description)');

        // Binding values
        $this->db->bind(':id', $book['id']);
        $this->db->bind(':name', $book['name']);
        $this->db->bind(':category_id', $book['category_id']);
        $this->db->bind(':author_id', $book['author_id']);
        $this->db->bind(':promo_price', $book['promo_price']);
        $this->db->bind(':price', $book['price']);
        $this->db->bind(':image', $book['image']);
        $this->db->bind(':book_file', $book['book_file']);
        $this->db->bind(':description', $book['description']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function create_user_favorite($favorite)
    {
        $this->db->query('INSERT INTO `user_favorite_books`(`user_id`, `book_id`) 
        VALUES (:user_id,:book_id)');

        // Binding values
        $this->db->bind(':user_id', $favorite['user_id']);
        $this->db->bind(':book_id', $favorite['book_id']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function create_user_books($user_books)
    {
        $this->db->query('INSERT INTO `user_books`(`book_id`, `user_id`) 
        VALUES (:book_id,:user_id)');

        // Binding values
        $this->db->bind(':user_id', $user_books['user_id']);
        $this->db->bind(':book_id', $user_books['book_id']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function update($book)
    {
        $this->db->query('UPDATE `books` SET 
        `name`= :name,
        `category_id`= :category_id,
        `author_id`= :author_id,
        `promo_price`= :promo_price,
        `price`= :price,
        `image`= :image,
        `book_file`= :book_file,
        `description`= :description
         WHERE `id` = :id');
        
        // Binding values
        $this->db->bind(':id', $book['id']);
        $this->db->bind(':name', $book['name']);
        $this->db->bind(':category_id', $book['category_id']);
        $this->db->bind(':author_id', $book['author_id']);
        $this->db->bind(':promo_price', $book['promo_price']);
        $this->db->bind(':price', $book['price']);
        $this->db->bind(':image', $book['image']);
        $this->db->bind(':book_file', $book['book_file']);
        $this->db->bind(':description', $book['description']);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delete($book_id)
    {
        $this->db->query('DELETE FROM `books` WHERE id = :id');
        // Binding values
        $this->db->bind(':id', $book_id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function delete_user_favorit_by_id($user_favorite_id)
    {
        $this->db->query('DELETE FROM `user_favorite_books` WHERE id = :id');
        // Binding values
        $this->db->bind(':id', $user_favorite_id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read_by_id($id)
    {
        $this->db->query('SELECT * FROM books WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    public function read_by_name($name)
    {
        $this->db->query('SELECT * FROM books WHERE name = :name');
        $this->db->bind(':name', $name);
        return $this->db->single();
    }
    public function search_user_books($searchData)
    {
        $this->db->query('SELECT * FROM `user_books` 
                          INNER JOIN `books`
                          WHERE user_books.book_id = books.id 
                          AND books.name LIKE :keyword 
                          AND books.category_id LIKE :category_id 
                          AND books.author_id LIKE :author_id
                          AND user_books.user_id = :user_id');

        $this->db->bind(':keyword', '%'.$searchData['keyword'].'%');
        $this->db->bind(':category_id', '%'.$searchData['category_id'].'%');
        $this->db->bind(':author_id', '%'.$searchData['author_id'].'%');
        $this->db->bind(':user_id', $searchData['user_id']);
        return $this->db->resultSet();
    }
    public function search_books($searchData){
        
        $this->db->query('SELECT * FROM `books`
                          WHERE books.name LIKE :keyword 
                          AND books.category_id LIKE :category_id 
                          AND books.author_id LIKE :author_id
                          LIMIT :limit');

        $this->db->bind(':keyword', '%'.$searchData['keyword'].'%');
        $this->db->bind(':category_id', $searchData['category_id'] == '' ? '%%' : $searchData['category_id']);
        $this->db->bind(':author_id', $searchData['author_id'] == '' ? '%%' : $searchData['author_id']);
        $this->db->bind(':limit', $searchData['limit']);
        return $this->db->resultSet();
    }
    public function read_by_user_id($user_id)
    {
        $this->db->query('SELECT * FROM `user_books` WHERE `user_id` = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }
    public function read_user_books_by_book_id($book_id,$user_id)
    {
        $this->db->query('SELECT * FROM `user_books` WHERE `book_id` = :book_id AND `user_id` = :user_id');
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':book_id', $book_id);
        return $this->db->resultSet();
    }
    public function read_favorite_by_user_id($user_id)
    {
        $this->db->query('SELECT * FROM `user_favorite_books` WHERE `user_id` = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->resultSet();
    }
    public function read_favorite_by_user_id_and_book_id($favorite)
    {
        $this->db->query('SELECT * FROM `user_favorite_books` WHERE `user_id` = :user_id AND `book_id` = :book_id');
        $this->db->bind(':user_id', $favorite['user_id']);
        $this->db->bind(':book_id', $favorite['book_id']);
        return $this->db->single();
    }
    public function read_all()
    {
        $this->db->query('SELECT * FROM books ORDER BY `created_at`');
        return $this->db->resultSet();
    }
    public function read_last_added($limit)
    {
        $this->db->query('SELECT * FROM `books` ORDER BY `created_at` DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
    public function read_rand($limit = 10)
    {
        $this->db->query('SELECT * FROM `books` ORDER BY RAND() DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }
    public function read_discount($limit = 10)
    {
        $this->db->query('SELECT *,(promo_price - price) \'discount\' FROM `books` ORDER BY discount DESC LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

}
