<?php
class Admin extends Controller
{
    public function __construct()
    {
        $this->user_model = $this->model('User');
        $this->category_model = $this->model('Category');
        $this->book_model = $this->model('Book');
        $this->order_model = $this->model('Order');
        $this->site_model = $this->model('Site');

    }

    public function index()
    {
        $data = [
            'title' => 'dashboard',
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
            'users_count' => count($this->user_model->read_all()),
            'books_count' => count($this->book_model->read_all()),
            'sales' => 0,
            'orders_count' => 0,
            'last_seven' => null,
            'goals' => $this->site_model->read_by_id(1),
            'month_orders' => $this->order_model->read_month_orders(),
            'month_total_sales' => 0,
            'month_new_users' => $this->user_model->read_month_users(),
        ];

        $total_sales = 0;
        $orders = $this->order_model->read_all();
        foreach ($orders as $order) {
            $total_sales += $order->amount;
        }

        $total_month_sales = 0;
        foreach ($data['month_orders'] as $order) {
            $total_month_sales += $order->amount;
        }

        $data['month_total_sales'] = $total_month_sales;
        $data['sales'] = $total_sales;
        $data['orders_count'] = sizeof($orders);
        $last7 = $this->order_model->read_last_7_days();
        $data['last_seven'] = $last7;

        if (isset($_POST['changeGoals'])) {
            $site = $this->site_model->read_by_id(1);
            if (!$site) {

                $newSite = [
                    'sales_goal' => $_POST['sales_goal'],
                    'orders_goal' => $_POST['orders_goal'],
                    'users_goal' => $_POST['users_goal'],
                ];

                $this->site_model->create($newSite);
                redirect('admin');
            } else {
                $newSite = [
                    'id' => $site->id,
                    'sales_goal' => $_POST['sales_goal'],
                    'orders_goal' => $_POST['orders_goal'],
                    'users_goal' => $_POST['users_goal'],
                ];
                $this->site_model->update($newSite);
                redirect('admin');
            }
        }
        $this->view('admin/pages/dashboard', $data);
    }

