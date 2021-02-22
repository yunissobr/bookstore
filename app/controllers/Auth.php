<?php
class Auth extends Controller
{
    public function __construct()
    {
        $this->user_model = $this->model('User');
    }

    public function index()
    {
        redirect('auth/register');
    }

    public function login($type = 'client')
    {
        if(get_is_loggedin()){
            redirect('');
        }
        
        $data = [
            'title' => 'Login',
        ];


        if (isset($_POST['login'])) {

            $user = [
                "email" => $_POST['email'],
                "password" => $_POST['password'],
            ];
            $user_from_db = $this->user_model->read_by_email($user['email']);
            if ($user_from_db) {
                $hashed_password = $user_from_db->password;
                if (password_verify($user['password'], $hashed_password)) {
                    create_session_info($user_from_db);
                    show_alert(true, get_is_loggedin(), 'success', 'ri-information-line');
                    redirect(isset($_GET['redirect']) ? $_GET['redirect'] : 'auth/login');
                } else {
                    show_alert(true, 'كلمة المرور خاطئة', 'danger');
                }
            } else {
                show_alert(true, 'بريد أو كلمة مرورغير صحيحة', 'danger');
            }
            redirect('auth/login');
        }

        $this->view('auth/login', $data);
    }

    public function register($type = 'client')
    {
        if(get_is_loggedin()){
            redirect('');
        }
        $data = [
            'title' => 'Register',
        ];

        if (isset($_POST['create'])) {
            // die(var_dump($_POST));
            // show_alert(true,'حررت بحكم الله','success','ri-information-line');
            $user = [
                'id' => gen_uuid(),
                "fullname" => $_POST['fullname'],
                "image" => 'default.png',
                "description" => '-',
                "email" => $_POST['email'],
                "type" => $type,
                "password" => $_POST['password'],
            ];

            if ($this->user_model->read_by_email($user['email'])) {
                show_alert(true, 'البريد الإلكتروني مسجل مسبقا', 'danger');
                redirect('auth/register');
            } else {
                $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
                if ($this->user_model->create($user)) {
                    show_alert(true, 'تم تسجيل حسابك بنجاح', 'success', 'ri-information-line');
                    redirect(isset($_GET['redirect']) ? $_GET['redirect'] : 'auth/login');
                }
            }

            redirect('auth/register');

        }

        $this->view('auth/register', $data);
    }

    public function resetPassword($reset_password_token = null)
    {
        if(get_is_loggedin()){
            redirect('');
        }

        $data = [
            'title' => 'Recover Password',
        ];

        if (isset($_POST['update'])) {
            if (isset($reset_password_token)) {
                $user_from_db = $this->user_model->read_by_reset_password($reset_password_token);
                // die(json_encode($user_from_db));
                if ($user_from_db) {
                    $user = [
                        "id" => $user_from_db->id,
                        "password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
                        "fullname" => $user_from_db->fullname,
                    ];
                    if ($this->user_model->update($user)) {
                        show_alert(true, 'تم بنجاح', 'success', 'ri-information-line');
                        redirect('auth/resetPassword/success');
                    } else {
                        show_alert(true, 'تعذر التحديث', 'danger');
                        redirect('auth/resetPassword/success');
                    }
                } else {
                    show_alert(true, 'معلومات غير صحيحة', 'danger');
                    redirect('auth/resetPassword/success');
                }
            }
        }

        if (isset($_POST['send'])) {

            $user = [

                "email" => $_POST['email'],
                "reset_password" => generate_rand_str(250),

            ];

            // die($user['email']);

            $user_from_db = $this->user_model->read_by_email($user['email']);

            if ($user_from_db) {

                if ($this->user_model->update_reset_password($user)) {

                    $mail = [
                        'to' => $user['email'],
                        'to_name' => '',
                        'content' => '',
                        'html_content' => $this->get_reset_email_template($user),
                    ];

                    sendEmail($mail);
                    die($this->get_reset_email_template($user));
                    show_alert(true, 'تم بنجاح', 'success', 'ri-information-line');
                    redirect('auth/resetPassword');

                } else {
                    die('there was an error!');
                }
            } else {
                show_alert(true, 'البريد الإلكتروني غير موجود', 'danger');
                redirect('auth/resetPassword');
            }

        }

        if (isset($reset_password_token)) {
            $this->view('auth/update_password', $data);
            return;
        }

        $this->view('auth/reset_password', $data);
    }

