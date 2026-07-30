@include('layout.sidebar')


                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                        <div class="row justify-content-center">

                            <div class="col-xl-6 col-lg-8">

                                <div class="card border-0 shadow-lg rounded-4 mt-4">

                                    <!-- Header -->
                                    <div class="card-header bg-primary text-white rounded-top-4 py-4">
                                        <div class="d-flex align-items-center">

                                            <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3"
                                                style="width:55px;height:55px;">
                                                <i class="bx bx-lock-alt fs-2"></i>
                                            </div>

                                            <div>
                                                <h4 class="mb-0 fw-bold">પાસવર્ડ બદલો</h4>
                                                <small class="text-white-50">
                                                    તમારું એકાઉન્ટ સુરક્ષિત રાખવા પાસવર્ડ અપડેટ કરો
                                                </small>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="card-body p-4 p-md-5">

                                        <form id="changePasswordForm">

                                            <!-- Old Password -->
                                            <div class="mb-4">

                                                <label class="form-label fw-semibold">
                                                    જૂનો પાસવર્ડ
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text">
                                                        <i class="bx bx-lock"></i>
                                                    </span>

                                                    <input type="password" class="form-control" id="old_password"
                                                        maxlength="6" inputmode="numeric" placeholder="******"
                                                        autocomplete="current-password">

                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('old_password', this)">
                                                        <i class="bx bx-show"></i>
                                                    </button>

                                                </div>

                                            </div>

                                            <!-- New Password -->
                                            <div class="mb-4">

                                                <label class="form-label fw-semibold">
                                                    નવો પાસવર્ડ
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text">
                                                        <i class="bx bx-key"></i>
                                                    </span>

                                                    <input type="password" class="form-control" id="new_password"
                                                        maxlength="6" inputmode="numeric" placeholder="******"
                                                        autocomplete="new-password">

                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password', this)">
                                                        <i class="bx bx-show"></i>
                                                    </button>

                                                </div>

                                                <small class="text-muted">
                                                    પાસવર્ડ ચોક્કસ 6 અંકનો હોવો જોઈએ.
                                                </small>

                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="mb-4">

                                                <label class="form-label fw-semibold">
                                                    પાસવર્ડ કન્ફર્મ કરો
                                                </label>

                                                <div class="input-group">

                                                    <span class="input-group-text">
                                                        <i class="bx bx-check-shield"></i>
                                                    </span>

                                                    <input type="password" class="form-control" id="confirm_password"
                                                        maxlength="6" inputmode="numeric" placeholder="******"
                                                        autocomplete="new-password">

                                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password', this)">
                                                        <i class="bx bx-show"></i>
                                                    </button>

                                                </div>

                                            </div>

                                            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold" id="changePasswordBtn">
                                                <i class="bx bx-save me-1"></i>
                                                <span id="changePasswordText">પાસવર્ડ અપડેટ કરો</span>
                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- / Content -->

{{-- TOGGLE PASSWORD VISIBILITY --}}
<script>
    function togglePassword(inputId, btn) {

        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');

        if (input.type === 'password') {

            input.type = 'text';
            icon.classList.remove('bx-show');
            icon.classList.add('bx-hide');

        } else {

            input.type = 'password';
            icon.classList.remove('bx-hide');
            icon.classList.add('bx-show');

        }

    }
</script>

{{-- CHANGE PASSWORD --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('changePasswordForm');

        const oldPassword = document.getElementById('old_password');
        const newPassword = document.getElementById('new_password');
        const confirmPassword = document.getElementById('confirm_password');

        const submitBtn = document.getElementById('changePasswordBtn');
        const submitText = document.getElementById('changePasswordText');

        // ONLY NUMBERS + MAX 6 DIGITS
        [oldPassword, newPassword, confirmPassword].forEach(function (input) {
            input.addEventListener('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);
            });
        });

        form.addEventListener('submit', async function (e) {

            e.preventDefault();

            const oldValue = oldPassword.value.trim();
            const newValue = newPassword.value.trim();
            const confirmValue = confirmPassword.value.trim();

            if (oldValue === '') {
                GlassToast.warning('ચેતવણી', 'જૂનો પાસવર્ડ દાખલ કરો.');
                oldPassword.focus();
                return;
            }

            if (oldValue.length !== 6) {
                GlassToast.error('ભૂલ', 'જૂનો પાસવર્ડ 6 અંકનો હોવો જોઈએ.');
                oldPassword.focus();
                return;
            }

            if (newValue === '') {
                GlassToast.warning('ચેતવણી', 'નવો પાસવર્ડ દાખલ કરો.');
                newPassword.focus();
                return;
            }

            if (newValue.length !== 6) {
                GlassToast.error('ભૂલ', 'નવો પાસવર્ડ 6 અંકનો હોવો જોઈએ.');
                newPassword.focus();
                return;
            }

            if (confirmValue === '') {
                GlassToast.warning('ચેતવણી', 'પાસવર્ડ કન્ફર્મ કરો.');
                confirmPassword.focus();
                return;
            }

            if (newValue !== confirmValue) {
                GlassToast.error('ભૂલ', 'નવો પાસવર્ડ અને કન્ફર્મ પાસવર્ડ મેળ ખાતા નથી.');
                confirmPassword.focus();
                return;
            }

            if (newValue === oldValue) {
                GlassToast.warning('ચેતવણી', 'નવો પાસવર્ડ જૂના પાસવર્ડ કરતાં અલગ હોવો જોઈએ.');
                newPassword.focus();
                return;
            }

            submitBtn.disabled = true;
            submitText.innerText = 'અપડેટ થઈ રહ્યું છે...';

            try {

                const response = await fetch("{{ route('settings.update_password') }}", {

                    method: 'PUT',

                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },

                    body: JSON.stringify({
                        old_password: oldValue,
                        new_password: newValue,
                        confirm_password: confirmValue,
                    }),

                });

                const data = await response.json();

                if (response.ok && data.status === true) {

                    GlassToast.success('સફળતા', data.message);

                    form.reset();

                } else if (response.status === 422 && data.errors) {

                    const firstErrorKey = Object.keys(data.errors)[0];
                    GlassToast.error('ભૂલ', data.errors[firstErrorKey][0]);

                } else if (response.status === 401) {

                    GlassToast.error('ભૂલ', data.message || 'જૂનો પાસવર્ડ ખોટો છે.');

                } else {

                    GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

                }

            } catch (error) {

                console.error('Change Password Error:', error);
                GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

            } finally {

                submitBtn.disabled = false;
                submitText.innerText = 'પાસવર્ડ અપડેટ કરો';

            }

        });

    });
</script>

                    @include('layout.footer')
