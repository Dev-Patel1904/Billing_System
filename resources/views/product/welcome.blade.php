<!DOCTYPE html>
<html lang="gu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

     <!-- STEP 1: Font Awesome CDN (Required for icons) -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

     <!-- STEP 2: GlassToast CSS -->
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
                                <i class="bx bx-receipt"></i>
                            </div>

                            <h2 class="fw-bold mb-3">
                                Billing System
                            </h2>

                            <h5 class="mb-3">
                                ઝડપથી અને સરળતાથી બિલ બનાવો
                            </h5>

                            <p class="opacity-75 mb-4">
                                ગ્રાહકો, પ્રોડક્ટ્સ, ખરીદી, સપ્લાયર અને બિલનું સરળ સંચાલન.
                            </p>

                            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="img-fluid">

                        </div>

                        <!-- Right -->
                        <div class="col-lg-6 bg-white">

                            <div class="p-5">

                                <div class="text-center mb-4">

                                    <i class="bx bx-lock-alt text-primary" style="font-size:60px;"></i>

                                    <h2 class="login-title mt-3">
                                        લોગિન કરો
                                    </h2>

                                    <p class="text-muted">
                                        મોબાઇલ નંબર અને 6 અંકનો PIN દાખલ કરો
                                    </p>

                                </div>

                                <form id="adminLoginForm">

                                    @csrf

                                    <!-- Mobile -->

                                    <div class="mb-3">

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

                                    </div>

                                    <!-- PIN -->

                                    <div class="mb-3">

                                        <label class="form-label fw-semibold">
                                            6 અંકનો PIN
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="bx bx-lock"></i>
                                            </span>

                                            <input
                                                type="password"
                                                class="form-control"
                                                id="pin"
                                                name="pin"
                                                maxlength="6"
                                                placeholder="******"
                                                inputmode="numeric"
                                                autocomplete="current-password"
                                            >

                                            <button
                                                class="btn btn-outline-secondary"
                                                type="button"
                                                onclick="togglePin()"
                                            >

                                                <i class="bx bx-show" id="eyeIcon"></i>

                                            </button>

                                        </div>

                                    </div>

                                    <div class="d-flex justify-content-between align-items-center mb-4">

                                        <div class="form-check">

                                            <input
                                                class="form-check-input"
                                                type="checkbox"
                                                id="remember"
                                                name="remember"
                                            >

                                            <label class="form-check-label" for="remember">
                                                મને યાદ રાખો
                                            </label>

                                        </div>

                                        <a href="#" class="text-decoration-none">
                                            PIN ભૂલી ગયા?
                                        </a>

                                    </div>

                                    <button
                                        type="submit"
                                        class="btn btn-primary w-100 btn-login"
                                        id="loginBtn"
                                    >

                                        <i class="bx bx-log-in-circle me-2"></i>

                                        <span id="loginBtnText">લોગિન કરો</span>

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

        function togglePin() {

            const pin = document.getElementById("pin");

            const icon = document.getElementById("eyeIcon");

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

    </script>
    <!-- STEP 3: GlassToast JS -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const form = document.getElementById('adminLoginForm');
            const mobile = document.getElementById('mobile');
            const pin = document.getElementById('pin');
            const loginBtn = document.getElementById('loginBtn');
            const loginBtnText = document.getElementById('loginBtnText');

            // Allow only numbers in mobile
            mobile.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
            });

            // Allow only numbers in PIN
            pin.addEventListener('input', function () {
                this.value = this.value.replace(/\D/g, '').slice(0, 6);
            });

            form.addEventListener('submit', function (e) {

                e.preventDefault();

                const mobileValue = mobile.value.trim();
                const pinValue = pin.value.trim();

                // Mobile validation
                if (mobileValue === '') {
                    GlassToast.warning(
                        "ચેતવણી",
                        "મોબાઇલ નંબર દાખલ કરો."
                    );

                    mobile.focus();
                    return;
                }

                if (!/^[6-9][0-9]{9}$/.test(mobileValue)) {
                    GlassToast.error(
                        "ભૂલ",
                        "માન્ય 10 અંકનો મોબાઇલ નંબર દાખલ કરો."
                    );

                    mobile.focus();
                    return;
                }

                // PIN validation
                if (pinValue === '') {
                    GlassToast.warning(
                        "ચેતવણી",
                        "6 અંકનો PIN દાખલ કરો."
                    );

                    pin.focus();
                    return;
                }

                if (!/^[0-9]{6}$/.test(pinValue)) {
                    GlassToast.error(
                        "ભૂલ",
                        "PIN ચોક્કસ 6 અંકનો હોવો જોઈએ."
                    );

                    pin.focus();
                    return;
                }

                // Disable button
                loginBtn.disabled = true;
                loginBtnText.innerText = "લોગિન થઈ રહ્યું છે...";

                const formData = new FormData(form);

                fetch("{{ route('admin.login.submit') }}", {

                    method: "POST",

                    headers: {
                        "X-CSRF-TOKEN": document.querySelector(
                            'input[name="_token"]'
                        ).value,

                        "Accept": "application/json"
                    },

                    body: formData

                })

                .then(async response => {

                    const data = await response.json();

                    if (!response.ok) {
                        throw {
                            status: response.status,
                            data: data
                        };
                    }

                    return data;
                })

                .then(data => {

                    if (data.status) {

                        GlassToast.success(
                            "સફળતા",
                            data.message
                        );

                        setTimeout(function () {
                            window.location.href = data.redirect;
                        }, 1000);

                    } else {

                        GlassToast.error(
                            "લોગિન નિષ્ફળ",
                            data.message
                        );

                        loginBtn.disabled = false;
                        loginBtnText.innerText = "લોગિન કરો";
                    }

                })

                .catch(error => {

                    console.log(error);

                    // Laravel validation errors
                    if (
                        error.status === 422 &&
                        error.data &&
                        error.data.errors
                    ) {

                        const errors = error.data.errors;

                        if (errors.mobile) {

                            GlassToast.error(
                                "મોબાઇલ નંબર",
                                errors.mobile[0]
                            );

                        } else if (errors.pin) {

                            GlassToast.error(
                                "PIN",
                                errors.pin[0]
                            );

                        }

                    }

                    // Wrong login
                    else if (
                        error.status === 401 &&
                        error.data
                    ) {

                        GlassToast.error(
                            "લોગિન નિષ્ફળ",
                            error.data.message
                        );

                    }

                    // Other error
                    else {

                        GlassToast.error(
                            "ભૂલ",
                            "કંઈક ખોટું થયું. કૃપા કરીને ફરી પ્રયાસ કરો."
                        );
                    }

                    loginBtn.disabled = false;
                    loginBtnText.innerText = "લોગિન કરો";

                });

            });

        });
        </script>
<script src="https://cdn.jsdelivr.net/gh/Vijayparmar03/GlassToast@main/vijay.js"></script>
</body>

</html>
