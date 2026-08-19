@include('layout.sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">

   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">

      <!-- ================= FULL WIDTH TABS ================= -->
      <div class="card border-0 shadow-sm rounded-4 mb-4">

         <div class="card-header bg-primary text-white rounded-4 py-3">

            <div class="d-flex align-items-center gap-2">

               <!-- Password Tab -->
               <button type="button" class="btn btn-light fw-semibold px-4 py-2" id="passwordTab">

                  <i class="bx bx-lock-alt me-1"></i>
                  પાસવર્ડ બદલો

               </button>


               <!-- Type Tab -->
               <button type="button" class="btn btn-outline-light fw-semibold px-4 py-2" id="typeTab">

                  <i class="bx bx-category me-1"></i>
                  પ્રકાર

               </button>

            </div>

         </div>

      </div>


      <!-- ================= CENTER CONTENT ================= -->
      <div class="row justify-content-center">

         <div class="col-xl-12 col-lg-12 col-md-12">


            <!-- ================================================= -->
            <!-- PASSWORD SECTION -->
            <!-- ================================================= -->

            <div id="passwordSection" class="col-xl-6 col-lg-7 col-md-8 mx-auto">

               <div class="card border-0 shadow-lg rounded-4">

                  <!-- Password Header -->
                  <div class="card-header bg-primary text-white rounded-top-4 py-4">

                     <div class="d-flex align-items-center">

                        <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3" style="width:55px;height:55px;">

                           <i class="bx bx-lock-alt fs-2"></i>

                        </div>


                        <div>

                           <h4 class="mb-0 fw-bold">
                              પાસવર્ડ બદલો
                           </h4>

                           <small class="text-white-50">
                              તમારું એકાઉન્ટ સુરક્ષિત રાખવા પાસવર્ડ અપડેટ કરો
                           </small>

                        </div>

                     </div>

                  </div>


                  <!-- Password Form -->
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


                              <input type="password" class="form-control" id="old_password" maxlength="6" inputmode="numeric" placeholder="******" autocomplete="current-password">


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


                              <input type="password" class="form-control" id="new_password" maxlength="6" inputmode="numeric" placeholder="******" autocomplete="new-password">


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


                              <input type="password" class="form-control" id="confirm_password" maxlength="6" inputmode="numeric" placeholder="******" autocomplete="new-password">


                              <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('confirm_password', this)">

                                 <i class="bx bx-show"></i>

                              </button>

                           </div>

                        </div>


                        <!-- Submit -->
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold" id="changePasswordBtn">

                           <i class="bx bx-save me-1"></i>

                           <span id="changePasswordText">
                              પાસવર્ડ અપડેટ કરો
                           </span>

                        </button>

                     </form>

                  </div>

               </div>

            </div>


            <!-- ================================================= -->
            <!-- TYPE SECTION -->
            <!-- ================================================= -->

            <div id="typeSection" style="display:none;">

               <div class="row g-4">

                  <!-- ================================================= -->
                  <!-- ADD TYPE -->
                  <!-- ================================================= -->

                  <div class="col-md-6">

                     <div class="card border-0 shadow-lg rounded-4 h-100">

                        <!-- Type Header -->
                        <div class="card-header bg-primary text-white rounded-top-4 py-4">

                           <div class="d-flex align-items-center">

                              <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3" style="width:55px;height:55px;">

                                 <i class="bx bx-category fs-2"></i>

                              </div>

                              <div>

                                 <h4 class="mb-0 fw-bold">
                                    પ્રકાર
                                 </h4>

                                 <small class="text-white-50">
                                    નવો પ્રકાર ઉમેરો
                                 </small>

                              </div>

                           </div>

                        </div>


                        <!-- Type Form -->
                        <div class="card-body p-4 p-md-5">

                           <form id="typeForm">

                              <div class="mb-4">

                                 <label class="form-label fw-semibold">
                                    પ્રકાર
                                 </label>

                                 <div class="input-group">

                                    <span class="input-group-text">
                                       <i class="bx bx-category"></i>
                                    </span>

                                    <input type="text" class="form-control" id="type" name="type" placeholder="પ્રકાર દાખલ કરો">

                                 </div>

                              </div>


                              <!-- Save Type -->
                              <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold" id="typeSaveBtn">

                                 <i class="bx bx-save me-1"></i>

                                 <span id="typeSaveText">
                                    પ્રકાર સેવ કરો
                                 </span>

                              </button>

                           </form>

                        </div>

                     </div>

                  </div>


                  <!-- ================================================= -->
                  <!-- EXISTING TYPES - SELECT & EDIT -->
                  <!-- ================================================= -->

                  <div class="col-md-6">

                     <div class="card border-0 shadow-lg rounded-4 h-100">

                        <!-- Existing Types Header -->
                        <div class="card-header bg-primary text-white rounded-top-4 py-4">

                           <div class="d-flex align-items-center">

                              <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3" style="width:55px;height:55px;">

                                 <i class="bx bx-edit-alt fs-2"></i>

                              </div>

                              <div>

                                 <h4 class="mb-0 fw-bold">
                                    પ્રકાર સંપાદિત કરો
                                 </h4>

                                 <small class="text-white-50">
                                    હાલનો પ્રકાર પસંદ કરો અને બદલો
                                 </small>

                              </div>

                           </div>

                        </div>


                        <!-- Existing Types Form -->
                        <div class="card-body p-4 p-md-5">

                           <form id="typeEditForm">

                              <input type="hidden" id="edit_type_id">

                              <div class="row g-3">

                                 <!-- Select Existing Type -->
                                 <div class="col-12">

                                    <label class="form-label fw-semibold">
                                       પ્રકાર પસંદ કરો
                                    </label>

                                    <select class="form-select" id="existingTypeSelect">

                                       <option value="">
                                          પ્રકાર પસંદ કરો
                                       </option>

                                       @foreach ($types as $type)

                                       <option value="{{ $type->id }}" data-name="{{ $type->name }}">

                                          {{ $type->name }}

                                       </option>

                                       @endforeach

                                    </select>

                                 </div>


                                 <!-- Edit Type -->
                                 <div class="col-12">

                                    <label class="form-label fw-semibold">
                                       પ્રકારનું નામ
                                    </label>

                                    <input type="text" class="form-control" id="edit_type_name" placeholder="પસંદ કરેલ પ્રકાર અહીં દેખાશે" disabled>

                                 </div>

                              </div>


                              <!-- Update -->
                              <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mt-4" id="typeUpdateBtn" disabled>

                                 <i class="bx bx-save me-1"></i>

                                 <span id="typeUpdateText">
                                    અપડેટ કરો
                                 </span>

                              </button>

                           </form>

                        </div>

                     </div>

                  </div>

               </div>

            </div>


         </div>

      </div>

   </div>

   <!-- / Content -->


   <!-- ========================================================= -->
   <!-- TOGGLE PASSWORD VISIBILITY -->
   <!-- ========================================================= -->

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


   <!-- ========================================================= -->
   <!-- CHANGE PASSWORD -->
   <!-- ========================================================= -->

   <script>
      document.addEventListener('DOMContentLoaded', function() {

         const form = document.getElementById('changePasswordForm');

         const oldPassword =
            document.getElementById('old_password');

         const newPassword =
            document.getElementById('new_password');

         const confirmPassword =
            document.getElementById('confirm_password');


         const submitBtn =
            document.getElementById('changePasswordBtn');

         const submitText =
            document.getElementById('changePasswordText');


         // ONLY NUMBERS + MAX 6 DIGITS
         [oldPassword, newPassword, confirmPassword].forEach(function(input) {

            input.addEventListener('input', function() {

               this.value = this.value
                  .replace(/[^0-9]/g, '')
                  .slice(0, 6);

            });

         });


         form.addEventListener('submit', async function(e) {

            e.preventDefault();


            const oldValue =
               oldPassword.value.trim();

            const newValue =
               newPassword.value.trim();

            const confirmValue =
               confirmPassword.value.trim();


            // OLD PASSWORD
            if (oldValue === '') {

               GlassToast.warning(
                  'ચેતવણી'
                  , 'જૂનો પાસવર્ડ દાખલ કરો.'
               );

               oldPassword.focus();

               return;
            }


            if (oldValue.length !== 6) {

               GlassToast.error(
                  'ભૂલ'
                  , 'જૂનો પાસવર્ડ 6 અંકનો હોવો જોઈએ.'
               );

               oldPassword.focus();

               return;
            }


            // NEW PASSWORD
            if (newValue === '') {

               GlassToast.warning(
                  'ચેતવણી'
                  , 'નવો પાસવર્ડ દાખલ કરો.'
               );

               newPassword.focus();

               return;
            }


            if (newValue.length !== 6) {

               GlassToast.error(
                  'ભૂલ'
                  , 'નવો પાસવર્ડ 6 અંકનો હોવો જોઈએ.'
               );

               newPassword.focus();

               return;
            }


            // CONFIRM PASSWORD
            if (confirmValue === '') {

               GlassToast.warning(
                  'ચેતવણી'
                  , 'પાસવર્ડ કન્ફર્મ કરો.'
               );

               confirmPassword.focus();

               return;
            }


            if (newValue !== confirmValue) {

               GlassToast.error(
                  'ભૂલ'
                  , 'નવો પાસવર્ડ અને કન્ફર્મ પાસવર્ડ મેળ ખાતા નથી.'
               );

               confirmPassword.focus();

               return;
            }


            // SAME PASSWORD
            if (newValue === oldValue) {

               GlassToast.warning(
                  'ચેતવણી'
                  , 'નવો પાસવર્ડ જૂના પાસવર્ડ કરતાં અલગ હોવો જોઈએ.'
               );

               newPassword.focus();

               return;
            }


            submitBtn.disabled = true;

            submitText.innerText =
               'અપડેટ થઈ રહ્યું છે...';


            try {

               const response = await fetch(
                  "{{ route('settings.update_password') }}", {
                     method: 'PUT',

                     headers: {
                        'Content-Type': 'application/json',

                        'X-CSRF-TOKEN': document.querySelector(
                           'meta[name="csrf-token"]'
                        ).content,

                        'Accept': 'application/json'
                     },

                     body: JSON.stringify({

                        old_password: oldValue,

                        new_password: newValue,

                        confirm_password: confirmValue

                     })
                  }
               );


               const data = await response.json();


               if (response.ok && data.status === true) {

                  GlassToast.success(
                     'સફળતા'
                     , data.message
                  );

                  form.reset();

               } else if (
                  response.status === 422 &&
                  data.errors
               ) {

                  const firstErrorKey =
                     Object.keys(data.errors)[0];


                  GlassToast.error(
                     'ભૂલ'
                     , data.errors[firstErrorKey][0]
                  );

               } else if (response.status === 401) {

                  GlassToast.error(
                     'ભૂલ'
                     , data.message ||
                     'જૂનો પાસવર્ડ ખોટો છે.'
                  );

               } else {

                  GlassToast.error(
                     'ભૂલ'
                     , data.message ||
                     'કંઈક ખોટું થયું.'
                  );

               }


            } catch (error) {

               console.error(
                  'Change Password Error:'
                  , error
               );


               GlassToast.error(
                  'ભૂલ'
                  , 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.'
               );

            } finally {

               submitBtn.disabled = false;

               submitText.innerText =
                  'પાસવર્ડ અપડેટ કરો';

            }

         });

      });

   </script>


   <!-- ========================================================= -->
   <!-- CHANGE TABS -->
   <!-- ========================================================= -->

   <script>
      document.addEventListener('DOMContentLoaded', function() {

         const passwordTab =
            document.getElementById('passwordTab');

         const typeTab =
            document.getElementById('typeTab');


         const passwordSection =
            document.getElementById('passwordSection');

         const typeSection =
            document.getElementById('typeSection');


         // PASSWORD TAB
         passwordTab.addEventListener('click', function() {

            passwordSection.style.display = 'block';

            typeSection.style.display = 'none';


            // Active
            passwordTab.classList.remove(
               'btn-outline-light'
            );

            passwordTab.classList.add(
               'btn-light'
            );


            // Inactive
            typeTab.classList.remove(
               'btn-light'
            );

            typeTab.classList.add(
               'btn-outline-light'
            );

         });


         // TYPE TAB
         typeTab.addEventListener('click', function() {

            passwordSection.style.display = 'none';

            typeSection.style.display = 'block';


            // Active
            typeTab.classList.remove(
               'btn-outline-light'
            );

            typeTab.classList.add(
               'btn-light'
            );


            // Inactive
            passwordTab.classList.remove(
               'btn-light'
            );

            passwordTab.classList.add(
               'btn-outline-light'
            );

         });

      });

   </script>



   <!-- ========================================================= -->
   <!-- ADD NEW TYPE -->
   <!-- ========================================================= -->

   <script>
      document.addEventListener('DOMContentLoaded', function() {

         const typeForm = document.getElementById('typeForm');
         const typeInput = document.getElementById('type');
         const typeSaveBtn = document.getElementById('typeSaveBtn');
         const typeSaveText = document.getElementById('typeSaveText');
         const existingTypeSelect = document.getElementById('existingTypeSelect');

         typeForm.addEventListener('submit', async function(e) {

            e.preventDefault();

            const nameValue = typeInput.value.trim();

            if (nameValue === '') {
               GlassToast.warning('ચેતવણી', 'પ્રકાર દાખલ કરો.');
               typeInput.focus();
               return;
            }

            typeSaveBtn.disabled = true;
            typeSaveText.innerText = 'સેવ થઈ રહ્યું છે...';

            try {

               const response = await fetch("{{ route('types.store') }}", {

                  method: 'POST',

                  headers: {
                     'Content-Type': 'application/json'
                     , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                     , 'Accept': 'application/json'
                  , },

                  body: JSON.stringify({
                     name: nameValue
                  }),

               });

               const data = await response.json();

               if (response.ok && data.status === true) {

                  GlassToast.success('સફળતા', data.message);

                  typeForm.reset();

                  // Add the new type directly into the dropdown, no reload
                  const newOption = document.createElement('option');
                  newOption.value = data.type.id;
                  newOption.dataset.name = data.type.name;
                  newOption.textContent = data.type.name;

                  existingTypeSelect.appendChild(newOption);

               } else if (response.status === 422 && data.errors) {

                  const firstErrorKey = Object.keys(data.errors)[0];
                  GlassToast.error('ભૂલ', data.errors[firstErrorKey][0]);

               } else {

                  GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

               }

            } catch (error) {

               console.error('Add Type Error:', error);
               GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

            } finally {

               typeSaveBtn.disabled = false;
               typeSaveText.innerText = 'પ્રકાર સેવ કરો';

            }

         });

      });

   </script>


   <!-- ========================================================= -->
   <!-- SELECT + EDIT EXISTING TYPE -->
   <!-- ========================================================= -->

   <script>
      document.addEventListener('DOMContentLoaded', function() {

         const existingTypeSelect = document.getElementById('existingTypeSelect');
         const editTypeId = document.getElementById('edit_type_id');
         const editTypeName = document.getElementById('edit_type_name');
         const typeEditForm = document.getElementById('typeEditForm');
         const typeUpdateBtn = document.getElementById('typeUpdateBtn');
         const typeUpdateText = document.getElementById('typeUpdateText');

         // When a type is selected -> show it on the right, enable editing
         existingTypeSelect.addEventListener('change', function() {

            const selectedOption = this.options[this.selectedIndex];

            if (!this.value) {

               editTypeId.value = '';
               editTypeName.value = '';
               editTypeName.disabled = true;
               typeUpdateBtn.disabled = true;
               return;

            }

            editTypeId.value = this.value;
            editTypeName.value = selectedOption.dataset.name;
            editTypeName.disabled = false;
            typeUpdateBtn.disabled = false;

         });

         // Update the selected type
         typeEditForm.addEventListener('submit', async function(e) {

            e.preventDefault();

            const id = editTypeId.value;
            const nameValue = editTypeName.value.trim();

            if (!id) {
               GlassToast.warning('ચેતવણી', 'કૃપા કરીને પ્રકાર પસંદ કરો.');
               return;
            }

            if (nameValue === '') {
               GlassToast.warning('ચેતવણી', 'પ્રકાર દાખલ કરો.');
               editTypeName.focus();
               return;
            }

            typeUpdateBtn.disabled = true;
            typeUpdateText.innerText = 'અપડેટ થઈ રહ્યું છે...';

            try {

               const response = await fetch(`/types/${id}`, {

                  method: 'PUT',

                  headers: {
                     'Content-Type': 'application/json'
                     , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                     , 'Accept': 'application/json'
                  , },

                  body: JSON.stringify({
                     name: nameValue
                  }),

               });

               const data = await response.json();

               if (response.ok && data.status === true) {

                  GlassToast.success('સફળતા', data.message);

                  // Update the matching <option> in the dropdown directly, no reload
                  const optionToUpdate = existingTypeSelect.querySelector(`option[value="${id}"]`);

                  if (optionToUpdate) {
                     optionToUpdate.dataset.name = data.type.name;
                     optionToUpdate.textContent = data.type.name;
                  }

               } else if (response.status === 422 && data.errors) {

                  const firstErrorKey = Object.keys(data.errors)[0];
                  GlassToast.error('ભૂલ', data.errors[firstErrorKey][0]);

               } else {

                  GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

               }

            } catch (error) {

               console.error('Update Type Error:', error);
               GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

            } finally {

               typeUpdateBtn.disabled = false;
               typeUpdateText.innerText = 'અપડેટ કરો';

            }

         });

      });

   </script>

   {{-- english to gujj --}}

   <script>
      document.addEventListener('DOMContentLoaded', function() {

         const typeInput = document.getElementById('type');

         if (!typeInput) {
            return;
         }

         typeInput.addEventListener('keydown', function(e) {

            if (e.key !== 'Enter') {
               return;
            }

            e.preventDefault();

            const cursorPos = typeInput.selectionStart;

            // Get text before cursor
            const textBeforeCursor =
               typeInput.value.slice(0, cursorPos);

            // Find last English word
            const match =
               textBeforeCursor.match(/[a-zA-Z]+$/);

            if (!match) {
               return;
            }

            const englishWord = match[0];

            const wordStart =
               cursorPos - englishWord.length;

            const textAfterCursor =
               typeInput.value.slice(cursorPos);

            fetch(
                  'https://inputtools.google.com/request?' +
                  'text=' + encodeURIComponent(englishWord) +
                  '&itc=gu-t-i0-und&num=1'
               )
               .then(function(response) {
                  return response.json();
               })
               .then(function(data) {

                  if (
                     !data ||
                     data[0] !== 'SUCCESS' ||
                     !data[1] ||
                     !data[1][0] ||
                     !data[1][0][1] ||
                     !data[1][0][1][0]
                  ) {
                     return;
                  }

                  const gujaratiWord =
                     data[1][0][1][0];

                  // Replace English word with Gujarati
                  const newValue =
                     typeInput.value.slice(0, wordStart) +
                     gujaratiWord +
                     textAfterCursor;

                  typeInput.value = newValue;

                  // Move cursor after Gujarati word
                  const newCursorPos =
                     wordStart + gujaratiWord.length;

                  typeInput.setSelectionRange(
                     newCursorPos
                     , newCursorPos
                  );

               })
               .catch(function(error) {

                  console.error(
                     'Type Gujarati Transliteration Error:'
                     , error
                  );

               });

         });

      });

   </script>

   <script>
      document.addEventListener('DOMContentLoaded', function() {

         const editTypeInput =
            document.getElementById('edit_type_name');

         if (!editTypeInput) {
            return;
         }

         editTypeInput.addEventListener('keydown', function(e) {

            // Translate only on Enter
            if (e.key !== 'Enter') {
               return;
            }

            e.preventDefault();

            const cursorPos =
               editTypeInput.selectionStart;

            // Text before cursor
            const textBeforeCursor =
               editTypeInput.value.slice(0, cursorPos);

            // Find last English word
            const match =
               textBeforeCursor.match(/[a-zA-Z]+$/);

            if (!match) {
               return;
            }

            const englishWord = match[0];

            const wordStart =
               cursorPos - englishWord.length;

            const textAfterCursor =
               editTypeInput.value.slice(cursorPos);

            fetch(
                  'https://inputtools.google.com/request?' +
                  'text=' + encodeURIComponent(englishWord) +
                  '&itc=gu-t-i0-und&num=1'
               )
               .then(function(response) {
                  return response.json();
               })
               .then(function(data) {

                  if (
                     !data ||
                     data[0] !== 'SUCCESS' ||
                     !data[1] ||
                     !data[1][0] ||
                     !data[1][0][1] ||
                     !data[1][0][1][0]
                  ) {
                     return;
                  }

                  const gujaratiWord =
                     data[1][0][1][0];

                  // Replace English word with Gujarati
                  const newValue =
                     editTypeInput.value.slice(0, wordStart) +
                     gujaratiWord +
                     textAfterCursor;

                  editTypeInput.value = newValue;

                  // Move cursor after Gujarati word
                  const newCursorPos =
                     wordStart + gujaratiWord.length;

                  editTypeInput.setSelectionRange(
                     newCursorPos
                     , newCursorPos
                  );

               })
               .catch(function(error) {

                  console.error(
                     'Edit Type Gujarati Transliteration Error:'
                     , error
                  );

               });

         });

      });

   </script>


   @include('layout.footer')
