<?php
class Pages extends Controller
{
    public function __construct()
    {
        $this->user_model = $this->model('User');
        $this->book_model = $this->model('Book');
        $this->category_model = $this->model('Category');
        $this->order_model = $this->model('Order');

    }

    public function index()
    {
        $top8 = 8;
        $new_releases = $this->book_model->read_last_added(8);
        $browse = $this->book_model->read_rand(12);
        $best_authors = $this->user_model->read_top($top8);
        $top_discount = $this->book_model->read_discount();

        $data = [
            'title' => 'Welcome',
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
            'new_releases' => $new_releases,
            'browse' => $browse,
            'featured_book' => $this->book_model->read_rand(1)[0],
            'best_authors' => $best_authors,
            'top_discount' => $top_discount,
            'user_lib' => get_is_loggedin() ? $this->book_model->read_by_user_id(get_current_user_id()) : null,
        ];
        
        if ($data['user_lib']) {
            foreach ($data['user_lib'] as $book) {
                $book->details = $this->book_model->read_by_id($book->book_id);
            }
        }

        $this->view('pages/index', $data);
    }

    public function book($book_id = null)
    {

        $data = [
            'title' => 'Book Page',
            'book' => null,
            'top_discount' => $this->book_model->read_discount(),
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
            'related' => '',
        ];
        if (isset($book_id)) {
            $book = $this->book_model->read_by_id($book_id);
            if ($book) {
                $data['book'] = $book;
                $seachData = [
                    'category_id' => $book->category_id,
                    'author_id' => '',
                    'keyword' => '',
                    'limit' => 12,
                ];
                $data['related'] = $this->book_model->search_books($seachData);
            } else {
                redirect('p_404');
            }
        } else {
            redirect('');
        }

        $this->view('pages/book_page', $data);
    }
    public function checkout()
    {
        $data = [
            'title' => 'Checkout',
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
        ];

        if (isset($_POST['confirm'])) {
            $response = [
                'errors' => 0,
                'message' => '',

            ];
            $cart = $_POST['cart'];
            $amount = 0;
            foreach ($cart as $cartItem) {
                $amount += doubleval($cartItem['price']);

            }
            $order = [
                'id' => rand(),
                'user_id' => get_current_user_id(),
                'amount' => $amount,
                'status' => STATUS_PAIED,
            ];

            if ($this->order_model->create($order)) {

                foreach ($cart as $cartItem) {

                    $order_books = [
                        'book_id' => $cartItem['id'],
                        'order_id' => $order['id'],
                    ];
                    if (!$this->order_model->create_order_books($order_books)) {
                        $response['errors'] += 1;
                    }

                }

                if ($response['errors'] < 1) {

                    foreach ($cart as $cartItem) {

                        $user_books = [
                            'user_id' => get_current_user_id(),
                            'book_id' => $cartItem['id'],
                        ];
                        if (!$this->book_model->create_user_books($user_books)) {
                            $response['errors'] += 1;
                        }

                    }

                    if ($response['errors'] < 1) {
                        $response['message'] = 'Your order has been placed successfully';
                    }
                } else {
                    $response['message'] = 'failed adding books to the order';
                }
            } else {
                $response['message'] = 'Failed creating the order';
            }

            die(json_encode($response));
        }

        $this->view('pages/checkout', $data);
    }

    public function search()
    {
        $browse = $this->book_model->read_rand(12);
        $data = [
            'user' => get_is_loggedin() ? $this->user_model->read_by_id(get_current_user_id()) : null,
            'default_books' => $browse,
            'categories' => $this->category_model->read_all(),
            'authors' => $this->user_model->read_by_type(AUTHOR),
        ];

        if (isset($_POST['search'])) {

            if (isset($_POST['category_id']) || isset($_POST['author_id']) || isset($_POST['keyword'])) {
                $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
                $author_id = isset($_POST['author_id']) ? $_POST['author_id'] : '';
                $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
                $seachData = [
                    'category_id' => $category_id,
                    'author_id' => $author_id,
                    'keyword' => $keyword,
                    'limit' => 12,
                ];
                $data['books'] = $this->book_model->search_books($seachData);
                echo ($this->build_books_html_container($data['books']));
                die();
            }
        }
        $this->view('pages/search', $data);
    }

