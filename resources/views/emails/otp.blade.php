<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:30px;">

    <div style="max-width:450px; margin:auto; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,.08);">

        <div style="background:linear-gradient(135deg,#696cff,#4d51d8); color:#fff; padding:25px; text-align:center;">
            <h2 style="margin:0;">Billing System</h2>
        </div>

        <div style="padding:30px; text-align:center;">

            <p style="color:#333; font-size:15px;">
                તમારો PIN રીસેટ કરવા માટે નીચેનો OTP દાખલ કરો:
            </p>

            <div style="font-size:32px; font-weight:bold; letter-spacing:8px; color:#696cff; margin:20px 0;">
                {{ $otp }}
            </div>

            <p style="color:#888; font-size:13px;">
                આ OTP 5 મિનિટ માટે માન્ય છે. જો તમે આ વિનંતી કરી નથી, તો આ ઇમેઇલ અવગણો.
            </p>

        </div>

        <div style="background:#f8f9fa; padding:15px; text-align:center; font-size:12px; color:#999;">
            © 2026 Billing Management System
        </div>

    </div>

</body>
</html>