    public function book($book_id = null)
    {

        $data = [
            'title' => 'books',
            'books' => [],
            'book' => null,
            'categories' => $this->category_model->read_all(),
            'authors' => $this->user_model->read_by_type(AUTHOR),
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
        ];

        if (isset($_POST['add_book'])) {

            $book = [
                'id' => gen_uuid(),
                'name' => $_POST['name'],
                'image' => '',
                'category_id' => $_POST['category_id'],
                'author_id' => $_POST['author_id'],
                'price' => $_POST['price'],
                'promo_price' => $_POST['promo_price'],
                'book_file' => '',
                'description' => $_POST['description'],
            ];

            $file = [
                'file' => $_FILES['book_file'],
                'target_folder' => 'books/',
            ];
            $file_name = upload_file($file);

            $image = [
                'file' => $_FILES['book_image'],
                'target_folder' => 'img/book/',
            ];
            $image_name = upload_file($image);

            if ($file_name && $image_name) {

                $book['book_file'] = $file_name;
                $book['image'] = $image_name;

                if ($this->book_model->create($book)) {
                    show_alert(true, 'تم اضافة كتاب جديد بنجاح', 'success', 'ri-information-line');
                    redirect('admin/book/all');
                } else {
                    show_alert(true, ' can\'t create the book', 'danger');
                    redirect('admin/book');
                }
            } else {
                show_alert(true, 'can\'t upload the file ', 'danger');
                redirect('admin/book');
            }

        }

        if (isset($_POST['update_book'])) {
            if (isset($book_id)) {
                $book = $this->book_model->read_by_id($book_id);

                if ($book) {

                    $new_book = [
                        'id' => $book_id,
                        'name' => $_POST['name'],
                        'image' => $book->image,
                        'category_id' => $_POST['category_id'],
                        'author_id' => $_POST['author_id'],
                        'price' => $_POST['price'],
                        'promo_price' => $_POST['promo_price'],
                        'book_file' => $book->book_file,
                        'description' => $_POST['description'],
                    ];

                    if ($_FILES['book_image']['size'] != 0) {
                        $file = [
                            'file' => $_FILES['book_image'],
                            'target_folder' => 'img/book/',
                        ];
                        $file_name = upload_file($file);

                        if ($file_name) {

                            $new_book['image'] = $file_name;

                        } else {
                            echo 'IMAGE NOT UPDATED!';
                        }
                    }

                    if ($_FILES['book_file']['size'] != 0) {
                        $file = [
                            'file' => $_FILES['book_file'],
                            'target_folder' => 'books/',
                        ];
                        $file_name = upload_file($file);

                        if ($file_name) {

                            $new_book['book_file'] = $file_name;

                        } else {
                            echo 'FILE NOT UPDATED!';
                        }
                    }

                    if ($this->book_model->update($new_book)) {
                        show_alert(true, 'تم تحديث الكتاب بنجاح', 'success', 'ri-information-line');
                        redirect('admin/book/' . $book_id);
                    }
                } else {
                    die('NO BOOK FOUND!');
                }
            }
        }

        if (isset($_POST['delete_book'])) {

            if (isset($_POST['book_id'])) {

                if ($this->book_model->delete($_POST['book_id'])) {

                    show_alert(true, 'تم حذف الكتاب بنجاح', 'success', 'ri-information-line');
                    redirect('admin/book/all');
                } else {
                    show_alert(true, 'خطأ ', 'danger');
                    redirect('admin/book/all');
                }
            } else {
                show_alert(true, 'خطأ ', 'danger');
            }

        }

        if (isset($book_id)) {

            if ($book_id == 'all') {
                $data['books'] = $this->book_model->read_all();
                $this->view('admin/book/view_all_books', $data);
            } else {
                $book = $this->book_model->read_by_id($book_id);
                $data['book'] = $this->book_model->read_by_id($book_id);
                if ($book) {
                    $this->view('admin/book/update_book', $data);
                }
            }
        } else {
            $this->view('admin/book/add_book', $data);
        }

    }
    public function author($author_id = null)
    {

        $data = [
            'title' => 'authors',
            'authors' => [],
            'author' => [],
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
        ];

        if (isset($_POST['add_author'])) {

            $author = [
                'id' => gen_uuid(),
                'fullname' => $_POST['name'],
                'email' => (isset($_POST['email']) ? $_POST['email'] : '_'),
                'image' => '',
                'type' => 'author',
                'password' => '_',
                'description' => $_POST['description'],
            ];

            $file = [
                'file' => $_FILES['author_image'],
                'target_folder' => 'img/author/',
            ];
            $file_name = upload_file($file);

            if ($file_name) {
                $author['image'] = $file_name;

                if ($this->user_model->create($author)) {
                    show_alert(true, 'تم اضافة مؤلف جديد', 'success', 'ri-information-line');
                    redirect('admin/author');
                } else {
                    show_alert(true, 'خطأ ', 'danger');
                    redirect('admin/author');
                }
            } else {
                show_alert(true, 'خطأ ', 'danger');
                redirect('admin/author');
            }
        }

        if (isset($_POST['delete_author'])) {

            if (isset($_POST['author_id'])) {

                if ($this->user_model->delete($_POST['author_id'])) {
                    show_alert(true, 'تم حذف المؤلف بنجاح', 'success', 'ri-information-line');
                    redirect('admin/author/all');
                } else {
                    show_alert(true, 'خطأ ', 'danger');
                    redirect('admin/author/all');
                }
            } else {
                show_alert(true, 'خطأ ', 'danger');
                redirect('admin/author/all');
            }

        }

        if (isset($_POST['update_author'])) {

            if (isset($author_id)) {
                $author_from_db = $this->user_model->read_by_id($author_id);

                if ($author_from_db) {

                    $author = [
                        'id' => $author_id,
                        'fullname' => $_POST['name'],
                        'password' => $author_from_db->password,
                        'reset_password' => $author_from_db->reset_password,
                        'image' => $author_from_db->image,
                        'description' => $_POST['description'],
                        'type' => $author_from_db->type,
                    ];

                    if (isset($_FILES['author_image']['name'])) {

                        $file = [
                            'file' => $_FILES['author_image'],
                            'target_folder' => 'img/author/',
                        ];

                        $file_name = upload_file($file);
                        if ($file_name) {

                            $author['image'] = $file_name;

                        } else {
                            echo 'IMAGE NOT UPDATED!';
                        }
                    }

                    if ($this->user_model->update($author)) {
                        show_alert(true, 'تم تحديث فئة بنجاح', 'success', 'ri-information-line');
                        redirect('admin/author/' . $author_id);
                    }
                }
            }
        }

        if (isset($author_id)) {

            if ($author_id == 'all') {

                $data['authors'] = $this->user_model->read_by_type(AUTHOR);
                // die(var_dump($data));
                $this->view('admin/author/view_all_authors', $data);

            } else {

                $author = $this->user_model->read_by_id($author_id);

                if ($author) {
                    $data['author'] = $author;
                    $this->view('admin/author/update_author', $data);
                } else {
                    redirect('admin/author');
                }
            }

        } else {
            $this->view('admin/author/add_author', $data);
        }

    }