    public function get_reset_email_template($user)
    {

        $link = URLROOT . 'auth/resetPassword/' . $user['reset_password'];
        return '<head> <title>Rating Reminder</title> <meta content="text/html; charset=utf-8" http-equiv="Content-Type" /> <meta content="width=device-width" name="viewport" /> <style type="text/css"> @font-face { font-family: &#x27;Postmates Std&#x27;; font-weight: 600; font-style: normal; src: local(&#x27;Postmates Std Bold&#x27;), url(https://s3-us-west-1.amazonaws.com/buyer-static.postmates.com/assets/email/postmates-std-bold.woff) format(&#x27;woff&#x27;); } @font-face { font-family: &#x27;Postmates Std&#x27;; font-weight: 500; font-style: normal; src: local(&#x27;Postmates Std Medium&#x27;), url(https://s3-us-west-1.amazonaws.com/buyer-static.postmates.com/assets/email/postmates-std-medium.woff) format(&#x27;woff&#x27;); } @font-face { font-family: &#x27;Postmates Std&#x27;; font-weight: 400; font-style: normal; src: local(&#x27;Postmates Std Regular&#x27;), url(https://s3-us-west-1.amazonaws.com/buyer-static.postmates.com/assets/email/postmates-std-regular.woff) format(&#x27;woff&#x27;); } </style> <style media="screen and (max-width: 680px)"> @media screen and (max-width: 680px) { .page-center { padding-left: 0 !important; padding-right: 0 !important; } .footer-center { padding-left: 20px !important; padding-right: 20px !important; } } </style> </head> <body style="background-color: #f4f4f5"> <table cellpadding="0" cellspacing="0" style=" width: 100%; height: 100%; background-color: #f4f4f5; text-align: center; " > <tbody> <tr> <td style="text-align: center"> <table align="center" cellpadding="0" cellspacing="0" id="body" style=" background-color: #fff; width: 100%; max-width: 680px; height: 100%; " > <tbody> <tr> <td> <table align="center" cellpadding="0" cellspacing="0" class="page-center" style=" text-align: left; padding-bottom: 88px; width: 100%; padding-left: 120px; padding-right: 120px; " > <tbody> <tr> <td style="padding-top: 24px"> <img src="https://d1pgqke3goo8l6.cloudfront.net/wRMe5oiRRqYamUFBvXEw_logo.png" style="width: 56px" /> </td> </tr> <tr> <td colspan="2" style=" padding-top: 72px; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #000000; font-family: \'Postmates Std\', \'Helvetica\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', \'Roboto\', \'Oxygen\', \'Ubuntu\', \'Cantarell\', \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif; font-size: 48px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: -2.6px; line-height: 52px; mso-line-height-rule: exactly; text-decoration: none; " > إعادة تعيين كلمة المرور </td> </tr> <tr> <td style="padding-top: 48px; padding-bottom: 48px"> <table cellpadding="0" cellspacing="0" style="width: 100%" > <tbody> <tr> <td style=" width: 100%; height: 1px; max-height: 1px; background-color: #d9dbe0; opacity: 0.81; " ></td> </tr> </tbody> </table> </td> </tr> <tr> <td style=" -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #9095a2; font-family: \'Postmates Std\', \'Helvetica\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', \'Roboto\', \'Oxygen\', \'Ubuntu\', \'Cantarell\', \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif; font-size: 16px; font-smoothing: always; font-style: normal; font-weight: 400; letter-spacing: -0.18px; line-height: 24px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 100%; " > لقد تلقيت هذا البريد الإلكتروني لأنك طلبت إعادة تعيين كلمة المرور لحساب Book Store الخاص بك. </td> </tr> <tr> <td style=" padding-top: 24px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #9095a2; font-family: \'Postmates Std\', \'Helvetica\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', \'Roboto\', \'Oxygen\', \'Ubuntu\', \'Cantarell\', \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif; font-size: 16px; font-smoothing: always; font-style: normal; font-weight: 400; letter-spacing: -0.18px; line-height: 24px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 100%; " > الرجاء النقر فوق الزر أدناه لاختيار كلمة مرور جديدة. </td> </tr> <tr> <td> <a data-click-track-id="37" href="' . $link . '" style=" margin-top: 36px; -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #ffffff; font-family: \'Postmates Std\', \'Helvetica\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', \'Roboto\', \'Oxygen\', \'Ubuntu\', \'Cantarell\', \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif; font-size: 12px; font-smoothing: always; font-style: normal; font-weight: 600; letter-spacing: 0.7px; line-height: 48px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 220px; background-color: #00cc99; border-radius: 28px; display: block; text-align: center; text-transform: uppercase; " target="_blank"> إعادة تعيين كلمة المرور </a> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> <table align="center" cellpadding="0" cellspacing="0" id="footer" style=" background-color: #000; width: 100%; max-width: 680px; height: 100%; " > <tbody> <tr> <td> <table align="center" cellpadding="0" cellspacing="0" class="footer-center" style=" text-align: left; width: 100%; padding-left: 120px; padding-right: 120px; " > <tbody> <tr> <td colspan="2" style=" padding-top: 72px; padding-bottom: 24px; width: 100%; " > <img src="https://d1pgqke3goo8l6.cloudfront.net/DFcmHWqyT2CXk2cfz1QB_wordmark.png" style="width: 124px; height: 20px" /> </td> </tr> <tr> <td colspan="2" style="padding-top: 24px; padding-bottom: 48px" > <table cellpadding="0" cellspacing="0" style="width: 100%" > <tbody> <tr> <td style=" width: 100%; height: 1px; max-height: 1px; background-color: #eaecf2; opacity: 0.19; " ></td> </tr> </tbody> </table> </td> </tr> <tr> <td style=" -ms-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: 100%; color: #9095a2; font-family: \'Postmates Std\', \'Helvetica\', -apple-system, BlinkMacSystemFont, \'Segoe UI\', \'Roboto\', \'Oxygen\', \'Ubuntu\', \'Cantarell\', \'Fira Sans\', \'Droid Sans\', \'Helvetica Neue\', sans-serif; font-size: 15px; font-smoothing: always; font-style: normal; font-weight: 400; letter-spacing: 0; line-height: 24px; mso-line-height-rule: exactly; text-decoration: none; vertical-align: top; width: 100%; " > If you have any questions or concerns, we\'re here to help. Contact us via our <a data-click-track-id="1053" href="https://support.postmates.com/buyer" style="font-weight: 500; color: #ffffff" target="_blank" >Help Center</a >. </td> </tr> <tr> <td style="height: 72px"></td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </body>';
    }

    public function logout(){
        delete_session_info();
        redirect('');
    }


    
}
