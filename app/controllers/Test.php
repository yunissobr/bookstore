<?php
require_once APPROOT . '/libraries/simple-html-document/HtmlWeb.php';

use simplehtmldom\HtmlWeb;

class Test extends Controller
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

    }
    public function bookAdder3()
    {
        $links = $this->get_links();
        for ($i = 0; $i < sizeof($links); $i++) {
            $doc = new HtmlWeb();
            $dom = $doc->load($links[$i]);
            $book = [
                'id' => gen_uuid(),
                'name' => '',
                'category_id' => '',
                'category' => '',
                'author_id' => '',
                'author' => '',
                'promo_price' => rand(50.10, 99.99) + 0.99,
                'price' => '',
                'image' => '',
                'book_file' => 'demo.pdf',
                'description' => '',
            ];

            $book['price'] = rand(8.10, $book['promo_price']);

            if (!empty($dom)) {
                foreach ($dom->find('h1.tw-text-2xl') as $span) {
                    foreach ($span->find('svg, img,a') as $element) {
                        $element->remove();
                    }
                }
                $book['name'] = trim($span->innertext);

                foreach ($dom->find('a[itemprop=author]') as $e) {
                    $book['author'] = strip_tags($e->innertext);
                    break;
                }

                foreach ($dom->find('picture') as $e) {
                    $img = $e->find('img');
                    $book['image'] = $this->image_downloader(trim($img[0]->attr["data-src"]));
                    break;
                }

                foreach ($dom->find('div[itemprop=description]') as $e) {
                    $book['description'] = strip_tags($e->innertext);
                    break;
                }

                foreach ($dom->find('span[itemprop=genre]') as $e) {
                    $book['category'] = strip_tags($e->innertext);
                    break;
                }

            } else {
            }

            if ($book) {
                if (empty($book['name']) || empty($book['category']) || empty($book['author'])) {
                    echo 'empty-book-cate-auth-tit';
                } else {

                    # check if category already exist
                    $category = $this->category_model->read_by_name($book['category']);
                    if ($category) {
                        $book['category_id'] = $category->id;
                    } else {
                        $cat = [
                            'id' => gen_uuid(),
                            'name' => $book['category'],
                            'image' => "default.png",
                            'description' => "unknown",
                        ];
                        if ($this->category_model->create($cat)) {
                            $category = $this->category_model->read_by_name($book['category']);
                            $book['category_id'] = $category->id;
                        } else {
                            $book['category_id'] = 1;
                        }
                    }
                    # check if author already exist
                    $author = $this->user_model->read_by_name($book['author']);
                    if ($author) {
                        $book['author_id'] = $author->id;
                    } else {
                        $auth = [
                            'id' => gen_uuid(),
                            'fullname' => $book['author'],
                            'email' => '_',
                            'password' => '_',
                            'image' => "default.png",
                            'description' => "unknown",
                            'type' => AUTHOR,
                        ];
                        if ($this->user_model->create($auth)) {
                            $author = $this->user_model->read_by_name($book['author']);
                            $book['author_id'] = $author->id;
                        } else {
                            $book['author_id'] = 1;
                        }
                    }


                    $bk = $this->book_model->read_by_name($book['name']);
                    if ($bk) {
                        # book Already exist
                        echo $book['name'] . ' Already exist' . "<br>";
                    } else {
                        if ($this->book_model->create($book)) {
                            echo $book['name'] . " success - " . "<br>";
                        } else {
                            echo $book['name'] . " error - " . "<br>";
                        }
                    }
                }
            } else {
                echo 'empty-book';
            }

            print_r($book);
        }

    }

    public function get_links()
    {
        $links = [
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%B0%D9%8A%D9%86-%D9%84%D9%85-%D9%8A%D9%88%D9%84%D8%AF%D9%88%D8%A7-%D8%A8%D8%B9%D8%AF-%D8%B6%D9%88%D8%A1-%D9%81%D9%89-%D8%A7%D9%84%D9%85%D8%AC%D8%B1%D8%A9-1',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%B0%D9%8A%D9%86-%D9%84%D9%85-%D9%8A%D9%88%D9%84%D8%AF%D9%88%D8%A7-%D8%A8%D8%B9%D8%AF-%D8%B6%D9%88%D8%A1-%D9%81%D9%89-%D8%A7%D9%84%D9%85%D8%AC%D8%B1%D8%A9-1',
            'https://www.booksjuice.com/books/%D9%87%D8%A7%D8%B4%D8%AA%D8%A7%D8%AC-%D9%84%D9%84%D9%81%D8%B1%D8%AD%D8%A9',
            'https://www.booksjuice.com/books/%D9%87%D8%A7%D8%B4%D8%AA%D8%A7%D8%AC-%D9%84%D9%84%D9%81%D8%B1%D8%AD%D8%A9',
            'https://www.booksjuice.com/books/%D9%82%D9%84%D8%A8%D9%80%D9%80%D9%8A-%D9%8A%D8%AD%D8%AF%D8%AB%D9%86%D9%8A',
            'https://www.booksjuice.com/books/%D9%82%D9%84%D8%A8%D9%80%D9%80%D9%8A-%D9%8A%D8%AD%D8%AF%D8%AB%D9%86%D9%8A',
            'https://www.booksjuice.com/books/%D8%B9%D8%B2%D9%8A%D8%B2%D8%AA%D9%8A-%D8%A5%D9%8A%D9%81%D8%A7',
            'https://www.booksjuice.com/books/%D8%B9%D8%B2%D9%8A%D8%B2%D8%AA%D9%8A-%D8%A5%D9%8A%D9%81%D8%A7',
            'https://www.booksjuice.com/books/%D9%85%D9%84%D8%A7%D8%AD%D8%B8%D8%A7%D8%AA%D9%8A-%D8%AE%D9%84%D8%A7%D9%84-33-%D9%8A%D9%88%D9%85',
            'https://www.booksjuice.com/books/%D9%85%D9%84%D8%A7%D8%AD%D8%B8%D8%A7%D8%AA%D9%8A-%D8%AE%D9%84%D8%A7%D9%84-33-%D9%8A%D9%88%D9%85',
            'https://www.booksjuice.com/books/%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D8%B3%D8%AD%D8%B1-%D8%A7%D9%84%D8%B9%D8%A7%D9%85%D8%A9',
            'https://www.booksjuice.com/books/%D9%87%D8%A7%D8%B1%D9%8A-%D8%A8%D9%88%D8%AA%D8%B1-%D9%88%D8%B3%D8%AD%D8%B1-%D8%A7%D9%84%D8%B9%D8%A7%D9%85%D8%A9',
            'https://www.booksjuice.com/books/%D9%85%D8%B5%D8%A7%D8%B1%D8%B9-%D8%A7%D9%84%D9%86%D8%A8%D9%84%D8%A7%D8%A1',
            'https://www.booksjuice.com/books/%D9%85%D8%B5%D8%A7%D8%B1%D8%B9-%D8%A7%D9%84%D9%86%D8%A8%D9%84%D8%A7%D8%A1',
            'https://www.booksjuice.com/books/%D9%82%D8%A8%D8%B3-%D9%85%D9%86-%D8%AD%D9%83%D8%A7%D9%8A%D8%A7',
            'https://www.booksjuice.com/books/%D9%82%D8%A8%D8%B3-%D9%85%D9%86-%D8%AD%D9%83%D8%A7%D9%8A%D8%A7',
            'https://www.booksjuice.com/books/%D9%85%D8%A7-%D8%AD%D8%B0%D9%81%D9%87-%D9%85%D9%82%D8%B5-%D8%A7%D9%84%D8%B1%D9%82%D9%8A%D8%A8-%D9%85%D9%86-%D8%B1%D9%88%D8%A7%D9%8A%D8%A9-%D8%A3%D8%B1%D8%B6-%D8%A7%D9%84%D8%B3%D8%A7%D9%81%D9%84%D9%8A%D9%86-%D9%88-%D9%85%D8%AD%D8%AA%D9%88%D9%8A%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D9%88%D9%82%D8%B9-%D8%A7%D9%84%D8%B3%D9%81%D9%84%D9%8A',
            'https://www.booksjuice.com/books/%D9%85%D8%A7-%D8%AD%D8%B0%D9%81%D9%87-%D9%85%D9%82%D8%B5-%D8%A7%D9%84%D8%B1%D9%82%D9%8A%D8%A8-%D9%85%D9%86-%D8%B1%D9%88%D8%A7%D9%8A%D8%A9-%D8%A3%D8%B1%D8%B6-%D8%A7%D9%84%D8%B3%D8%A7%D9%81%D9%84%D9%8A%D9%86-%D9%88-%D9%85%D8%AD%D8%AA%D9%88%D9%8A%D8%A7%D8%AA-%D8%A7%D9%84%D9%85%D9%88%D9%82%D8%B9-%D8%A7%D9%84%D8%B3%D9%81%D9%84%D9%8A',
            'https://www.booksjuice.com/books/%D8%B1%D9%85%D8%A7%D8%AF',
            'https://www.booksjuice.com/books/%D8%B1%D9%85%D8%A7%D8%AF',
            'https://www.booksjuice.com/books/%D8%A5%D9%86%D9%8A-%D8%B3%D9%85%D9%8A%D8%AA%D9%87%D8%A7-%D9%85%D8%B1%D9%8A%D9%85',
            'https://www.booksjuice.com/books/%D8%A5%D9%86%D9%8A-%D8%B3%D9%85%D9%8A%D8%AA%D9%87%D8%A7-%D9%85%D8%B1%D9%8A%D9%85',
            'https://www.booksjuice.com/books/%D8%B4%D9%8A%D8%B7%D9%84%D8%A7%D8%A6%D9%83%D9%8A%D8%A9',
            'https://www.booksjuice.com/books/%D8%B4%D9%8A%D8%B7%D9%84%D8%A7%D8%A6%D9%83%D9%8A%D8%A9',
            'https://www.booksjuice.com/books/%D9%83%D9%85%D8%A7-%D8%A3%D8%AE%D8%A8%D8%B1%D8%AA%D9%86%D9%8A-%D8%A7%D9%84%D8%B9%D8%B1%D8%A7%D9%81%D8%A9',
            'https://www.booksjuice.com/books/%D9%83%D9%85%D8%A7-%D8%A3%D8%AE%D8%A8%D8%B1%D8%AA%D9%86%D9%8A-%D8%A7%D9%84%D8%B9%D8%B1%D8%A7%D9%81%D8%A9',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%A3%D8%B3%D8%B1%D8%A9-%D8%A7%D9%84%D8%A8%D8%A7%D8%B1%D8%AF%D8%A9',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%A3%D8%B3%D8%B1%D8%A9-%D8%A7%D9%84%D8%A8%D8%A7%D8%B1%D8%AF%D8%A9',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%B1%D9%88%D8%A7%D9%8A',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%B1%D9%88%D8%A7%D9%8A',
            'https://www.booksjuice.com/books/%D8%B9%D8%B1%D9%8A%D8%B3-%D8%AF%D9%88%D8%A8%D9%84%D9%8A%D8%B1',
            'https://www.booksjuice.com/books/%D8%B9%D8%B1%D9%8A%D8%B3-%D8%AF%D9%88%D8%A8%D9%84%D9%8A%D8%B1',
            'https://www.booksjuice.com/books/%D8%A8%D8%B1%D8%B7%D9%85%D8%A7%D9%86-%D9%86%D9%88%D8%AA%D9%8A%D9%84%D8%A7',
            'https://www.booksjuice.com/books/%D8%A8%D8%B1%D8%B7%D9%85%D8%A7%D9%86-%D9%86%D9%88%D8%AA%D9%8A%D9%84%D8%A7',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D9%85%D8%A8%D8%AA%D8%B9%D8%AF%D9%88%D9%86-%D9%84%D9%83%D9%8A-%D9%8A%D9%82%D8%AA%D8%B1%D8%A8%D9%88%D8%A7',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D9%85%D8%A8%D8%AA%D8%B9%D8%AF%D9%88%D9%86-%D9%84%D9%83%D9%8A-%D9%8A%D9%82%D8%AA%D8%B1%D8%A8%D9%88%D8%A7',
            'https://www.booksjuice.com/books/%D8%B9%D9%86%D8%AF%D9%85%D8%A7-%D8%AA%D9%83%D8%B0%D8%A8-%D8%A7%D9%84%D8%AD%D9%82%D9%8A%D9%82%D8%A9',
            'https://www.booksjuice.com/books/%D8%B9%D9%86%D8%AF%D9%85%D8%A7-%D8%AA%D9%83%D8%B0%D8%A8-%D8%A7%D9%84%D8%AD%D9%82%D9%8A%D9%82%D8%A9',
            'https://www.booksjuice.com/books/%D9%81%D8%AE-%D8%A7%D9%84%D9%85%D9%88%D8%AA',
            'https://www.booksjuice.com/books/%D9%81%D8%AE-%D8%A7%D9%84%D9%85%D9%88%D8%AA',
            'https://www.booksjuice.com/books/%D8%B2%D9%88%D8%AC-%D8%B9%D8%B4%D9%8A%D9%82%D8%AA%D9%8A',
            'https://www.booksjuice.com/books/%D8%B2%D9%88%D8%AC-%D8%B9%D8%B4%D9%8A%D9%82%D8%AA%D9%8A',
            'https://www.booksjuice.com/books/%D8%B4%D9%82%D8%A7%D8%A1-%D8%B7%D9%81%D9%84%D8%A9',
            'https://www.booksjuice.com/books/%D8%B4%D9%82%D8%A7%D8%A1-%D8%B7%D9%81%D9%84%D8%A9',
            'https://www.booksjuice.com/books/%D9%81%D9%8A%D9%84%D9%8A%D8%A7',
            'https://www.booksjuice.com/books/%D9%81%D9%8A%D9%84%D9%8A%D8%A7',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%B9%D9%88%D8%AF-%D8%A7%D9%84%D8%A3%D8%A8%D8%AF%D9%8A',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%B9%D9%88%D8%AF-%D8%A7%D9%84%D8%A3%D8%A8%D8%AF%D9%8A',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D9%85%D9%84%D9%81-%D8%A7%D9%84%D8%A3%D8%B3%D9%88%D8%AF',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D9%85%D9%84%D9%81-%D8%A7%D9%84%D8%A3%D8%B3%D9%88%D8%AF',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D9%83%D8%AA%D8%A7%D8%A8-%D8%A7%D9%84%D8%A3%D8%B3%D9%88%D8%AF',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D9%83%D8%AA%D8%A7%D8%A8-%D8%A7%D9%84%D8%A3%D8%B3%D9%88%D8%AF',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%A8%D8%B1%D9%88%D8%A7%D8%B2-%D8%A7%D9%84%D8%AC%D8%AF%D9%8A%D8%AF',
            'https://www.booksjuice.com/books/%D8%A7%D9%84%D8%A8%D8%B1%D9%88%D8%A7%D8%B2-%D8%A7%D9%84%D8%AC%D8%AF%D9%8A%D8%AF',
            'https://www.booksjuice.com/books/%D8%AB%D8%BA%D8%B1%D8%A9-%D8%A7%D8%A8%D9%86-%D9%8A%D8%B9%D9%82%D9%88%D8%A8',
            'https://www.booksjuice.com/books/%D8%AB%D8%BA%D8%B1%D8%A9-%D8%A7%D8%A8%D9%86-%D9%8A%D8%B9%D9%82%D9%88%D8%A8',
            'https://www.booksjuice.com/books/%D9%86%D8%A7%D9%8A%D8%A7%D8%AA-%D8%A8%D8%AA%D8%AD%D9%84%D9%85-%D8%A8%D8%A7%D9%84%D8%BA%D9%86%D8%A7',
            'https://www.booksjuice.com/books/%D9%86%D8%A7%D9%8A%D8%A7%D8%AA-%D8%A8%D8%AA%D8%AD%D9%84%D9%85-%D8%A8%D8%A7%D9%84%D8%BA%D9%86%D8%A7',
            'https://www.booksjuice.com/books/%D8%B5%D8%B1%D8%AE%D8%A9',
            'https://www.booksjuice.com/books/%D8%B5%D8%B1%D8%AE%D8%A9',
        ];

        return $links;

    }

    public function image_downloader($url = "https://cdn.britannica.com/77/170477-004-B774BDDF.jpg")
    {

        $targetDir = ROOT . '/public/' . 'img/book/';
        $filename = generate_rand_str(4) . '_' . str_replace(" ", "", basename($url));

        $complete_save_loc = $targetDir . $filename;
        file_put_contents($complete_save_loc, file_get_contents($url));
        return $filename;
    }
}
