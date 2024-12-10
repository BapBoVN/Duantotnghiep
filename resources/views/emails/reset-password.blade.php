<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; padding: 20px;">
    <h2>Xin chào!</h2>
    
    <p>Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
    
    <p>Vui lòng click vào nút bên dưới để đặt lại mật khẩu:</p>
    
    <div style="margin: 30px 0;">
        <a href="{{ url('password-reset?token=' . $token . '&email=' . urlencode($email)) }}" 
           style="background-color: #4CAF50; color: white; padding: 12px 25px; text-decoration: none; border-radius: 3px;">
            Đặt lại mật khẩu
        </a>
    </div>
    
    <p>Link đặt lại mật khẩu này sẽ hết hạn sau 60 phút.</p>
    
    <p>Nếu bạn không yêu cầu đặt lại mật khẩu, bạn có thể bỏ qua email này.</p>
    
    <p>Trân trọng,<br>{{ config('app.name') }}</p>
    
    <hr style="margin: 20px 0;">
    <p style="font-size: 12px; color: #666;">Nếu bạn gặp vấn đề khi click vào nút "Đặt lại mật khẩu", 
    hãy copy và paste URL sau vào trình duyệt web của bạn: {{ url('password-reset?token=' . $token . '&email=' . urlencode($email)) }}</p>
</body>
</html> 