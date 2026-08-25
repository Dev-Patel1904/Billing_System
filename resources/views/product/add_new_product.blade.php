@include('layout.sidebar')
<style>
   .payment-btn {
      min-width: 145px;
      height: 42px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      font-weight: 500;
      border-radius: 6px;
   }

   .payment-btn i {
      font-size: 19px;
   }

   @media (max-width: 576px) {
      .payment-btn {
         flex: 1 1 100%;
         width: 100%;
      }
   }

</style>
<style>
   /* ========================================
   Premium Supplier Field
======================================== */

   .supplier-field {
      position: relative;
   }

   .supplier-label {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 5px;
      font-size: 14px;
   }

   .supplier-label small {
      display: block;
      margin-top: 2px;
      font-size: 11px;
      font-weight: 400;
      color: #9ca3af;
   }

   .supplier-label-icon {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 10px;
      background: #f3f4f6;
      color: #4f46e5;
      font-size: 17px;
   }

   .supplier-select-wrapper {
      position: relative;
   }

   .supplier-select-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      z-index: 2;
      color: #6b7280;
      pointer-events: none;
      font-size: 14px;
   }

   .supplier-select-wrapper .select2-container {
      width: 100% !important;
   }

   .supplier-select-wrapper .select2-container--default .select2-selection--single {
      height: 40px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      background: #fff;
      box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
      transition:
         border-color 0.2s ease,
         box-shadow 0.2s ease;
   }

   .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 40px;
      padding-left: 45px;
      padding-right: 45px;
      color: #111827;
      font-size: 14px;
   }

   .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 40px;
      right: 12px;
   }

   .supplier-select-wrapper .select2-container--default.select2-container--open .select2-selection--single,

   .supplier-select-wrapper .select2-container--default .select2-selection--single:focus {
      border-color: #6366f1;
      box-shadow:
         0 0 0 4px rgba(99, 102, 241, 0.10);
   }

   .select2-container--default .select2-dropdown {
      margin-top: 6px;
      border: 1px solid #e5e7eb;
      border-radius: 12px;
      overflow: hidden;
      background: #fff;
      box-shadow:
         0 12px 30px rgba(15, 23, 42, 0.12);
   }

   .select2-container--default .select2-search--dropdown {
      padding: 10px;
      background: #fff;
   }

   .select2-container--default .select2-search--dropdown .select2-search__field {
      width: 100%;
      height: 40px;
      padding: 8px 12px;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      outline: none;
      background: #fff;
      color: #111827;
      font-size: 14px;
      transition:
         border-color 0.2s ease,
         box-shadow 0.2s ease;
   }

   .select2-container--default .select2-search--dropdown .select2-search__field:focus {
      border-color: #6366f1;
      box-shadow:
         0 0 0 3px rgba(99, 102, 241, 0.08);
   }

   .select2-container--default .select2-results__option {
      padding: 10px 14px;
      font-size: 14px;
      color: #374151;
      transition:
         background-color 0.15s ease,
         color 0.15s ease;
   }

   .select2-container--default .select2-results__option--highlighted[aria-selected] {
      background: #f3f4ff;
      color: #4f46e5;
   }

   .select2-container--default .select2-results__option[aria-selected="true"] {
      background: #f8f8ff;
      color: #4f46e5;
      font-weight: 500;
   }

   .select2-container--default .select2-results__option.select2-results__message {
      padding: 12px 14px;
      color: #9ca3af;
      font-size: 13px;
      text-align: center;
   }

   .supplier-hint {
      margin-top: 7px;
      color: #9ca3af;
      font-size: 11px;
   }

   .supplier-hint i {
      margin-right: 4px;
      color: #6366f1;
   }

   .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__clear {
      height: 40px;
      margin-right: 5px;
      color: #9ca3af;
      font-size: 18px;
      line-height: 38px;
   }

   .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__clear:hover {
      color: #ef4444;
   }

   @media (max-width: 767px) {

      .supplier-label {
         font-size: 13px;
      }

      .supplier-label-icon {
         width: 32px;
         height: 32px;
         font-size: 15px;
      }

      .supplier-select-wrapper .select2-container--default .select2-selection--single {
         height: 40px;
      }

      .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__rendered {
         line-height: 40px;
         padding-left: 42px;
         padding-right: 40px;
         font-size: 13px;
      }

      .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__arrow {
         height: 40px;
      }
   }

</style>

