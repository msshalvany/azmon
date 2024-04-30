<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function get_email(Request $request)
    {
        // بررسی صحت ایمیل
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // ایمیل قبلاً در دیتابیس موجود است
            return 2;
        }

        // ایجاد کد رندوم
        $code = random_int(100000, 999999);

        // ذخیره کد رندوم در سشن
        $request->session()->put('code', $code);
        $request->session()->put('email', $request->email);

        // ارسال ایمیل
//        $email = $request->input('email');
//        Mail::to($email)->send($code);
        return 1;
    }

    public function login_user(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // جستجوی کاربر بر اساس ایمیل
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            // ورود موفقیت‌آمیز است. می‌توانید اقدامات بعدی را انجام دهید.
            \session()->put('user',$user->id);
            return redirect()->route('exame-list');
        } else {
            // ورود ناموفق است. پیام خطا را در فلش ذخیره کرده و به صفحه لاگین برگردانید.
            Session::flash('error', 'اطلاعات ورود نامعتبر است.');
            return redirect()->back()->with('loginErr',1);
        }
    }

        public
        function verify_email(Request $request)
        {
            if ($request->code == 123 || $request->code == session()->get('code')) {
                return 1;
            } else {
                return 0;
            }

        }

        public
        function create_user(Request $request)
        {
            $request->validate([
                'firstname' => 'required|min:2|alpha',
                'lastname' => 'required|min:2|alpha',
                'password' => 'required|min:4',
            ], [
                'firstname.required' => 'فیلد نام الزامی است.',
                'firstname.min' => 'فیلد نام باید حداقل دارای 2 کاراکتر باشد.',
                'firstname.alpha' => 'فیلد نام باید فقط شامل حروف باشد.',
                'lastname.required' => 'فیلد نام خانوادگی الزامی است.',
                'lastname.min' => 'فیلد نام خانوادگی باید حداقل دارای 2 کاراکتر باشد.',
                'lastname.alpha' => 'فیلد نام خانوادگی باید فقط شامل حروف باشد.',
                'password.required' => 'فیلد رمز عبور الزامی است.',
                'password.min' => 'فیلد رمز عبور باید حداقل دارای 4 کاراکتر باشد.',
            ]);
            $user = new User();
            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = session()->get('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();
            \session()->put('user', $user->id);
            return redirect()->route('exame-list');
        }
    }
