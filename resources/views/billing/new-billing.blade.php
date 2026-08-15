@include('layout.sidebar')
<style>
   /* ================================
   Premium Product Select
================================ */

   .premium-label {
      display: block;
      margin-bottom: 8px;
      font-size: 14px;
      font-weight: 600;
      color: #344054;
   }

   /* Main wrapper */
   .premium-product-wrapper {
      position: relative;
      display: flex;
      align-items: center;
      width: 100%;
      min-height: 52px;
      background: #ffffff;
      border: 1px solid #d9dee8;
      border-radius: 12px;
      transition: all 0.25s ease;
      box-shadow: 0 2px 8px rgba(16, 24, 40, 0.04);
   }

   /* Hover */
   .premium-product-wrapper:hover {
      border-color: #b8c1d1;
      box-shadow: 0 4px 14px rgba(16, 24, 40, 0.07);
   }

   /* Focus effect */
   .premium-product-wrapper:focus-within {
      border-color: #696cff;
      box-shadow:
         0 0 0 3px rgba(105, 108, 255, 0.10),
         0 5px 16px rgba(16, 24, 40, 0.06);
   }

   /* Product icon */
   .premium-product-icon {
      width: 48px;
      min-width: 48px;
      height: 52px;

      display: flex;
      align-items: center;
      justify-content: center;

      color: #696cff;
      font-size: 21px;
   }

   /* Select2 container */
   .premium-product-wrapper .select2-container {
      flex: 1;
      width: auto !important;
   }

   /* Select2 selection */
   .premium-product-wrapper .select2-container--default .select2-selection--single {
      height: 50px !important;

      display: flex !important;
      align-items: center;

      border: none !important;
      background: transparent !important;

      border-radius: 0 !important;
      box-shadow: none !important;
   }

   /* Selected text */
   .premium-product-wrapper .select2-container--default .select2-selection--single .select2-selection__rendered {

      padding-left: 0 !important;
      padding-right: 35px !important;

      font-size: 14px;
      font-weight: 500;
      color: #344054;

      line-height: normal !important;
   }

   /* Placeholder */
   .premium-product-wrapper .select2-container--default .select2-selection--single .select2-selection__placeholder {
      color: #98a2b3;
   }

   /* Arrow */
   .premium-product-wrapper .select2-container--default .select2-selection--single .select2-selection__arrow {

      height: 50px !important;
      top: 0 !important;
      right: 4px !important;

      width: 30px;
   }

   .premium-product-wrapper .select2-container--default .select2-selection--single .select2-selection__arrow b {
      border-color: #667085 transparent transparent transparent;
   }

   /* Voice button */
   .premium-voice-btn {
      width: 42px;
      height: 42px;
      min-width: 42px;

      margin-right: 6px;

      border: 0;
      border-radius: 10px;

      display: flex;
      align-items: center;
      justify-content: center;

      background: #f2f3ff;
      color: #696cff;

      font-size: 20px;

      cursor: pointer;

      transition: all 0.25s ease;
   }

   /* Voice hover */
   .premium-voice-btn:hover {
      background: #696cff;
      color: #ffffff;

      transform: translateY(-1px);

      box-shadow: 0 5px 12px rgba(105, 108, 255, 0.25);
   }

   /* Voice click */
   .premium-voice-btn:active {
      transform: scale(0.94);
   }


   /* ================================
   Select2 Dropdown
================================ */

   .select2-container--default .select2-dropdown {
      margin-top: 6px;

      border: 1px solid #e4e7ec !important;
      border-radius: 12px !important;

      overflow: hidden;

      box-shadow: 0 12px 30px rgba(16, 24, 40, 0.12);
   }

   /* Search box */
   .select2-container--default .select2-search--dropdown {
      padding: 10px;
   }

   .select2-container--default .select2-search--dropdown .select2-search__field {

      height: 42px;

      border: 1px solid #d9dee8 !important;
      border-radius: 8px;

      padding: 0 12px;

      font-size: 14px;

      outline: none;
   }

   .select2-container--default .select2-search--dropdown .select2-search__field:focus {

      border-color: #696cff !important;

      box-shadow: 0 0 0 3px rgba(105, 108, 255, 0.10);
   }

   /* Dropdown options */
   .select2-container--default .select2-results__option {

      padding: 11px 14px;

      font-size: 14px;
      color: #344054;

      transition: all 0.15s ease;
   }

   /* Hover */
   .select2-container--default .select2-results__option--highlighted[aria-selected] {

      background: #696cff !important;
      color: #ffffff !important;
   }

   /* Selected */
   .select2-container--default .select2-results__option[aria-selected="true"] {

      background: #f2f3ff;
      color: #696cff;
      font-weight: 600;
   }