    public function build_books_html_container($books)
    {

        if (empty($books)) {
            return '<div class="no-book-container"> <div class="img-empty-icon"> <svg xmlns="http://www.w3.org/2000/svg" width="117px"  viewBox="0 0 480.012 480"> <g id="book" transform="translate(0 -0.004)"> <path id="Path_1" data-name="Path 1" d="M128,104V72a8,8,0,0,0-8-8H8a8,8,0,0,0-8,8v32Zm0,0" fill="#b7c5d2"/> <path id="Path_2" data-name="Path 2" d="M0,120V384H128V120ZM96,224H32a8,8,0,0,1-8-8V152a8,8,0,0,1,8-8H96a8,8,0,0,1,8,8v64A8,8,0,0,1,96,224Zm0,0" fill="#b7c5d2"/> <path id="Path_3" data-name="Path 3" d="M0,432v40a8,8,0,0,0,8,8H120a8,8,0,0,0,8-8V432Zm0,0" fill="#b7c5d2"/> <path id="Path_4" data-name="Path 4" d="M0,400H128v16H0Zm0,0" fill="#b7c5d2"/> <path id="Path_5" data-name="Path 5" d="M144,400H248v16H144Zm0,0" fill="#b7c5d2"/> <path id="Path_6" data-name="Path 6" d="M248,32V8a8,8,0,0,0-8-8H152a8,8,0,0,0-8,8V32Zm0,0" fill="#b7c5d2"/> <path id="Path_7" data-name="Path 7" d="M144,88H248V384H144Zm0,0" fill="#b7c5d2"/> <path id="Path_8" data-name="Path 8" d="M144,432v40a8,8,0,0,0,8,8h88a8,8,0,0,0,8-8V432Zm0,0" fill="#b7c5d2"/> <path id="Path_9" data-name="Path 9" d="M144,48H248V72H144Zm0,0" fill="#b7c5d2"/> <path id="Path_10" data-name="Path 10" d="M263.809,165.668,268.09,182.1l135.484-36.129-4.285-16.434Zm0,0" fill="#b7c5d2"/> <path id="Path_11" data-name="Path 11" d="M330.664,421.949l135.48-36.129-8.578-32.887L322.078,389.063Zm0,0" fill="#b7c5d2"/> <path id="Path_12" data-name="Path 12" d="M453.527,337.453l-45.91-176L272.129,197.582l45.91,176Zm0,0" fill="#b7c5d2"/> <path id="Path_13" data-name="Path 13" d="M259.77,150.188l135.477-36.125L383.762,70a8.181,8.181,0,0,0-9.84-5.758l-120,32A8.059,8.059,0,0,0,248.238,106Zm0,0" fill="#b7c5d2"/> <path id="Path_14" data-name="Path 14" d="M470.184,401.3,334.7,437.43,344.238,474A8.026,8.026,0,0,0,348,478.887,7.725,7.725,0,0,0,352,480a9.292,9.292,0,0,0,2.078-.238l120-32A8.063,8.063,0,0,0,479.762,438Zm0,0" fill="#b7c5d2"/> </g> </svg> </div> <div class="action"> <p class="p-light">لم يتم العثور على نتائج.</p> <a href="javascript:void(0);"><button onclick="loadDefault()" class="btn btn-primary">عودة</button></a> </div> </div>';
        }
        $html_books_container = '<div class="row">';

        foreach ($books as $book) {
            if(get_is_loggedin()){
                $favorite = [
                   'user_id' => get_current_user_id(),
                   'book_id' => $book->id
                ];
                $rowFav = $this->book_model->read_favorite_by_user_id_and_book_id($favorite);
                if($rowFav){
                   $class = 'danger';
                } else {
                   $class = 'secondary';
                }
             } else {
                $class = 'secondary';
             }
            $author = $this->user_model->read_by_id($book->author_id);
            $html_books_container .= '<div class="col-sm-6 col-md-4 col-lg-3"> <div class="iq-card iq-card-block iq-card-stretch iq-card-height search-bookcontent"> <div class="iq-card-body p-0"> <div class="d-flex align-items-center"> <div class="col-6 p-0 position-relative image-overlap-shadow"> <a href="javascript:void();"> <img class="img-fluid rounded w-100" src="' . URLROOT . 'img/book/' . $book->image . '" alt=""></a> <div class="view-book"> <a href="' . URLROOT . 'pages/book/' . $book->id . '" class="btn btn-sm btn-white">تفاصيل الكتاب</a> </div> </div> <div class="col-6"> <div class="mb-2"> <h6 class="mb-1">' . $book->name . '</h6> <p class="font-size-13 line-height mb-1">' . $author->fullname . '</p> <div class="d-block"> <span class="font-size-13 text-warning"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </span> </div> </div> <div class="price d-flex align-items-center"> <span class="pr-1 old-price">$' . $book->promo_price . '</span> <h6><b>$' . $book->price . '</b></h6> </div> <div class="iq-product-action"> <a href="javascript:void(0);" onclick="handleCart(\''.$book->id.'\',\''.$book->name.'\','.$book->price.',\''.$book->image.'\')"><i id="shopping_cart_icon'.$book->id.'" class="ri-shopping-cart-2-fill text-secondary"></i></a> <a href="javascript:void(0);" onclick="handleFavorite(\''.$book->id.'\')" class="ml-2"><i id="heart_icon_'.$book->id.'" class="ri-heart-fill text-'.$class.'"></i></a> </div> </div> </div> </div> </div> </div>';
        }
        $html_books_container .= '</div>';
        return $html_books_container;
    }
    public function is_user_have_book($book_id)
    {
        return sizeof($this->book_model->read_user_books_by_book_id($book_id, get_current_user_id())) > 0;

    }
}
