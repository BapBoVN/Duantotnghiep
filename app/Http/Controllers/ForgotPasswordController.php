<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('frontend.pages.forgot-password');
    }

    public function sendNewPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Nếu email không tồn tại, trả về thông báo lỗi
            return redirect()->back()->withErrors(['email' => 'Email không tồn tại trong hệ thống.']);
        }

        // Tạo mật khẩu mới ngẫu nhiên
        $newPassword = Str::random(8);
        
        // Cập nhật mật khẩu mới trong database
        $user->password = Hash::make($newPassword);
        $user->save();

        // Gửi email chứa mật khẩu mới
        Mail::send('emails.new-password', ['newPassword' => $newPassword], function($message) use ($request) {
            $message->to($request->email);
            $message->subject('Mật khẩu mới của bạn');
        });

        return redirect()->route('login.form')->with('success', 'Mật khẩu mới đã được gửi đến email của bạn');
    }
} 