</style>

<!-- Content wrapper -->
<div class="content-wrapper">
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <!-- Basic Layout -->
      <div class="row mb-6 gy-6">
         <div class="col-xl">
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">બિલ બનાવો</h5>
                  <small class="text-body float-end">ગ્રાહકની માહિતી</small>
               </div>
               <div class="card-body">
                  <form>

                     <div class="mb-3">
                        <label class="form-label">ગ્રાહકનો મોબાઇલ નંબર</label>
                        <div class="input-group">
                           <input type="text" class="form-control" id="customerMobile" placeholder="ગ્રાહકનો મોબાઇલ નંબર" maxlength="10">
                           <span class="input-group-text d-none" id="mobileLoader">
                              <span class="spinner-border spinner-border-sm text-primary" role="status"></span>
                           </span>
                        </div>
                     </div>

                     <div class="mb-0">
                        <label class="form-label">ગ્રાહકનું નામ</label>

                        <div class="input-group">
                           <input type="text" class="form-control" id="customerName" placeholder="ગ્રાહકનું નામ">

                           <!-- Loader -->
                           <span class="input-group-text d-none" id="customerNameLoader">
                              <span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
                           </span>

                           <span class="input-group-text voice-btn" id="voiceCustomerName">
                              <i class="bx bx-microphone"></i>
                           </span>
                        </div>
                     </div>

                     <!-- Product Details -->
                     <div class="card mt-3" style="box-shadow:none !important;">
                        <div id="productRows">
                           <div class="row g-3 align-items-end product-row mb-3">

                              <div class="col-md-12">

                                 <label for="productName" class="premium-label">
                                    પ્રોડક્ટનું નામ
                                 </label>

                                 <div class="premium-product-wrapper">

                                    <div class="premium-product-icon">
                                       <i class="bx bx-package"></i>
                                    </div>

                                    <select id="productName" class="form-control productName" name="product_name">

                                       <option value="">પ્રોડક્ટ પસંદ કરો</option>

                                       @foreach ($products as $product)
                                       <option value="{{ $product->product_name }}" data-prakar="{{ $product->prakar }}" data-prakar-text="{{ $product->prakar_text }}" data-rate="{{ $product->rate }}">

                                          {{ $product->product_name }}

                                       </option>
                                       @endforeach

                                    </select>

                                    <button type="button" class="premium-voice-btn voiceProduct voice-btn" title="વૉઇસ દ્વારા પ્રોડક્ટ શોધો">

                                       <i class="bx bx-microphone"></i>

                                    </button>

                                 </div>

                              </div>
                              <div id="productDetails" class="row g-3 mt-2 d-none">

                                 <!-- Prakar -->
                                 <div class="col-md-6">

                                    <label for="prakar" class="form-label">
                                       પ્રકાર
                                    </label>

                                    <select name="prakar" id="prakar" class="form-select">

                                       <option value="">પ્રકાર પસંદ કરો</option>

                                       <option value="quantity">જથ્થો</option>
                                       <option value="box">પેટી</option>
                                       <option value="piece">નંગ</option>
                                       <option value="kg">કિલો</option>
                                       <option value="gram">ગ્રામ</option>
                                       <option value="liter">લિટર</option>
                                       <option value="ml">મિલી લિટર</option>
                                       <option value="meter">મીટર</option>
                                       <option value="packet">પેકેટ</option>
                                       <option value="bottle">બોટલ</option>
                                       <option value="dozen">ડઝન</option>
                                       <option value="pair">જોડી</option>
                                       <option value="bundle">બંડલ</option>
                                       <option value="bag">થેલી</option>
                                       <option value="roll">રોલ</option>
                                       <option value="set">સેટ</option>

                                    </select>

                                 </div>


                                 <div class="col-md-6">
                                    <label class="form-label">નંગ / જથ્થો</label>
                                    <input type="number" id="qty" class="form-control" placeholder="0">
                                 </div>

                                 <!-- રકમ -->
                                 <div class="col-md-12">

                                    <label for="rate" class="form-label">
                                       રકમ
                                    </label>

                                    <div class="input-group">

                                       <span class="input-group-text">
                                          ₹
                                       </span>

                                       <input type="number" id="rate" name="rate" class="form-control" placeholder="0.00" min="0" step="0.01">

                                    </div>

                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <button type="button" class="btn btn-success btn-sm" id="addItem">
                                    <i class="bx bx-plus"></i>બિલમાં ઉમેરો
                                 </button>
                              </div>

                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-xl">
            <div class="card">

               <div class="card-body">

                  <form id="billForm" action="{{ route('billing.store') }}" method="POST" target="_blank">
                     @csrf

                     <!-- Hidden fields submitted with the bill -->
                     <input type="hidden" name="customer_mobile" id="hiddenCustomerMobile">
                     <input type="hidden" name="customer_name" id="hiddenCustomerName">
                     <input type="hidden" name="previous_due" id="hiddenPreviousDue" value="0">
                     <input type="hidden" name="due_paid_now" id="hiddenPaidDueAmount" value="0">
                     <input type="hidden" name="payment_type" id="hiddenPaymentType">

                     <div class="table-responsive text-nowrap mt-3">
                        <table class="table table-bordered text-center align-middle" id="productTable">

                           <thead class="table-light">
                              <tr>
                                 <th width="10%">ક્રમ</th>
                                 <th>પ્રોડક્ટનું નામ</th>
                                 <th>જથ્થો</th>
                                 <th>ભાવ (₹)</th>
                                 <th>કુલ રકમ (₹)</th>
                                 <th width="8%">એક્શન</th>

                              </tr>
                           </thead>

                           <tbody>

                           </tbody>

                        </table>
                     </div>


                     <!-- Summary -->

                     <div class="card border-0 shadow-sm mt-3">
                        <div class="card-body">

                           <div class="row align-items-center mb-3">
                              <div class="col-md-6">
                                 <label class="fw-semibold">કુલ જથ્થો</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" id="total_qty" class="form-control text-end" readonly>
                              </div>
                           </div>

                           <div class="row align-items-center mb-3">
                              <div class="col-md-6">
                                 <label class="fw-semibold">કુલ રકમ</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" id="total_amount" class="form-control text-end" readonly>
                              </div>
                           </div>

                           <div class="row align-items-center mb-3 d-none" id="previousDueRow">
                              <div class="col-md-6">
                                 <label class="fw-semibold text-danger">આગળની બાકી
                                    રકમ</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="number" id="previous_due" disabled class="form-control text-end" value="0" placeholder="₹ 0.00">
                              </div>
                           </div>

                           <div class="row align-items-center mb-3 d-none" id="payDueSection">
                              <div class="col-md-6">
                                 <label class="fw-semibold">શું બાકી રકમ ચૂકવવી છે?</label>
                              </div>

                              <div class="col-md-6">
                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pay_due" id="pay_yes" value="yes">

                                    <label class="form-check-label" for="pay_yes">
                                       હા
                                    </label>
                                 </div>

                                 <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pay_due" id="pay_no" value="no" checked>

                                    <label class="form-check-label" for="pay_no">
                                       ના
                                    </label>
                                 </div>
                              </div>
                           </div>

                           <hr>

                           <div class="row align-items-center mb-4">
                              <div class="col-md-6">
                                 <label class="fw-bold text-success fs-5">ચૂકવવાની કુલ
                                    રકમ</label>
                              </div>
                              <div class="col-md-6">
                                 <input type="text" id="grand_total" class="form-control form-control-lg fw-bold text-end border-success" readonly>
                              </div>
                           </div>

                        </div>
                     </div>

                     <div class="row g-3 mt-3">
                        <div class="col-6">
                           <button type="submit" class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center gap-2 py-2" id="dueBtn">
                              <i class="bx bx-time-five fs-4"></i>
                              <span class="fw-semibold">બાકી</span>
                           </button>
                        </div>

                        <div class="col-6">
                           <button type="submit" class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center gap-2 py-2" id="cashBtn">
                              <i class="bx bx-money fs-4"></i>
                              <span class="fw-semibold">રોકડ</span>
                           </button>
                        </div>
                     </div>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- / Content -->

   {{-- MODEL FOR BAKI CHUKVANI RAKAM  --}}
   <div class="modal fade" id="duePaymentModal" tabindex="-1">
      <div class="modal-dialog modal-sm">
         <div class="modal-content">

            <div class="modal-header">
               <h5 class="modal-title">બાકી રકમ ચૂકવણી</h5>

               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

               <div class="mb-3">
                  <label class="form-label">આગળની બાકી રકમ</label>

                  <input type="number" id="modal_previous_due" class="form-control" readonly>
               </div>

               <div class="mb-3">
                  <label class="form-label">બાકી ચૂકવણી રકમ</label>

                  <input type="number" id="paid_due_amount" class="form-control" placeholder="રકમ દાખલ કરો">
               </div>

            </div>

            <div class="modal-footer">

               <button class="btn btn-secondary" data-bs-dismiss="modal">
                  બંધ
               </button>

               <button class="btn btn-success" id="saveDuePayment">
                  ₹ જમા કરો
               </button>

            </div>

         </div>
      </div>
   </div>

   <!-- Footer -->

   @include('layout.footer')

   <script>
      $(document).ready(function() {

         let customerHasDue = false;
         let previousDueTotal = 0;
         let duePaidNow = 0;
         let duePaymentSaved = false;

         // ==========================================
         // CUSTOMER NAME -> BLOCK NUMBERS WHILE TYPING
         // ==========================================
         $("#customerName").on("input", function() {
            let value = $(this).val();
            let cleaned = value.replace(/[0-9]/g, '');
            if (value !== cleaned) {
               $(this).val(cleaned);
            }
         });

         // ==========================================
         // CUSTOMER NAME - ENGLISH TO GUJARATI
         // Translate last English word on ENTER
         // ==========================================

         $("#customerName").on("keydown", function(e) {

            // Only Enter
            if (e.key !== "Enter") {
               return;
            }

            e.preventDefault();

            const input = this;

            const cursorPos = input.selectionStart;

            // Text before cursor
            const textBeforeCursor =
               input.value.slice(0, cursorPos);

            // Find last English word
            const match =
               textBeforeCursor.match(/[a-zA-Z]+$/);

            if (!match) {
               return;
            }

            const englishWord = match[0];

            const wordStart =
               cursorPos - englishWord.length;

            // Text after cursor
            const textAfterCursor =
               input.value.slice(cursorPos);

            // Show loader
            $("#customerNameLoader").removeClass("d-none");

            fetch(
                  "https://inputtools.google.com/request?" +
                  "text=" + encodeURIComponent(englishWord) +
                  "&itc=gu-t-i0-und&num=1"
               )
               .then(function(response) {
                  return response.json();
               })
               .then(function(data) {

                  if (
                     !data ||
                     data[0] !== "SUCCESS" ||
                     !data[1] ||
                     !data[1][0] ||
                     !data[1][0][1] ||
                     !data[1][0][1][0]
                  ) {
                     return;
                  }

                  const gujaratiWord =
                     data[1][0][1][0];

                  // Replace only the last English word
                  const newValue =
                     input.value.slice(0, wordStart) +
                     gujaratiWord +
                     textAfterCursor;

                  input.value = newValue;

                  // Move cursor after Gujarati word
                  const newCursorPos =
                     wordStart + gujaratiWord.length;

                  input.setSelectionRange(
                     newCursorPos
                     , newCursorPos
                  );

                  // Trigger input event
                  $(input).trigger("input");

               })
               .catch(function(error) {

                  console.error(
                     "Customer Name Gujarati Transliteration Error:"
                     , error
                  );

               })
               .finally(function() {

                  // Hide loader
                  $("#customerNameLoader").addClass("d-none");

               });

         });

         // ==========================================
         // CUSTOMER MOBILE -> AUTOFILL + SHOW/HIDE DUE
         // ==========================================

         $("#customerMobile").on("blur", function() {

            let mobile = $(this).val().trim();

            if (mobile.length !== 10) {
               return;
            }

            // Show loader
            $("#customerNameLoader").removeClass("d-none");

            // Optional: clear old name while checking
            $("#customerName").val("");

            $.ajax({
               url: "{{ route('billing.check-customer') }}"
               , method: "POST",

               data: {
                  _token: "{{ csrf_token() }}"
                  , mobile: mobile
               },

               success: function(res) {

                  duePaidNow = 0;
                  duePaymentSaved = false;

                  $('input[name="pay_due"]').prop("checked", false);
                  $("#pay_no").prop("checked", true);

                  if (res.exists) {

                     // Automatically show customer name
                     $("#customerName").val(res.name);

                     // Lock mobile number for existing customer
                     $("#customerMobile").prop("readonly", true);

                     if (res.due_amount > 0) {

                        customerHasDue = true;
                        previousDueTotal = res.due_amount;

                        $("#previous_due").val(previousDueTotal);

                        $("#previousDueRow").removeClass("d-none");
                        $("#payDueSection").removeClass("d-none");

                     } else {

                        customerHasDue = false;
                        previousDueTotal = 0;

                        $("#previous_due").val(0);

                        $("#previousDueRow").addClass("d-none");
                        $("#payDueSection").addClass("d-none");
                     }

                  } else {

                     // New customer
                     customerHasDue = false;
                     previousDueTotal = 0;

                     $("#customerMobile").prop("readonly", false);

                     $("#customerName").val("");

                     $("#previous_due").val(0);

                     $("#previousDueRow").addClass("d-none");
                     $("#payDueSection").addClass("d-none");
                  }

                  updateTotals();
               },

               error: function() {

                  console.log("Customer check failed");

                  $("#customerName").val("");
               },

               complete: function() {

                  // Hide loader after AJAX finishes
                  $("#customerNameLoader").addClass("d-none");
               }
            });

         });

         updateTotals();

         //add english to gujrati translation wire
         // ==========================================
         // PRODUCT SEARCH - ENGLISH TO GUJARATI
         // Ctrl + Q
         // ==========================================

         $('#productName').on('select2:open', function() {

            setTimeout(function() {

               const searchField = document.querySelector(
                  '.select2-container--open .select2-search__field'
               );

               if (!searchField || searchField.dataset.transliterationBound) {
                  return;
               }

               searchField.dataset.transliterationBound = 'true';

               searchField.addEventListener('keydown', function(e) {

                  // Only Ctrl + Q
                  if (!(e.ctrlKey && e.key.toLowerCase() === 'q')) {
                     return;
                  }

                  // Prevent browser Ctrl + Q action
                  e.preventDefault();

                  const cursorPos = searchField.selectionStart;

                  // Text before cursor
                  const textBeforeCursor =
                     searchField.value.slice(0, cursorPos);

                  // Find last English word
                  const match =
                     textBeforeCursor.match(/[a-zA-Z]+$/);

                  if (!match) {
                     return;
                  }

                  const englishWord = match[0];

                  const wordStart =
                     cursorPos - englishWord.length;

                  // Text after cursor
                  const textAfterCursor =
                     searchField.value.slice(cursorPos);

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

                        // Replace only English word
                        const newValue =
                           searchField.value.slice(0, wordStart) +
                           gujaratiWord +
                           textAfterCursor;

                        searchField.value = newValue;

                        // Move cursor after Gujarati word
                        const newCursorPos =
                           wordStart + gujaratiWord.length;

                        searchField.setSelectionRange(
                           newCursorPos
                           , newCursorPos
                        );

                        // Tell Select2 that search value changed
                        $(searchField).trigger('input');

                        // Also trigger keyup for Select2 compatibility
                        $(searchField).trigger('keyup');

                     })
                     .catch(function(error) {

                        console.error(
                           'Product Gujarati Transliteration Error:'
                           , error
                        );

                     });

               });

            }, 0);

         });




         // Add Item
         $("#addItem").click(function() {

            let mobile = $("#customerMobile").val().trim();
            let customer = $("#customerName").val().trim();
            let product = $("#productName").val().trim();
            let qty = parseFloat($("#qty").val()) || 0;
            let rate = parseFloat($("#rate").val()) || 0;

            let prakarValue = $("#prakar").val();
            let prakarText = $("#prakar option:selected").text();

            if (mobile == "") {
               GlassToast.warning("મોબાઈલ નંબર", "કૃપા કરીને ગ્રાહકનો મોબાઇલ નંબર દાખલ કરો.");
               $("#customerMobile").focus();
               return;
            }

            if (mobile.length != 10) {
               GlassToast.warning("ગ્રાહકનું નામ", "મોબાઇલ નંબર 10 અંકનો હોવો જોઈએ.");
               $("#customerMobile").focus();
               return;
            }

            if (customer == "") {
               GlassToast.warning("ગ્રાહકનું નામ", "કૃપા કરીને ગ્રાહકનું નામ દાખલ કરો.");
               $("#customerName").focus();
               return;
            }

            if (/[0-9]/.test(customer)) {
               GlassToast.warning("ગ્રાહકનું નામ", "ગ્રાહકના નામમાં નંબર ન હોવો જોઈએ.");
               $("#customerName").focus();
               return;
            }

            if (product == "") {
               GlassToast.warning("પ્રોડક્ટનું નામ", "કૃપા કરીને પ્રોડક્ટનું નામ દાખલ કરો.");
               $("#productName").focus();
               return;
            }

            if (qty <= 0) {
               GlassToast.warning("જથ્થો", "કૃપા કરીને જથ્થો દાખલ કરો.");
               $("#qty").focus();
               return;
            }

            if (rate <= 0) {
               GlassToast.warning("રકમ", "કૃપા કરીને રકમ દાખલ કરો.");
               $("#rate").focus();
               return;
            }
            if (prakarValue == "") {
               GlassToast.warning("પ્રકાર", "કૃપા કરીને પ્રકાર પસંદ કરો.");
               $("#prakar").focus();
               return;
            }

            let amount = qty * rate;
            let rowNo = $("#productTable tbody tr").length + 1;

            let row = `
        <tr>
            <td class="row-no">${rowNo}</td>
            <td>
                <input type="hidden" name="product_name[]" value="${product}">
                ${product}
            </td>
            <td>
                <input type="hidden" class="qty" name="qty[]" value="${qty}">
                <input type="hidden" class="prakar" name="prakar[]" value="${prakarValue}">
                ${qty} ${prakarText}
            </td>
            <td>
                <input type="hidden" class="rate" name="rate[]" value="${rate}">
                ₹ ${rate.toFixed(2)}
            </td>
            <td>
                <input type="hidden" class="amount" name="amount[]" value="${amount}">
                ₹ ${amount.toFixed(2)}
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm removeRow">
                    <i class="bx bx-trash"></i>
                </button>
            </td>
        </tr>`;

            $("#productTable tbody").append(row);

            $("#productName").val("");
            $("#qty").val("");
            $("#rate").val("");
            $("#prakar").val("");

            updateTotals();
         });

         // Remove Row
         $(document).on("click", ".removeRow", function() {

            $(this).closest("tr").remove();

            $("#productTable tbody tr").each(function(index) {
               $(this).find(".row-no").text(index + 1);
            });

            updateTotals();

         });

         function updateTotals() {

            let totalQty = 0;
            let totalAmount = 0;

            $(".qty").each(function() {
               totalQty += parseFloat($(this).val()) || 0;
            });

            $(".amount").each(function() {
               totalAmount += parseFloat($(this).val()) || 0;
            });

            let grandTotal = totalAmount;

            $("#total_qty").val(totalQty);
            $("#total_amount").val(totalAmount.toFixed(2));
            $("#grand_total").val(grandTotal.toFixed(2));
         }

         // ==========================================
         // BEFORE SUBMIT -> sync hidden fields
         // ==========================================

         function syncHiddenFields(paymentType) {

            $("#hiddenCustomerMobile").val($("#customerMobile").val().trim());
            $("#hiddenCustomerName").val($("#customerName").val().trim());
            $("#hiddenPreviousDue").val(previousDueTotal);
            $("#hiddenPaidDueAmount").val(duePaidNow);
            $("#hiddenPaymentType").val(paymentType);

         }

         $("#dueBtn").on("click", function(e) {

            if ($("#customerMobile").val().trim().length !== 10) {
               e.preventDefault();
               alert("માન્ય 10 અંકનો મોબાઇલ નંબર દાખલ કરો.");
               return;
            }

            if (/[0-9]/.test($("#customerName").val().trim())) {
               e.preventDefault();
               alert("ગ્રાહકના નામમાં નંબર ન હોવો જોઈએ.");
               return;
            }

            if ($("#productTable tbody tr").length === 0) {
               e.preventDefault();
               alert("ઓછામાં ઓછું એક પ્રોડક્ટ ઉમેરો.");
               return;
            }

            e.preventDefault();

            syncHiddenFields('due');

            $("#billForm").submit();

            // Give the browser a moment to open the PDF in the new tab,
            // then reset this page completely.
            setTimeout(function() {
               window.location.reload();
            }, 800);

         });

         $("#cashBtn").on("click", function(e) {

            if ($("#customerMobile").val().trim().length !== 10) {
               e.preventDefault();
               alert("માન્ય 10 અંકનો મોબાઇલ નંબર દાખલ કરો.");
               return;
            }

            if (/[0-9]/.test($("#customerName").val().trim())) {
               e.preventDefault();
               alert("ગ્રાહકના નામમાં નંબર ન હોવો જોઈએ.");
               return;
            }

            if ($("#productTable tbody tr").length === 0) {
               e.preventDefault();
               alert("ઓછામાં ઓછું એક પ્રોડક્ટ ઉમેરો.");
               return;
            }

            e.preventDefault();

            syncHiddenFields('cash');

            $("#billForm").submit();

            setTimeout(function() {
               window.location.reload();
            }, 800);

         });

         // ==========================================
         // BAKI CHUKAVANI RAKAM (modal)
         // ==========================================

         $('input[name="pay_due"]').change(function() {

            if ($(this).val() == 'yes') {

               duePaymentSaved = false;

               $("#modal_previous_due").val(previousDueTotal);
               $("#paid_due_amount").val('');

               let modal = new bootstrap.Modal(document.getElementById('duePaymentModal'));
               modal.show();

            } else {

               duePaidNow = 0;
               updateTotals();

            }

         });

         $('#duePaymentModal').on('hidden.bs.modal', function() {

            if (!duePaymentSaved) {
               $("#pay_no").prop("checked", true);
               duePaidNow = 0;
               updateTotals();
            }

         });

         $("#saveDuePayment").click(function() {

            let paidAmount = parseFloat($("#paid_due_amount").val()) || 0;
            let mobile = $("#customerMobile").val().trim();

            if (paidAmount <= 0) {
               GlassToast.warning("રકમ", "ચૂકવણી રકમ દાખલ કરો.");
               return;
            }

            if (paidAmount > previousDueTotal) {
               GlassToast.warning("રકમ", "ચૂકવણી રકમ બાકી રકમ કરતાં વધુ હોઈ શકે નહીં.");
               return;
            }

            GlassToast.confirm(
               "ચૂકવણીની ખાતરી", "શું તમે બાકી રકમની ચૂકવણી સેવ કરવા માંગો છો?"
               , function() {

                  $.ajax({
                     url: "{{ route('billing.pay-due') }}"
                     , method: "POST"
                     , data: {
                        _token: "{{ csrf_token() }}"
                        , customer_mobile: mobile
                        , paid_amount: paidAmount
                     }
                     , success: function(res) {

                        if (res.success) {

                           duePaymentSaved = true;
                           duePaidNow = paidAmount;

                           previousDueTotal = res.remaining_due;
                           $("#previous_due").val(previousDueTotal);

                           if (previousDueTotal <= 0) {
                              $("#previousDueRow").addClass("d-none");
                              $("#payDueSection").addClass("d-none");
                           }

                           $("#pay_no").prop("checked", true);

                           GlassToast.success("સફળ", res.message);

                           bootstrap.Modal.getInstance(
                              document.getElementById('duePaymentModal')
                           ).hide();

                           updateTotals();

                        } else {
                           GlassToast.warning("ભૂલ", res.message);
                        }

                     }
                     , error: function(xhr) {

                        let msg = (xhr.responseJSON && xhr.responseJSON.message) ?
                           xhr.responseJSON.message :
                           "કંઈક ખોટું થયું, ફરી પ્રયાસ કરો.";

                        GlassToast.warning("ભૂલ", msg);
                     }
                  });

               }

            );

         });

      });

   </script>
   <script>
      $(document).ready(function() {
         $('#productName').select2({
            placeholder: 'પ્રોડક્ટ શોધો અથવા પસંદ કરો'
            , allowClear: true
            , width: '100%'
         });
      });

   </script>
   <script>
      $(document).ready(function() {

         $('#productName').select2({
            placeholder: 'પ્રોડક્ટ શોધો અથવા પસંદ કરો'
            , allowClear: true
            , width: '100%'
         });


         $('#productName').on('change', function() {

            let selectedOption = $(this).find('option:selected');

            let product = $(this).val();

            if (product) {

               // Get product information
               let prakar = selectedOption.data('prakar');
               let prakarText = selectedOption.data('prakar-text');
               let rate = selectedOption.data('rate');


               // Show details
               $('#productDetails')
                  .removeClass('d-none')
                  .hide()
                  .slideDown(250);


               // Set Prakar
               $('#prakar').val(prakar).trigger('change');


               // Set Prakar Text
               $('#prakar_text').val(prakarText || '');


               // Set Rate
               $('#rate').val(rate || '');

            } else {

               // Hide details
               $('#productDetails')
                  .slideUp(200, function() {
                     $(this).addClass('d-none');
                  });


               // Clear values
               $('#prakar').val('');
               $('#prakar_text').val('');
               $('#rate').val('');

            }

         });

      });

   </script>