<!-- Content wrapper -->
<div class="content-wrapper">
   <div class="container-xxl flex-grow-1 mt-6">
      <!-- container-p-y -->
      <!-- Basic Layout -->
      <div class="row gy-6">
         <div class="col-xl">
            <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">ખરીદીની માહિતી</h5>

                  <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#largeModal">
                     સપ્લાયર ઉમેરો
                  </button>
               </div>

               <div class="card-body">
                  <form>

                     <div class="row">

                        <div class="col-md-12">
                           <div class="mb-8">
                              <div class="supplier-field">

                                 <label for="supplier_id" class="supplier-label">
                                    <span>
                                       સપ્લાયરનું નામ
                                    </span>
                                 </label>

                                 <div class="supplier-select-wrapper">
                                    <span class="supplier-select-icon">
                                       <i class="bi bi-person-lines-fill"></i>
                                    </span>

                                    <select class="form-control premium-supplier-select" id="supplier_id" name="supplier_id">
                                       <option value=""></option>

                                       @foreach ($suppliers as $supplier)
                                       <option value="{{ $supplier->id }}" data-address="{{ $supplier->address }}">
                                          {{ $supplier->name }}
                                       </option>
                                       @endforeach
                                    </select>
                                 </div>

                              </div>
                           </div>
                        </div>

                        <div class="col-md-12">
                           <div class="mb-6">

                              <label class="form-label">
                                 સરનામું
                              </label>

                              <textarea class="form-control" id="supplier_address" name="supplier_address" placeholder="સરનામું દાખલ કરો" rows="3" readonly></textarea>

                           </div>
                        </div>

                     </div>

                     <div class="d-flex justify-content-between align-items-center mt-4">
                        <h5 class="mb-0">પ્રોડક્ટની માહિતી</h5>
                     </div>

                     <div class="row mt-4">
                        <div class="col-md-6">
                           <div class="mb-3">
                              <label for="invoice_number" class="form-label">
                                 બિલ નંબર
                              </label>

                              <input type="text" name="invoice_number" id="invoice_number" class="form-control" placeholder="બિલ નંબર દાખલ કરો" autocomplete="off">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="mb-3">
                              <label class="form-label">Invoice Date</label>

                              <input type="date" id="invoice_date" name="invoice_date" class="form-control" value="{{ date('Y-m-d') }}">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="mb-3">
                              <label class="form-label">પ્રોડક્ટનું નામ</label>
                              <input type="text" id="product_name" class="form-control" placeholder="પ્રોડક્ટનું નામ">
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="mb-3">
                              <label class="form-label">Qty (જથ્થો/નંગ)</label>
                              <input type="number" id="qty" class="form-control" placeholder="જથ્થો" min="1">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="mb-3">
                              <label for="prakar" class="form-label">પ્રકાર</label>

                              <select name="prakar" id="prakar" class="form-select">
                                 <option value="">પ્રકાર પસંદ કરો</option>
                                 @foreach ($type as $item)
                                 <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                                 @endforeach

                              </select>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="mb-3">
                              <label class="form-label">ભાવ</label>
                              <input type="number" id="rate" class="form-control" placeholder="ભાવ" min="1">
                           </div>
                        </div>
                     </div>

                     <button type="button" id="saveBtn" class="btn btn-outline-primary">
                        સાચવો
                     </button>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- Supplier Modal -->
   <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

         <div class="modal-content">

            <div class="modal-header">

               <h5 class="modal-title" id="exampleModalLabel3">
                  નવો સપ્લાયર ઉમેરો
               </h5>

               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               </button>

            </div>

            <form id="supplierForm">

               @csrf

               <div class="modal-body">

                  <div class="row">

                     <!-- Supplier Name -->
                     <div class="col-md-12 mb-3">

                        <label class="form-label">
                           સપ્લાયરનું નામ
                        </label>

                        <input type="text" class="form-control" id="supplier_name" name="name" placeholder="સપ્લાયરનું નામ">

                     </div>




                     <!-- Address -->
                     <div class="col-12">

                        <label class="form-label">
                           સરનામું
                        </label>

                        <textarea class="form-control" id="new_supplier_address" name="address" rows="3" placeholder="સરનામું દાખલ કરો"></textarea>

                     </div>

                  </div>

               </div>


               <div class="modal-footer">

                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                     બંધ કરો
                  </button>

                  <button type="submit" class="btn btn-primary" id="saveSupplierBtn">

                     <span id="saveSupplierText">
                        સાચવો
                     </span>

                  </button>

               </div>

            </form>

         </div>

      </div>

   </div>
   {{-- ENGLISH -> GUJARATI TRANSLITERATION --}}
   <script>
      (function() {

         function attachTransliteration(inputId) {

            const el = document.getElementById(inputId);

            if (!el) {
               return;
            }

            el.addEventListener('keydown', function(e) {

               // Transliterate when SPACE or ENTER is pressed
               if (e.key !== 'Enter') {
                  return;
               }

               const cursorPos = el.selectionStart;

               const textBeforeCursor =
                  el.value.substring(0, cursorPos);

               // Find the English word before cursor
               const match =
                  textBeforeCursor.match(/[a-zA-Z]+$/);

               if (!match) {
                  return;
               }

               const englishWord = match[0];

               const wordStart =
                  cursorPos - englishWord.length;

               const textAfterCursor =
                  el.value.substring(cursorPos);

               e.preventDefault();

               fetch(
                     'https://inputtools.google.com/request?' +
                     'text=' +
                     encodeURIComponent(englishWord) +
                     '&itc=gu-t-i0-und' +
                     '&num=1'
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

                     const newValue =
                        el.value.substring(0, wordStart) +
                        gujaratiWord +
                        (e.key === ' ' ? ' ' : '') +
                        textAfterCursor;

                     el.value = newValue;

                     const newCursorPos =
                        wordStart +
                        gujaratiWord.length +
                        (e.key === ' ' ? 1 : 0);

                     el.setSelectionRange(
                        newCursorPos, newCursorPos
                     );

                  })
                  .catch(function(error) {

                     console.error(
                        'Gujarati Transliteration Error:', error
                     );

                  });

            });

         }

         // Supplier name
         attachTransliteration('supplier_name');

         // Supplier address
         attachTransliteration('new_supplier_address');

         // Product name
         attachTransliteration('product_name');

         // billing_no ane qty par transliteration nathi lagavtu —
         // billing_no English/numbers mate chhe, qty numeric-only field chhe.

      })();

   </script>

   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <div class="card">
         <div class="justify-content-between d-flex p-1">
            <div>
               <h5 class="card-header">ખરીદીની યાદી</h5>
            </div>

         </div>
         <div class="table-responsive text-nowrap">
            <table class="table">
               <thead class="table-light">
                  <tr>
                     <th>ક્રમાંક</th>
                     <th>પ્રોડક્ટનું નામ</th>
                     <th>જથ્થો</th>
                     <th>ભાવ</th>
                     <th>કુલ રકમ</th>
                     <th>ક્રિયાઓ</th>
                  </tr>
               </thead>

               <tbody id="billTableBody" class="table-border-bottom-0">

               </tbody>
            </table>
            <div class="card mt-3">
               <div class="card-body">
                  <div class="row">

                     <div class="col-md-3 mb-3">
                        <label class="form-label">કુલ જથ્થો</label>
                        <input type="text" id="total_qty" class="form-control" value="0" readonly>
                     </div>

                     <div class="col-md-3 mb-3">
                        <label class="form-label">કુલ રકમ</label>
                        <input type="text" id="total_amount" class="form-control" value="0" readonly>
                     </div>

                     <div class="col-md-3 mb-3">
                        <label class="form-label">ચૂકવેલ રકમ</label>
                        <input type="number" id="paid_amount" class="form-control" value="0">
                     </div>

                     <div class="col-md-3 mb-3">
                        <label class="form-label text-danger">બાકી રકમ</label>
                        <input type="text" id="balance_amount" class="form-control text-danger fw-bold" value="0" readonly>
                     </div>
                     <div class="row">
                        <div class="col-md-6 mt-5 mb-5">

                           <button type="button" id="finalSaveBtn" class="btn btn-outline-danger">
                              બાકી
                           </button>

                           <!-- Check Payment Button (hidden until an amount is entered) -->
                           <button type="button" id="checkPaymentBtn" class="btn btn-outline-primary payment-btn d-none" data-bs-toggle="modal" data-bs-target="#checkPaymentModal">
                              <i class="bx bx-receipt"></i>
                              <span>ચેક થી ચુકવણી</span>
                           </button>

                           <!-- Google Pay (hidden until an amount is entered) -->
                           <button type="button" id="gpayBtn" class="btn btn-outline-success payment-btn d-none">
                              <i class="bx bxl-google"></i>
                              <span>ગૂગલ પે</span>
                           </button>

                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>

      </div>
   </div>
   <!-- / Content -->
   <script>
      const paidAmountInput = document.getElementById('paid_amount');

      // Remove 0 when user clicks/focuses on the input
      paidAmountInput.addEventListener('focus', function() {
         if (this.value === '0') {
            this.value = '';
         }
      });

      // Put 0 back if user leaves it empty
      paidAmountInput.addEventListener('blur', function() {
         if (this.value === '') {
            this.value = '0';
         }

         updatePaymentButton();
      });

      function updatePaymentButton() {
         const totalAmount =
            parseFloat(document.getElementById('total_amount').value) || 0;

         const paidAmount =
            parseFloat(document.getElementById('paid_amount').value) || 0;

         const finalSaveBtn =
            document.getElementById('finalSaveBtn');

         // Remove previous colors
         finalSaveBtn.classList.remove(
            'btn-outline-danger', 'btn-outline-success', 'btn-outline-warning'
         );

         if (paidAmount === 0) {

            // બાકી
            finalSaveBtn.textContent = 'બાકી';
            finalSaveBtn.classList.add('btn-outline-danger');

         } else if (paidAmount === totalAmount) {

            // રોકડ
            finalSaveBtn.textContent = 'રોકડ';
            finalSaveBtn.classList.add('btn-outline-success');

         } else {

            // અડધી ચુકવણી
            finalSaveBtn.textContent = 'અડધી ચુકવણી';
            finalSaveBtn.classList.add('btn-outline-warning');
         }
      }

      // Update while typing
      paidAmountInput.addEventListener('input', updatePaymentButton);

      // Initial state
      updatePaymentButton();

   </script>






   {{-- Place this tag before closing body tag for github widget button. --}}
   <script async defer src="https://buttons.github.io/buttons.js"></script>
   <script>
      function updateCheckPaymentButton() {

         const checkPaymentBtn = document.getElementById('checkPaymentBtn');

         if (!checkPaymentBtn) {
            return;
         }

         // The ચેક button stays enabled whenever it's visible — paying the
         // full amount (balance = 0) by check is a valid flow, so we no
         // longer disable it based on balance_amount.
         checkPaymentBtn.disabled = false;
         checkPaymentBtn.classList.remove('disabled');
      }

   </script>
   <script>
      const tableBody = document.getElementById("billTableBody");

      let editingRow = null;

      // ========================================
      // PAID AMOUNT
      // ========================================

      document.getElementById("paid_amount").addEventListener("input", updateSummary);


      // ========================================
      // SAVE / UPDATE PRODUCT
      // ========================================

      document.getElementById("saveBtn").addEventListener("click", function() {

         const productNameInput = document.getElementById("product_name");
         const qtyInput = document.getElementById("qty");
         const prakarSelect = document.getElementById("prakar");
         const rateInput = document.getElementById("rate");

         const productName = productNameInput.value.trim();

         const qty =
            parseFloat(qtyInput.value) || 0;

         const rate =
            parseFloat(rateInput.value) || 0;


         // ========================================
         // PRAKAR
         // ========================================

         const prakarValue =
            prakarSelect.value;

         const prakarText =
            prakarSelect.options[prakarSelect.selectedIndex].text;


         // ========================================
         // VALIDATION
         // ========================================

         if (productName === "") {

            GlassToast.warning(
               'ચેતવણી', 'કૃપા કરીને પ્રોડક્ટનું નામ દાખલ કરો.'
            );

            productNameInput.focus();

            return;
         }


         if (prakarValue === "") {

            GlassToast.warning(
               'ચેતવણી', 'કૃપા કરીને પ્રકાર પસંદ કરો.'
            );

            prakarSelect.focus();

            return;
         }


         if (!qtyInput.value || qty < 1) {

            GlassToast.warning(
               'ચેતવણી', 'જથ્થો ઓછામાં ઓછો 1 હોવો જોઈએ.'
            );

            qtyInput.focus();

            return;
         }


         if (!rateInput.value || rate < 1) {

            GlassToast.warning(
               'ચેતવણી', 'ભાવ ઓછામાં ઓછો 1 હોવો જોઈએ.'
            );

            rateInput.focus();

            return;
         }


         // ========================================
         // TOTAL
         // ========================================

         const total = qty * rate;


         // ========================================
         // EDIT EXISTING ROW
         // ========================================

         if (editingRow) {

            // Store data
            editingRow.dataset.name = productName;
            editingRow.dataset.qty = qty;
            editingRow.dataset.prakar = prakarValue;
            editingRow.dataset.prakarText = prakarText;
            editingRow.dataset.rate = rate;
            editingRow.dataset.total = total;


            // Update table
            editingRow.cells[1].textContent =
               productName;

            editingRow.cells[2].textContent =
               `${qty} ${prakarText}`;

            editingRow.cells[3].textContent =
               "₹" + rate;

            editingRow.cells[4].textContent =
               "₹" + total;


            // Reset editing
            editingRow = null;

            document.getElementById("saveBtn").innerText =
               "સાચવો";

         }


         // ========================================
         // ADD NEW ROW
         // ========================================
         else {

            const rowNo =
               tableBody.rows.length + 1;


            const row = `
        <tr
            data-name="${escapeHtml(productName)}"
            data-qty="${qty}"
            data-prakar="${prakarValue}"
            data-prakar-text="${escapeHtml(prakarText)}"
            data-rate="${rate}"
            data-total="${total}"
            >

            <td>
                ${rowNo}
            </td>

            <td>
                ${escapeHtml(productName)}
            </td>

            <td>
                ${qty} ${escapeHtml(prakarText)}
            </td>

            <td>
                ₹${rate}
            </td>

            <td>
                ₹${total}
            </td>

            <td>

                <a href="javascript:void(0)"
                   class="dropdown-item edit-btn">

                    <i class="bx bx-edit text-primary"></i>

                </a>


                <a href="javascript:void(0)"
                   class="dropdown-item delete-btn">

                    <i class="bx bx-trash text-danger"></i>

                </a>

                </td>

                </tr>
                `;


            tableBody.insertAdjacentHTML(
               "afterbegin", row
            );
         }


         // ========================================
         // UPDATE SUMMARY
         // ========================================

         updateSummary();


         // ========================================
         // CLEAR FORM
         // ========================================

         document.getElementById("product_name").value = "";

         document.getElementById("qty").value = "";

         document.getElementById("prakar").value = "";

         document.getElementById("rate").value = "";

      });


      // ========================================
      // UPDATE SUMMARY
      // ========================================

      function updateSummary() {

         let totalQty = 0;

         let totalAmount = 0;


         // ========================================
         // CALCULATE TABLE TOTAL
         // ========================================

         [...tableBody.rows].forEach(row => {

            // Quantity
            totalQty +=
               Number(row.dataset.qty) || 0;


            // Amount
            totalAmount +=
               Number(row.dataset.total) || 0;

         });


         // ========================================
         // SET TOTAL QTY
         // ========================================

         document.getElementById("total_qty").value =
            totalQty;


         // ========================================
         // SET TOTAL AMOUNT
         // ========================================

         document.getElementById("total_amount").value =
            totalAmount;


         // ========================================
         // PAID AMOUNT
         // ========================================

         const paidInput =
            document.getElementById("paid_amount");

         let paid =
            Number(paidInput.value) || 0;


         // ========================================
         // PAID > TOTAL
         // ========================================

         if (paid > totalAmount) {

            GlassToast.warning(
               "ચેતવણી", "આજે ચૂકવેલ રકમ કુલ રકમ કરતાં વધુ ન હોઈ શકે."
            );

            paid = totalAmount;

            paidInput.value =
               totalAmount;
         }


         // ========================================
         // BALANCE
         // ========================================

         const balance =
            Math.max(
               totalAmount - paid, 0
            );


         document.getElementById("balance_amount").value =
            balance;
         // Update check payment button
         updateCheckPaymentButton();
      }


      // ========================================
      // EDIT ROW
      // ========================================

      document.addEventListener("click", function(e) {

         const editButton =
            e.target.closest(".edit-btn");


         if (!editButton) {
            return;
         }


         // Get row
         editingRow =
            editButton.closest("tr");


         // ========================================
         // SET PRODUCT NAME
         // ========================================

         document.getElementById("product_name").value =
            editingRow.dataset.name;


         // ========================================
         // SET QTY
         // ========================================

         document.getElementById("qty").value =
            editingRow.dataset.qty;


         // ========================================
         // SET PRAKAR
         // ========================================

         document.getElementById("prakar").value =
            editingRow.dataset.prakar;


         // ========================================
         // SET RATE
         // ========================================

         document.getElementById("rate").value =
            editingRow.dataset.rate;


         // ========================================
         // CHANGE BUTTON TEXT
         // ========================================

         document.getElementById("saveBtn").innerText =
            "સુધારો કરો";


         // ========================================
         // SCROLL TO FORM
         // ========================================

         window.scrollTo({
            top: 0
            , behavior: "smooth"
         });

      });


      // ========================================
      // DELETE ROW
      // ========================================

      document.addEventListener("click", function(e) {

         const deleteButton =
            e.target.closest(".delete-btn");


         if (!deleteButton) {
            return;
         }


         const row =
            deleteButton.closest("tr");


         // ========================================
         // DELETE
         // ========================================

         row.remove();


         // ========================================
         // RESET EDITING
         // ========================================

         if (
            editingRow &&
            !document.body.contains(editingRow)
         ) {

            editingRow = null;

            document.getElementById("saveBtn").innerText =
               "સાચવો";
         }


         // ========================================
         // RE-NUMBER ROWS
         // ========================================

         [...tableBody.rows].forEach(
            (row, index) => {

               row.cells[0].textContent =
                  index + 1;

            }
         );


         // ========================================
         // UPDATE SUMMARY
         // ========================================

         updateSummary();

      });


      // ========================================
      // HTML ESCAPE FUNCTION
      // ========================================

      function escapeHtml(value) {

         return String(value)
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
      }

   </script>
   {{-- ADD NEW SUPLIER  --}}
   <script>
      document.addEventListener('DOMContentLoaded', function() {

         const form = document.getElementById('supplierForm');

         const name = document.getElementById('supplier_name');

         const address = document.getElementById('new_supplier_address');

         const saveBtn = document.getElementById('saveSupplierBtn');

         const saveText = document.getElementById('saveSupplierText');


         // ==========================================
         // FORM SUBMIT
         // ==========================================

         form.addEventListener('submit', async function(e) {

            e.preventDefault();


            const nameValue = name.value.trim();

            const addressValue = address.value.trim();


            // ==========================================
            // NAME VALIDATION
            // ==========================================

            if (nameValue === '') {

               GlassToast.warning(
                  'ચેતવણી', 'સપ્લાયરનું નામ દાખલ કરો.'
               );

               name.focus();

               return;
            }


            // ==========================================
            // ADDRESS VALIDATION
            // ==========================================

            if (addressValue === '') {

               GlassToast.warning(
                  'ચેતવણી', 'સરનામું દાખલ કરો.'
               );

               address.focus();

               return;
            }


            // ==========================================
            // LOADING
            // ==========================================

            saveBtn.disabled = true;

            saveText.innerText = 'સાચવી રહ્યું છે...';


            try {

               const response = await fetch(
                  "{{ route('suppliers.store') }}", {
                     method: 'POST',

                     headers: {

                        'X-CSRF-TOKEN': document.querySelector(
                           '#supplierForm input[name="_token"]'
                        ).value,

                        'Accept': 'application/json',

                        'X-Requested-With': 'XMLHttpRequest'

                     },

                     body: new FormData(form)
                  }
               );


               const data = await response.json();


               console.log('Supplier Response:', data);


               // ==========================================
               // SUCCESS
               // ==========================================

               if (response.ok && data.status === true) {

                  GlassToast.success(
                     'સફળતા', data.message
                  );


                  form.reset();


                  setTimeout(function() {

                     const modalElement =
                        document.getElementById('largeModal');

                     const modal =
                        bootstrap.Modal.getInstance(modalElement);

                     if (modal) {
                        modal.hide();
                     }

                  }, 500);


                  setTimeout(function() {
                     location.reload();
                  }, 1000);

               }


               // ==========================================
               // VALIDATION ERROR
               // ==========================================
               else if (
                  response.status === 422 &&
                  data.errors
               ) {

                  if (data.errors.name) {

                     GlassToast.error(
                        'સપ્લાયરનું નામ', data.errors.name[0]
                     );

                  } else if (data.errors.address) {

                     GlassToast.error(
                        'સરનામું', data.errors.address[0]
                     );

                  }

               }


               // ==========================================
               // OTHER ERROR
               // ==========================================
               else {

                  GlassToast.error(
                     'ભૂલ', data.message || 'કંઈક ખોટું થયું.'
                  );

               }

            } catch (error) {

               console.error(
                  'Supplier AJAX Error:', error
               );

               GlassToast.error(
                  'ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.'
               );

            } finally {

               saveBtn.disabled = false;

               saveText.innerText = 'સાચવો';

            }

         });

      });

   </script>
   {{-- SAVE FULL PURCHASE (SUPPLIER + PRODUCTS + PAID AMOUNT) --}}
   {{-- UNIFIED SAVE: cash (બાકી/રોકડ), check, gpay all funnel into one save call --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

       const finalSaveBtn     = document.getElementById('finalSaveBtn');
       const checkPaymentBtn  = document.getElementById('checkPaymentBtn');
       const gpayBtn          = document.getElementById('gpayBtn');
       const paidAmountInput  = document.getElementById('paid_amount');

       const checkPaymentModal = document.getElementById('checkPaymentModal');
       const checkModalAmount  = document.getElementById('checkModalAmount');
       const saveCheckPayment  = document.getElementById('saveCheckPayment');

       // ==========================================
       // SHOW / HIDE ચેક & ગૂગલ પે BUTTONS
       // Only visible once user has entered a paid amount > 0
       // ==========================================
       function togglePaymentButtons() {

          const paid = parseFloat(paidAmountInput.value) || 0;

          if (paid > 0) {
             checkPaymentBtn.classList.remove('d-none');
             gpayBtn.classList.remove('d-none');
          } else {
             checkPaymentBtn.classList.add('d-none');
             gpayBtn.classList.add('d-none');
          }
       }

       paidAmountInput.addEventListener('input', togglePaymentButtons);
       togglePaymentButtons(); // initial state on page load


       // ==========================================
       // SHOW CHECK AMOUNT INSIDE THE MODAL
       // ==========================================
       checkPaymentModal.addEventListener('show.bs.modal', function() {
          checkModalAmount.textContent = (parseFloat(paidAmountInput.value) || 0).toFixed(2);
       });


       // ==========================================
       // CORE SAVE FUNCTION
       // Used by બાકી/રોકડ, ચેક, and ગૂગલ પે buttons
       // ==========================================
       async function savePurchase(paymentMethod, checkNumber, checkDate, triggerBtn) {

          const supplierId   = document.getElementById("supplier_id").value;
          const billingNo    = document.getElementById("invoice_number").value.trim();
          const invoiceDate  = document.getElementById("invoice_date").value;
          const tableBody    = document.getElementById("billTableBody");

          if (billingNo === "") {
             GlassToast.warning('ચેતવણી', 'કૃપા કરીને બિલ નંબર દાખલ કરો.');
             document.getElementById("invoice_number").focus();
             return;
          }

          if (invoiceDate === "") {
             GlassToast.warning('ચેતવણી', 'કૃપા કરીને બિલ તારીખ પસંદ કરો.');
             document.getElementById("invoice_date").focus();
             return;
          }

          if (supplierId === "") {
             GlassToast.warning('ચેતવણી', 'કૃપા કરીને સપ્લાયર પસંદ કરો.');
             return;
          }

          if (tableBody.rows.length === 0) {
             GlassToast.warning('ચેતવણી', 'કૃપા કરીને ઓછામાં ઓછું એક પ્રોડક્ટ ઉમેરો.');
             return;
          }

          const totalAmount = Number(document.getElementById("total_amount").value) || 0;
          const paidAmount  = Number(paidAmountInput.value) || 0;

          if (paidAmount > totalAmount) {
             GlassToast.warning('ચેતવણી', 'આજે ચૂકવેલ રકમ કુલ રકમ કરતાં વધુ ન હોઈ શકે.');
             return;
          }

          if (paymentMethod === 'check') {

             if (!checkNumber) {
                GlassToast.warning('ચેતવણી', 'કૃપા કરીને ચેક નંબર દાખલ કરો.');
                return;
             }

             if (!checkDate) {
                GlassToast.warning('ચેતવણી', 'કૃપા કરીને ચેક તારીખ પસંદ કરો.');
                return;
             }

          }

          const items = [...tableBody.rows].map(row => ({
             product_name: row.dataset.name,
             qty: row.dataset.qty,
             prakar: row.dataset.prakar,
             prakar_text: row.dataset.prakarText,
             rate: row.dataset.rate,
          }));

          const originalText = triggerBtn.innerText;
          triggerBtn.disabled = true;
          triggerBtn.innerText = 'સાચવી રહ્યું છે...';

          try {

             const response = await fetch("{{ route('purchases.store') }}", {
                method: 'POST',
                headers: {
                   'Content-Type': 'application/json',
                   'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                   'Accept': 'application/json',
                },
                body: JSON.stringify({
                   billing_no: billingNo,
                   invoice_date: invoiceDate,
                   supplier_id: supplierId,
                   paid_amount: paidAmount,
                   payment_method: paymentMethod,
                   check_number: checkNumber || null,
                   check_date: checkDate || null,
                   items: items,
                }),
             });

             const data = await response.json();

             if (response.ok && data.status === true) {

                GlassToast.success('સફળતા', data.message);

                // Reset form for next purchase entry
                tableBody.innerHTML = "";
                document.getElementById("paid_amount").value = 0;
                document.getElementById("invoice_number").value = "";

                updateSummary();
                togglePaymentButtons();

                // Close check modal if it was open
                const modalInstance = bootstrap.Modal.getInstance(checkPaymentModal);
                if (modalInstance) modalInstance.hide();

                // ==========================================
                // REDIRECT to purchase list 2 seconds after
                // showing the success toast
                // ==========================================
                if (data.redirect) {
                   setTimeout(function() {
                      window.location.href = data.redirect;
                   }, 2000);
                }

             } else if (response.status === 422 && data.errors) {

                const firstErrorKey = Object.keys(data.errors)[0];
                GlassToast.error('ભૂલ', data.errors[firstErrorKey][0]);

             } else {

                GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

             }

          } catch (error) {

             console.error('Purchase Save Error:', error);
             GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

          } finally {

             triggerBtn.disabled = false;
             triggerBtn.innerText = originalText;

          }

       }


       // ==========================================
       // બાકી / રોકડ / અડધી ચુકવણી BUTTON -> cash
       // ==========================================
       finalSaveBtn.addEventListener('click', function() {
          savePurchase('cash', null, null, finalSaveBtn);
       });


       // ==========================================
       // ચેક બટન -> opens modal (via data-bs-toggle), save inside modal
       // ==========================================
       saveCheckPayment.addEventListener('click', function() {

          const checkNumber = document.getElementById('check_number').value.trim();
          const checkDate = document.getElementById('check_date').value;

          savePurchase('check', checkNumber, checkDate, saveCheckPayment);

       });


       // ==========================================
       // ગૂગલ પે બટન -> saves immediately with typed amount
       // ==========================================
       gpayBtn.addEventListener('click', function() {
          savePurchase('gpay', null, null, gpayBtn);
       });

    });
    </script>
   <script>
      $(document).ready(function() {

         // Initialize Select2
         $('#supplier_id').select2({
            placeholder: 'સપ્લાયર પસંદ કરો'
            , allowClear: true
            , width: '100%'
         });

         // Supplier change
         $('#supplier_id').on('change', function() {

            const selectedOption = this.options[this.selectedIndex];

            if (!this.value) {
               $('#supplier_address').val('');
               return;
            }

            // Get data from selected option
            const address = selectedOption.getAttribute('data-address') || '';

            // Fill address
            $('#supplier_address').val(address);
         });


         // ==========================================
         // GUJARATI TRANSLITERATION FOR SELECT2 SEARCH BOX
         // (Select2 rebuilds its search input every time it opens,
         //  so we attach the listener fresh on each open event.)
         // ==========================================

         $('#supplier_id').on('select2:open', function() {

            setTimeout(function() {

               const searchField = document.querySelector(
                  '.select2-container--open .select2-search__field'
               );

               if (!searchField || searchField.dataset.transliterationBound) {
                  return;
               }

               searchField.dataset.transliterationBound = 'true';

               searchField.addEventListener('keydown', function(e) {

                  // Only translate on SPACE or ENTER
                  if (!(e.ctrlKey && e.key.toLowerCase() === 'q')) {
                     return;
                  }

                  const cursorPos = searchField.selectionStart;

                  // Get text before cursor
                  const textBeforeCursor =
                     searchField.value.slice(0, cursorPos);

                  // Find the last English word
                  const match =
                     textBeforeCursor.match(/[a-zA-Z]+$/);

                  if (!match) {
                     return;
                  }

                  const englishWord = match[0];

                  const wordStart =
                     cursorPos - englishWord.length;

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

                        // Keep the space/enter action
                        const separator =
                           e.key === ' ' ? ' ' : '';

                        const newValue =
                           searchField.value.slice(0, wordStart) +
                           gujaratiWord +
                           separator +
                           textAfterCursor;

                        searchField.value = newValue;

                        // Move cursor after Gujarati word
                        const newCursorPos =
                           wordStart +
                           gujaratiWord.length +
                           separator.length;

                        searchField.setSelectionRange(
                           newCursorPos, newCursorPos
                        );

                        // Update Select2 filtering
                        $(searchField).trigger('input');

                     })
                     .catch(function(error) {

                        console.error(
                           'Select2 Gujarati Transliteration Error:', error
                        );

                     });

               });

            }, 0);

         });

      });

   </script>
   <script>
      document.getElementById('invoice_date').addEventListener('click', function() {
         if (this.showPicker) {
            this.showPicker();
         }
      });

   </script>
   <!-- Check Payment Modal -->
   <div class="modal fade" id="checkPaymentModal" tabindex="-1" aria-labelledby="checkPaymentModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
               <h5 class="modal-title" id="checkPaymentModalLabel">
                  <i class="bx bx-receipt me-2"></i>
                  ચેક થી ચુકવણી
               </h5>

               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

               <p class="text-muted small mb-3">
                  ચૂકવેલ રકમ: ₹<span id="checkModalAmount">0</span>
               </p>

               <!-- Check Number -->
               <div class="mb-3">
                  <label for="check_number" class="form-label">
                     ચેક નંબર
                  </label>

                  <div class="input-group">
                     <span class="input-group-text">
                        <i class="bx bx-hash"></i>
                     </span>

                     <input type="text" id="check_number" class="form-control" placeholder="ચેક નંબર દાખલ કરો">
                  </div>
               </div>

               <!-- Check Date -->
               <div class="mb-3">
                <label for="check_date" class="form-label">
                    ચેક તારીખ
                </label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bx bx-calendar"></i>
                    </span>

                    <input type="date"
                           id="check_date"
                           name="check_date"
                           class="form-control"
                           min="{{ date('Y-m-d') }}">
                </div>
            </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">

               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  <i class="bx bx-x me-1"></i>
                  રદ કરો
               </button>

               <button type="button" class="btn btn-primary" id="saveCheckPayment">
                  <i class="bx bx-check me-1"></i>
                  ચુકવણી ઉમેરો
               </button>

            </div>

         </div>
      </div>
   </div>
   <style>
      .payment-btn {
         min-width: 145px;
         height: 42px;
         display: inline-flex;
         align-items: center;
         justify-content: center;
         gap: 6px;
         font-weight: 500;
         border-radius: 6px;
      }

      .payment-btn i {
         font-size: 19px;
      }

      #checkPaymentModal .modal-content {
         border-radius: 12px;
         border: none;
      }

      #checkPaymentModal .modal-header {
         padding: 18px 20px;
      }

      #checkPaymentModal .modal-body {
         padding: 20px;
      }

      #checkPaymentModal .form-label {
         font-weight: 500;
      }

      #checkPaymentModal .input-group-text {
         min-width: 42px;
         justify-content: center;
      }

      @media (max-width: 576px) {
         #checkPaymentModal .modal-dialog {
            margin: 10px;
         }

         #checkPaymentModal .modal-footer {
            flex-direction: column;
         }

         #checkPaymentModal .modal-footer button {
            width: 100%;
         }
      }

   </style>
   @include('layout.footer')
