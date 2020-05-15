<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ReCaptcha\ReCaptcha;
class Captcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //XEm video bài 60 về captcha
        //KHỞI TẠO RECAPTCHA
        $recaptcha = new ReCaptcha(env('CAPTCHA_SECRET')); // env có nghĩa là quay lại .env lấy hàm CAPTCHA_SECRET
        $response = $recaptcha->verify($value, $_SERVER['REMOTE_ADDR']); //REMOTE_ADDR LÀ nó sẽ lấy cái địa chỉ của cái source của mình
                                //verify là hàm bên ReCaptcha.php dòng 155
        return $response->isSuccess();

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Vì lý do chống spam, xin vui lòng nhập đúng mã';
        	//trả về thông báo khi lỗi không xác nhận captcha
    }
}