    public function category($category_id = null)
    {
        $data = [
            'title' => 'categories',
            'categories' => null,
            'category' => null,
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
        ];

        if (isset($_POST['add_category'])) {

            $category = [
                "id" => gen_uuid(),
                "name" => $_POST['name'],
                "image" => '',
                "description" => $_POST['description'],
            ];

            $file = [
                'file' => $_FILES['category_image'],
                'target_folder' => 'img/category/',
            ];
            $file_name = upload_file($file);

            if ($file_name) {
                $category['image'] = $file_name;
                if ($this->category_model->create($category)) {
                    show_alert(true, 'تم اضافة فئة جديدة بنجاح', 'success', 'ri-information-line');
                    redirect('admin/category');
                } else {
                    show_alert(true, 'خطأ ', 'danger');
                    redirect('admin/category');
                }
            } else {
                show_alert(true, 'خطأ ', 'danger');
                redirect('admin/category');
            }

        }

        if (isset($_POST['update_category'])) {
            if (isset($category_id)) {
                $category = $this->category_model->read_by_id($category_id);

                if ($category) {
                    $cat = [
                        'id' => $category_id,
                        'name' => $_POST['name'],
                        'description' => $_POST['description'],
                        'image' => $category->image,
                    ];

                    if (isset($_FILES['category_image']['name'])) {
                        $file = [
                            'file' => $_FILES['category_image'],
                            'target_folder' => 'img/category/',
                        ];
                        $file_name = upload_file($file);

                        if ($file_name) {

                            $cat['image'] = $file_name;

                        } else {
                            echo 'IMAGE NOT UPDATED!';
                        }
                    }

                    if ($this->category_model->update($cat)) {
                        show_alert(true, 'تم تحديث فئة بنجاح', 'success', 'ri-information-line');
                        redirect('admin/category/' . $category_id);
                    }
                } else {
                    die('NO CATEGORY FOUND!');
                }
            }
        }

        if (isset($_POST['delete_category'])) {

            if (isset($_POST['category_id'])) {

                if ($this->category_model->delete($_POST['category_id'])) {

                    show_alert(true, 'تم حذف فئة بنجاح', 'success', 'ri-information-line');
                    redirect('admin/category/all');
                } else {
                    show_alert(true, 'خطأ ', 'danger');
                    redirect('admin/category/all');
                }
            } else {
                show_alert(true, 'خطأ ', 'danger');
                redirect('admin/category/all');
            }

        }

        if (isset($category_id)) {

            if ($category_id == 'all') {

                $data['categories'] = $this->category_model->read_all();
                $this->view('admin/category/view_all_categories', $data);

            } else {

                $category = $this->category_model->read_by_id($category_id);

                if ($category) {
                    $data['category'] = $category;
                    $this->view('admin/category/update_category', $data);
                } else {
                    redirect('admin/category');
                }
            }

        } else {
            $this->view('admin/category/add_category', $data);
        }

    }
}
