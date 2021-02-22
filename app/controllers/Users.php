<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->user_model = $this->model('User');
        $this->book_model = $this->model('Book');
        $this->category_model = $this->model('Category');

    }

    public function profile()
    {
        if(!get_is_loggedin()){
            redirect('auth/login');
        }
        $data = [
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
        ];

        if (isset($_POST['update_profile'])) {
            $user = $data['user'];
            $user = [
                'id' => $user->id,
                'fullname' => $_POST['firstname'] . ' ' . $_POST['lastname'],
                'image' => $user->image,
                'descritption' => $user->descritpion,
                'type' => $user->type,
                'password' => $user->password,
            ];

            if ($_FILES['user_image']['size'] != 0) {
                $file = [
                    'file' => $_FILES['user_image'],
                    'target_folder' => 'img/users/',
                ];
                $file_name = upload_file($file);
            }

            if ($file_name) {
                $user['image'] = $file_name;
            }
            if ($this->user_model->update($user)) {
                show_alert(true, 'تم تحديث حسابك', 'success', 'ri-information-line');
                redirect('users/profile');
            } else {
                show_alert(true, 'لم يتم تحديث حسابك! ', 'danger');
                redirect('users/profile');
            }
        }
        if (isset($_POST['update_password'])) {
            $user = $data['user'];
            $user = [
                'id' => $user->id,
                'fullname' => $user->fullname,
                'image' => $user->image,
                'descritption' => $user->descritpion,
                'type' => $user->type,
                'password' => $user->password,
            ];

            if (password_verify($_POST['current_password'], $user['password'])) {
                if ($_POST['new_password'] == $_POST['confirm_password']) {
                    if ($this->user_model->update($user)) {
                        show_alert(true, 'تم تحديث حسابك', 'success', 'ri-information-line');
                        redirect('users/profile&pwd=0');
                    } else {
                        show_alert(true, 'لم يتم تحديث حسابك! ', 'danger');
                        redirect('users/profile&pwd=0');
                    }
                } else {
                    show_alert(true, 'كلمات السر لا تتطابق! ', 'danger');
                    redirect('users/profile&pwd=0');
                }
            } else {
                show_alert(true, 'كلمات السر الحالية غير صحيحة! ', 'danger');
                redirect('users/profile&pwd=0');
            }
        }

        $this->view('users/user_profile_edit', $data);
    }

    public function library($book_id = null)
    {
        if(!get_is_loggedin()){
            redirect('auth/login');
        }
        $data = [
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
            'user_books' => $this->book_model->read_by_user_id(get_current_user_id()),
            'categories' => $this->category_model->read_all(),
            'book' => null,
            'authors' => $this->user_model->read_by_type(AUTHOR),
        ];

        if (isset($_GET['category']) || isset($_GET['author']) || isset($_GET['keyword'])) {
            $category_id = isset($_GET['category']) ? $_GET['category'] : '';
            $author_id = isset($_GET['author']) ? $_GET['author'] : '';
            $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
            $seachData = [
                'user_id' => get_current_user_id(),
                'category_id' => $category_id,
                'author_id' => $author_id,
                'keyword' => $keyword,
            ];
            $data['user_books'] = $this->book_model->search_user_books($seachData);
        }

        foreach ($data['user_books'] as $book) {
            $book->details = $this->book_model->read_by_id($book->book_id);
        }

        if (isset($book_id)) {
            if ($this->is_user_have_book($book_id)) {
                $data['book'] = $this->book_model->read_by_id($book_id);
            }else {
                redirect('users/library');
            }

            $this->view('users/read_book_page', $data);
        } else {
            $this->view('users/library', $data);
        }

    }
    public function is_user_have_book($book_id)
    {
        return sizeof($this->book_model->read_user_books_by_book_id($book_id, get_current_user_id())) > 0;

    }
    public function favorite()
    {
        $data = [
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
            'user_favorite' => $this->book_model->read_favorite_by_user_id(get_current_user_id()),
            'categories' => $this->category_model->read_all(),
            'authors' => $this->user_model->read_by_type(AUTHOR),
        ];

        foreach ($data['user_favorite'] as $book) {
            $book->details = $this->book_model->read_by_id($book->book_id);
        }

        if (isset($_POST['delete_favorite'])) {
            if ($this->book_model->delete_user_favorit_by_id($_POST['user_favorite_id'])) {
                show_alert(true, 'تم حذف الكتاب من المفضلة', 'success', 'ri-information-line');
                redirect('users/favorite');
            } else {

                show_alert(true, 'لم يتم حذف الكتاب! ', 'danger');
                redirect('users/profile');
            }
        }

        if (isset($_POST['add_favorite'])) {

            if(!get_is_loggedin()){
                die('Must Logged In');
            }
            $favorite = [
                'user_id' => get_current_user_id(),
                'book_id' => $_POST['book_id'],
            ];
            die(json_encode($this->handleFavorite($favorite)));
        }

        $this->view('users/favorite', $data);
    }

    public function handleFavorite($favorite)
    {
        $response = [
            'code' => 400,
            'messsage' => 'Error',
        ];
        $row = $this->book_model->read_favorite_by_user_id_and_book_id($favorite);
        if ($row) {
            // remove from favorite
            if ($this->book_model->delete_user_favorit_by_id($row->id)) {
                $response = [
                    'code' => 204,
                    'messsage' => 'Success! favorite removed',
                ];
            } else {
                $response = [
                    'code' => 400,
                    'messsage' => 'Success',
                ];
            }
        } else {
            // add favorite
            if ($this->book_model->create_user_favorite($favorite)) {
                $response = [
                    'code' => 200,
                    'messsage' => 'Success! favorite created',
                ];
            } else {
                $response = [
                    'code' => 400,
                    'messsage' => 'Success',
                ];
            }
        }

        return $response;
    }

}
