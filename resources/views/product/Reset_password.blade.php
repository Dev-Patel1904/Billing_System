<!DOCTYPE html>
<html lang="gu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - Billing System</title>

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

        /* OTP boxes */
        .otp-group {
            display: flex;
            gap: 10px;
            justify-content: space-between;
        }

        .otp-group input {
            width: 100%;
            height: 55px;
            text-align: center;
            font-size: 22px;
            font-weight: 600;
            border-radius: 10px;
        }

        .otp-group input.is-valid {
            border-color: #198754;
        }

        .resend-text {
            font-size: 14px;
        }

        .resend-text a {
            font-weight: 600;
        }

        .resend-text a.disabled {
            pointer-events: none;
            opacity: .6;
        }

        .pin-strength {
            height: 5px;
            border-radius: 5px;
            background: #e9ecef;
            overflow: hidden;
            margin-top: 8px;
        }

        .pin-strength-bar {
            height: 100%;
            width: 0%;
            background: #dc3545;
            transition: width .3s, background-color .3s;
        }

        .otp-verified-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            color: #198754;
            font-weight: 600;
            font-size: 15px;
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
                                <i class="bx bx-shield-quarter"></i>
                            </div>

                            <h2 class="fw-bold mb-3">
                                Billing System
                            </h2>

                            <h5 class="mb-3">
                                બસ, થોડું જ બાકી છે
                            </h5>

                            <p class="opacity-75 mb-4">
                                OTP વેરિફાય કરો અને નવો 6 અંકનો PIN સેટ કરો.
                            </p>

                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="img-fluid">

                        </div>

                        <!-- Right -->
                        <div class="col-lg-6 bg-white">

                            <div class="p-5">

                                <a href="{{ route('forgot.password.form') }}" class="back-link text-decoration-none text-muted d-inline-flex align-items-center mb-3">
                                    <i class="bx bx-arrow-back me-1"></i>
                                    પાછા જાઓ
                                </a>

                                <div class="text-center mb-4">

                                    <i class="bx bx-lock-alt text-primary" style="font-size:60px;"></i>

                                    <h2 class="login-title mt-3" id="pageTitle">
                                        PIN રીસેટ કરો
                                    </h2>

                                    <p class="text-muted" id="pageSubtitle">
                                        +91 {{ $maskedMobile }} પર મોકલેલ OTP દાખલ કરો
                                    </p>

                                </div>

                                <div class="step-indicator">
                                    <div class="step-dot active"></div>
                                    <div class="step-dot active"></div>
                                    <div class="step-dot" id="stepDot3"></div>
                                </div>

                                <!-- ===================== -->
                                <!-- STEP A: OTP SECTION -->
                                <!-- ===================== -->

                                <form id="otpForm">

                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            OTP દાખલ કરો
                                        </label>

                                        <div class="otp-group mb-2">
                                            <input type="text" class="form-control otp-box" maxlength="1" inputmode="numeric">
                                            <input type="text" class="form-control otp-box" maxlength="1" inputmode="numeric">
                                            <input type="text" class="form-control otp-box" maxlength="1" inputmode="numeric">
                                            <input type="text" class="form-control otp-box" maxlength="1" inputmode="numeric">
                                        </div>

                                        <div class="resend-text text-muted">
                                            OTP નથી મળ્યો?
                                            <a href="#" id="resendOtpLink" class="text-decoration-none">ફરી મોકલો</a>
                                            <span class="float-end" id="otpTimer">01:00</span>
                                        </div>

                                    </div>

                                    <button
                                        type="submit"
                                        class="btn btn-primary w-100 btn-login"
                                        id="verifyOtpBtn"
                                    >

                                        <i class="bx bx-check-circle me-2"></i>

                                        <span id="verifyOtpBtnText">OTP ચકાસો</span>

                                    </button>

                                </form>

                                <!-- ===================== -->
                                <!-- STEP B: PIN SECTION (hidden initially) -->
                                <!-- ===================== -->

                                <form id="pinForm" style="display:none;">

                                    <div class="otp-verified-badge mb-4">
                                        <i class="bx bx-check-shield fs-4"></i>
                                        OTP સફળતાપૂર્વક ચકાસાયો
                                    </div>

                                    <!-- New PIN -->

                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            નવો 6 અંકનો PIN
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="bx bx-lock"></i>
                                            </span>

                                            <input
                                                type="password"
                                                class="form-control"
                                                id="newPin"
                                                name="new_pin"
                                                maxlength="6"
                                                placeholder="******"
                                                inputmode="numeric"
                                            >

                                            <button
                                                class="btn btn-outline-secondary"
                                                type="button"
                                                onclick="togglePin('newPin','eyeIcon1')"
                                            >
                                                <i class="bx bx-show" id="eyeIcon1"></i>
                                            </button>

                                        </div>

                                        <div class="pin-strength">
                                            <div class="pin-strength-bar"></div>
                                        </div>

                                    </div>

                                    <!-- Confirm PIN -->

                                    <div class="mb-4">

                                        <label class="form-label fw-semibold">
                                            PIN ફરીથી દાખલ કરો
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="bx bx-lock-alt"></i>
                                            </span>

                                            <input
                                                type="password"
                                                class="form-control"
                                                id="confirmPin"
                                                name="confirm_pin"
                                                maxlength="6"
                                                placeholder="******"
                                                inputmode="numeric"
                                            >

                                            <button
                                                class="btn btn-outline-secondary"
                                                type="button"
                                                onclick="togglePin('confirmPin','eyeIcon2')"
                                            >
                                                <i class="bx bx-show" id="eyeIcon2"></i>
                                            </button>

                                        </div>

                                    </div>

                                    <button
                                        type="submit"
                                        class="btn btn-primary w-100 btn-login"
                                        id="resetBtn"
                                    >

                                        <i class="bx bx-check-shield me-2"></i>

                                        <span id="resetBtnText">PIN રીસેટ કરો</span>

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

    <script>

        function togglePin(inputId, iconId) {

            const pin = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (pin.type === "password") {
                pin.type = "text";
                icon.classList.remove("bx-show");
                icon.classList.add("bx-hide");
            } else {
                pin.type = "password";
                icon.classList.remove("bx-hide");
                icon.classList.add("bx-show");
            }

        }

        document.addEventListener('DOMContentLoaded', function () {

            const otpBoxes = document.querySelectorAll('.otp-box');
            const otpForm = document.getElementById('otpForm');
            const pinForm = document.getElementById('pinForm');
            const verifyOtpBtn = document.getElementById('verifyOtpBtn');
            const verifyOtpBtnText = document.getElementById('verifyOtpBtnText');

            const newPin = document.getElementById('newPin');
            const confirmPin = document.getElementById('confirmPin');
            const resetBtn = document.getElementById('resetBtn');
            const resetBtnText = document.getElementById('resetBtnText');

            const resendLink = document.getElementById('resendOtpLink');
            const timerText = document.getElementById('otpTimer');

            const pageTitle = document.getElementById('pageTitle');
            const pageSubtitle = document.getElementById('pageSubtitle');
            const stepDot3 = document.getElementById('stepDot3');

            // ==========================================
            // OTP BOX BEHAVIOR (type, backspace, paste)
            // ==========================================

            otpBoxes.forEach((box, index) => {

                box.addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 1);
                    if (this.value.length === 1 && otpBoxes[index + 1]) {
                        otpBoxes[index + 1].focus();
                    }
                });

                box.addEventListener('keydown', function (e) {
                    if (e.key === 'Backspace' && this.value === '' && otpBoxes[index - 1]) {
                        otpBoxes[index - 1].focus();
                    }
                });

                // Allow pasting the whole OTP into any box
                box.addEventListener('paste', function (e) {

                    e.preventDefault();

                    const pasted = (e.clipboardData || window.clipboardData)
                        .getData('text')
                        .replace(/[^0-9]/g, '')
                        .slice(0, otpBoxes.length);

                    if (pasted.length === 0) return;

                    pasted.split('').forEach((digit, i) => {
                        if (otpBoxes[i]) {
                            otpBoxes[i].value = digit;
                        }
                    });

                    const nextIndex = Math.min(pasted.length, otpBoxes.length - 1);
                    otpBoxes[nextIndex].focus();

                });

            });

            // ==========================================
            // PIN inputs -> digits only
            // ==========================================

            [newPin, confirmPin].forEach(input => {
                input.addEventListener('input', function () {
                    this.value = this.value.replace(/\D/g, '').slice(0, 6);
                });
            });

            // PIN strength bar
            newPin.addEventListener('input', function () {

                const bar = document.querySelector('.pin-strength-bar');
                const len = this.value.length;
                const pct = Math.min((len / 6) * 100, 100);

                bar.style.width = pct + '%';

                if (len < 4) {
                    bar.style.background = '#dc3545';
                } else if (len < 6) {
                    bar.style.background = '#fd7e14';
                } else {
                    bar.style.background = '#198754';
                }

            });

            // ==========================================
            // Resend countdown timer
            // ==========================================

            let interval;

            function startTimer() {

                let timeLeft = 60;

                resendLink.classList.add('disabled', 'text-muted');

                clearInterval(interval);

                interval = setInterval(function () {

                    timeLeft--;

                    const m = String(Math.floor(timeLeft / 60)).padStart(2, '0');
                    const s = String(timeLeft % 60).padStart(2, '0');
                    timerText.innerText = `${m}:${s}`;

                    if (timeLeft <= 0) {
                        clearInterval(interval);
                        resendLink.classList.remove('disabled', 'text-muted');
                        timerText.innerText = '';
                    }

                }, 1000);

            }

            startTimer();

            // Resend OTP click (with loading state)
            resendLink.addEventListener('click', function (e) {

                e.preventDefault();

                if (this.classList.contains('disabled')) return;

                const originalText = resendLink.innerText;
                resendLink.innerText = 'મોકલી રહ્યું છે...';
                resendLink.classList.add('disabled', 'text-muted');

                fetch("{{ route('reset.password.resend-otp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                })

                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) throw { status: response.status, data };
                    return data;
                })

                .then(data => {

                    resendLink.innerText = originalText;

                    if (data.status) {
                        GlassToast.success('સફળતા', data.message);
                        otpBoxes.forEach(box => {
                            box.value = '';
                            box.classList.remove('is-valid');
                        });
                        otpBoxes[0].focus();
                        startTimer();
                    } else {
                        GlassToast.error('ભૂલ', data.message);
                        resendLink.classList.remove('disabled', 'text-muted');
                    }

                })

                .catch(error => {
                    console.log(error);
                    resendLink.innerText = originalText;
                    resendLink.classList.remove('disabled', 'text-muted');
                    GlassToast.error('ભૂલ', 'કંઈક ખોટું થયું. કૃપા કરીને ફરી પ્રયાસ કરો.');
                });

            });

            // ==========================================
            // STEP A: Verify OTP
            // ==========================================

            otpForm.addEventListener('submit', function (e) {

                e.preventDefault();

                const otp = Array.from(otpBoxes).map(b => b.value).join('');

                if (otp.length !== 4) {
                    GlassToast.warning('ચેતવણી', 'સંપૂર્ણ 4 અંકનો OTP દાખલ કરો.');
                    otpBoxes[0].focus();
                    return;
                }

                verifyOtpBtn.disabled = true;
                verifyOtpBtnText.innerText = 'ચકાસી રહ્યું છે...';

                fetch("{{ route('reset.password.verify-otp') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ otp: otp }),
                })

                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) throw { status: response.status, data };
                    return data;
                })

                .then(data => {

                    if (data.status) {

                        GlassToast.success('સફળતા', data.message);

                        otpBoxes.forEach(box => box.classList.add('is-valid'));
                        clearInterval(interval);

                        setTimeout(function () {

                            otpForm.style.display = 'none';
                            pinForm.style.display = 'block';

                            pageTitle.innerText = 'નવો PIN સેટ કરો';
                            pageSubtitle.innerText = 'તમારો નવો 6 અંકનો PIN દાખલ કરો';
                            stepDot3.classList.add('active');

                            newPin.focus();

                        }, 600);

                    } else {

                        GlassToast.error('ભૂલ', data.message);
                        verifyOtpBtn.disabled = false;
                        verifyOtpBtnText.innerText = 'OTP ચકાસો';

                    }

                })

                .catch(error => {

                    console.log(error);

                    if (error.status === 422 && error.data) {

                        if (error.data.errors) {
                            const firstErrorKey = Object.keys(error.data.errors)[0];
                            GlassToast.error('ભૂલ', error.data.errors[firstErrorKey][0]);
                        } else if (error.data.message) {
                            GlassToast.error('ભૂલ', error.data.message);
                        }

                    } else if (error.status === 440 && error.data) {

                        GlassToast.error('ભૂલ', error.data.message);

                        setTimeout(function () {
                            window.location.href = "{{ route('forgot.password.form') }}";
                        }, 1500);

                    } else {
                        GlassToast.error('ભૂલ', 'કંઈક ખોટું થયું. કૃપા કરીને ફરી પ્રયાસ કરો.');
                    }

                    verifyOtpBtn.disabled = false;
                    verifyOtpBtnText.innerText = 'OTP ચકાસો';

                });

            });

            // ==========================================
            // STEP B: Set new PIN
            // ==========================================

            pinForm.addEventListener('submit', function (e) {

                e.preventDefault();

                const newPinValue = newPin.value.trim();
                const confirmPinValue = confirmPin.value.trim();

                if (newPinValue.length !== 6) {
                    GlassToast.warning('ચેતવણી', 'નવો 6 અંકનો PIN દાખલ કરો.');
                    newPin.focus();
                    return;
                }

                if (confirmPinValue.length !== 6) {
                    GlassToast.warning('ચેતવણી', 'PIN ફરીથી દાખલ કરો.');
                    confirmPin.focus();
                    return;
                }

                if (newPinValue !== confirmPinValue) {
                    GlassToast.error('ભૂલ', 'બંને PIN સરખા હોવા જોઈએ.');
                    confirmPin.focus();
                    return;
                }

                resetBtn.disabled = true;
                resetBtnText.innerText = 'સાચવી રહ્યું છે...';

                fetch("{{ route('reset.password.verify') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        new_pin: newPinValue,
                        confirm_pin: confirmPinValue,
                    }),
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
                        }, 1200);

                    } else {
                        GlassToast.error('ભૂલ', data.message);
                        resetBtn.disabled = false;
                        resetBtnText.innerText = 'PIN રીસેટ કરો';
                    }

                })

                .catch(error => {

                    console.log(error);

                    if (error.status === 422 && error.data) {

                        if (error.data.errors) {
                            const firstErrorKey = Object.keys(error.data.errors)[0];
                            GlassToast.error('ભૂલ', error.data.errors[firstErrorKey][0]);
                        } else if (error.data.message) {
                            GlassToast.error('ભૂલ', error.data.message);
                        }

                    } else if (error.status === 440 && error.data) {

                        GlassToast.error('ભૂલ', error.data.message);

                        setTimeout(function () {
                            window.location.href = "{{ route('forgot.password.form') }}";
                        }, 1500);

                    } else {
                        GlassToast.error('ભૂલ', 'કંઈક ખોટું થયું. કૃપા કરીને ફરી પ્રયાસ કરો.');
                    }

                    resetBtn.disabled = false;
                    resetBtnText.innerText = 'PIN રીસેટ કરો';

                });

            });

        });

    </script>

    <script src="https://cdn.jsdelivr.net/gh/Vijayparmar03/GlassToast@main/vijay.js"></script>

</body>

</html>
