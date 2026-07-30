<!DOCTYPE html>
<html lang="gu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Forgot Password - Billing System</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- GlassToast CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Vijayparmar03/GlassToast@main/vijay.css">

    <style>
        body {
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, .08);
        }

        .left-side {
            background: linear-gradient(135deg, #696cff, #4d51d8);
            color: #fff;
            min-height: 620px;
        }

        .left-side img {
            max-width: 300px;
        }

        .login-title {
            font-size: 30px;
            font-weight: bold;
        }

        .input-group-text {
            background: white;
        }

        .form-control {
            height: 50px;
        }

        .btn-login {
            height: 50px;
            font-size: 18px;
            font-weight: 600;
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, .15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .logo-circle i {
            font-size: 42px;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        .step-dot {
            width: 30px;
            height: 4px;
            border-radius: 4px;
            background: #e9ecef;
        }

        .step-dot.active {
            background: #696cff;
        }

        .back-link {
            font-size: 14px;
        }

        @media(max-width:991px) {
            .left-side {
                display: none;
            }
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-xl-10">

                <div class="card login-card">

                    <div class="row g-0">

                        <!-- Left -->
                        <div
                            class="col-lg-6 left-side d-flex flex-column justify-content-center align-items-center text-center p-5">

                            <div class="logo-circle mb-4">
                                <i class="bx bx-key"></i>
                            </div>

                            <h2 class="fw-bold mb-3">
                                Billing System
                            </h2>

                            <h5 class="mb-3">
                                ચિંતા ના કરો, અમે મદદ કરીશું
                            </h5>

                            <p class="opacity-75 mb-4">
                                તમારો મોબાઇલ નંબર દાખલ કરો અને અમે તમને PIN રીસેટ કરવામાં મદદ કરીશું.
                            </p>

                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="img-fluid">

                        </div>

                        <!-- Right -->
                        <div class="col-lg-6 bg-white">

                            <div class="p-5">

                                <a href="login.html" class="back-link text-decoration-none text-muted d-inline-flex align-items-center mb-3">
                                    <i class="bx bx-arrow-back me-1"></i>
                                    લોગિન પર પાછા જાઓ
                                </a>

                                <div class="text-center mb-4">

                                    <i class="bx bx-lock-open-alt text-primary" style="font-size:60px;"></i>

                                    <h2 class="login-title mt-3">
                                        પાસવર્ડ ભૂલી ગયા?
                                    </h2>

                                    <p class="text-muted">
                                        નોંધાયેલ મોબાઇલ નંબર દાખલ કરો, અમે OTP મોકલીશું
                                    </p>

                                </div>

                                <div class="step-indicator">
                                    <div class="step-dot active"></div>
                                    <div class="step-dot"></div>
                                    <div class="step-dot"></div>
                                </div>

                                <form id="forgotPasswordForm">

                                    <!-- Mobile -->

                                    <div class="mb-4">

                                        <label class="form-label fw-semibold">
                                            મોબાઇલ નંબર
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="bx bx-mobile-alt"></i>
                                            </span>

                                            <span class="input-group-text">
                                                +91
                                            </span>

                                            <input
                                                type="tel"
                                                class="form-control"
                                                id="mobile"
                                                name="mobile"
                                                placeholder="9876543210"
                                                maxlength="10"
                                                inputmode="numeric"
                                                autocomplete="tel"
                                            >

                                        </div>

                                        <small class="text-muted">
                                            લોગિન સમયે ઉપયોગમાં લીધેલ મોબાઇલ નંબર દાખલ કરો
                                        </small>

                                    </div>

                                    <button
                                        type="submit"
                                        class="btn btn-primary w-100 btn-login"
                                        id="sendOtpBtn"
                                    >

                                        <i class="bx bx-send me-2"></i>

                                        <span id="sendOtpBtnText">OTP મોકલો</span>

                                    </button>

                                </form>

                                <hr class="my-4">

                                <div class="text-center mt-3">

                                    <small class="text-muted">

                                        © 2026 Billing Management System

                                    </small>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/gh/Vijayparmar03/GlassToast@main/vijay.js"></script>

    {{-- //forgot password page js --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('forgotPasswordForm');
        const mobile = document.getElementById('mobile');
        const sendOtpBtn = document.getElementById('sendOtpBtn');
        const sendOtpBtnText = document.getElementById('sendOtpBtnText');

        mobile.addEventListener('input', function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });

        form.addEventListener('submit', function (e) {

            e.preventDefault();

            const mobileValue = mobile.value.trim();

            if (mobileValue === '') {
                GlassToast.warning('ચેતવણી', 'મોબાઇલ નંબર દાખલ કરો.');
                mobile.focus();
                return;
            }

            if (!/^[6-9][0-9]{9}$/.test(mobileValue)) {
                GlassToast.error('ભૂલ', 'માન્ય 10 અંકનો મોબાઇલ નંબર દાખલ કરો.');
                mobile.focus();
                return;
            }

            sendOtpBtn.disabled = true;
            sendOtpBtnText.innerText = 'મોકલી રહ્યું છે...';

            fetch("{{ route('forgot.password.send-otp') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ mobile: mobileValue }),
            })

            .then(async response => {
                const data = await response.json();
                if (!response.ok) throw { status: response.status, data };
                return data;
            })

            .then(data => {

                if (data.status) {

                    GlassToast.success('સફળતા', data.message);

                    setTimeout(function () {
                        window.location.href = data.redirect;
                    }, 1000);

                } else {
                    GlassToast.error('ભૂલ', data.message);
                    sendOtpBtn.disabled = false;
                    sendOtpBtnText.innerText = 'OTP મોકલો';
                }

            })

            .catch(error => {

                console.log(error);

                if (error.status === 422 && error.data?.errors) {
                    const firstErrorKey = Object.keys(error.data.errors)[0];
                    GlassToast.error('ભૂલ', error.data.errors[firstErrorKey][0]);
                } else if (error.data?.message) {
                    GlassToast.error('ભૂલ', error.data.message);
                } else {
                    GlassToast.error('ભૂલ', 'કંઈક ખોટું થયું. કૃપા કરીને ફરી પ્રયાસ કરો.');
                }

                sendOtpBtn.disabled = false;
                sendOtpBtnText.innerText = 'OTP મોકલો';

            });

        });

    });
</script>


</body>

</html>
