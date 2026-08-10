@include('layout.sidebar')

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
                                 <label class="form-label">પ્રોડક્ટનું નામ</label>

                                 <div class="input-group">
                                    <input type="text" id="productName" class="form-control productName" placeholder="પ્રોડક્ટનું નામ">

                                    <span class="input-group-text voiceProduct voice-btn">
                                       <i class="bx bx-microphone"></i>
                                    </span>
                                 </div>
                              </div>

                              <div class="col-md-6">
                                 <label class="form-label">નંગ / જથ્થો</label>
                                 <input type="number" id="qty" class="form-control" placeholder="0">
                              </div>

                              <div class="col-md-6">
                                 <label class="form-label">રકમ</label>
                                 <input type="number" id="rate" class="form-control" placeholder="₹ 0.00">
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

         // Add Item
         $("#addItem").click(function() {

            let mobile = $("#customerMobile").val().trim();
            let customer = $("#customerName").val().trim();
            let product = $("#productName").val().trim();
            let qty = parseFloat($("#qty").val()) || 0;
            let rate = parseFloat($("#rate").val()) || 0;

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
                ${qty}
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
               "ચૂકવણીની ખાતરી"
               , "શું તમે બાકી રકમની ચૂકવણી સેવ કરવા માંગો છો?"
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
