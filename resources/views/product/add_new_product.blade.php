@include('layout.sidebar')


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
                     નવો સપ્લાયર ઉમેરો
                  </button>
               </div>

               <div class="card-body">
                  <form>

                     <div class="row">

                        <div class="col-md-6">
                            <div class="mb-6">

                                <label class="form-label">
                                    સપ્લાયરનું નામ
                                </label>

                                <select
                                    class="form-control"
                                    id="supplier_id"
                                    name="supplier_id"
                                >

                                    <option value="">
                                        સપ્લાયર પસંદ કરો
                                    </option>

                                    @foreach ($suppliers as $supplier)

                                        <option
                                            value="{{ $supplier->id }}"
                                            data-mobile="{{ $supplier->mobile }}"
                                            data-address="{{ $supplier->address }}"
                                        >
                                            {{ $supplier->name }}
                                        </option>

                                    @endforeach

                                </select>

                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="mb-6">

                                <label class="form-label">
                                    સપ્લાયરનો મોબાઇલ નંબર
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    id="supplier_mobile"
                                    name="supplier_mobile"
                                    placeholder="સપ્લાયરનો મોબાઇલ નંબર"
                                    readonly
                                >

                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="mb-6">

                                <label class="form-label">
                                    સરનામું
                                </label>

                                <textarea
                                    class="form-control"
                                    id="supplier_address"
                                    name="supplier_address"
                                    placeholder="સરનામું દાખલ કરો"
                                    rows="3"
                                    readonly
                                ></textarea>

                            </div>
                        </div>

                     </div>

                     <div class="d-flex justify-content-between align-items-center mt-4">
                        <h5 class="mb-0">પ્રોડક્ટની માહિતી</h5>
                     </div>

                     <div class="row mt-4">

                        <div class="col-md-6">
                           <div class="mb-3">
                              <label class="form-label">પ્રોડક્ટનું નામ</label>
                              <input type="text" id="product_name" class="form-control" placeholder="પ્રોડક્ટનું નામ">
                           </div>
                        </div>

                        <div class="col-md-3">
                           <div class="mb-3">
                              <label class="form-label">જથ્થો</label>
                              <input type="number" id="qty" class="form-control" placeholder="જથ્થો" min="1">
                           </div>
                        </div>

                        <div class="col-md-3">
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
                     <div class="col-md-6 mb-3">

                        <label class="form-label">
                           સપ્લાયરનું નામ
                        </label>

                        <input type="text" class="form-control" id="supplier_name" name="name" placeholder="સપ્લાયરનું નામ">

                     </div>


                     <!-- Mobile -->
                     <div class="col-md-6 mb-3">

                        <label class="form-label">
                           સપ્લાયરનો મોબાઇલ નંબર
                        </label>

                        <input type="tel" class="form-control" id="new_supplier_mobile" name="mobile" placeholder="9876543210" maxlength="10" inputmode="numeric">

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
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <div class="card">
         <div class="justify-content-between d-flex p-1">
            <div>
               <h5 class="card-header">ખરીદીની યાદી</h5>
            </div>
            <!-- <div class="text-center justify-content-center">
                                <a href="add_new_product.html" class="btn btn-outline-primary mt-3">Add new</a>
                            </div> -->
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
                        <label class="form-label">આજે ચૂકવેલ રકમ</label>
                        <input type="number" id="paid_amount" class="form-control" value="0">
                     </div>

                     <div class="col-md-3 mb-3">
                        <label class="form-label text-danger">બાકી રકમ</label>
                        <input type="text" id="balance_amount" class="form-control text-danger fw-bold" value="0" readonly>
                     </div>
                     <div class="row">
                        <div class="col-md-6 mt-5 mb-5">
                           <button type="button" id="finalSaveBtn" class="btn btn-outline-success">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </div>

      </div>
   </div>
   <!-- / Content -->







   <!-- Place this tag before closing body tag for github widget button. -->
   <script async defer src="https://buttons.github.io/buttons.js"></script>
   <script>
      const tableBody = document.getElementById("billTableBody");
      let editingRow = null;
      document.getElementById("paid_amount").addEventListener("input", updateSummary);
      document.getElementById("saveBtn").addEventListener("click", function() {

         const productName = document.getElementById("product_name").value.trim();
         const qty = parseFloat(document.getElementById("qty").value) || 0;
         const rate = parseFloat(document.getElementById("rate").value) || 0;

         if (productName === "") {
            alert("કૃપા કરીને પ્રોડક્ટનું નામ દાખલ કરો.");
            return;
         }

         if (qty < 1) {
            alert("જથ્થો ઓછામાં ઓછો 1 હોવો જોઈએ.");
            return;
         }

         if (rate < 1) {
            alert("ભાવ ઓછામાં ઓછો 1 હોવો જોઈએ.");
            return;
         }

         const total = qty * rate;

            if (editingRow) {

                editingRow.dataset.name = productName;
                editingRow.dataset.qty = qty;
                editingRow.dataset.rate = rate;
                editingRow.dataset.total = total;

                editingRow.cells[1].textContent = productName;
                editingRow.cells[2].textContent = qty;
                editingRow.cells[3].textContent = "₹" + rate;
                editingRow.cells[4].textContent = "₹" + total;

                editingRow = null;

                document.getElementById("saveBtn").innerText = "સાચવો";

            }
            else{

                const rowNo = tableBody.rows.length + 1;

                const row = `
                    <tr
                        data-name="${productName}"
                        data-qty="${qty}"
                        data-rate="${rate}"
                        data-total="${total}"
                    >

                        <td>${rowNo}</td>
                        <td>${productName}</td>
                        <td>${qty}</td>
                        <td>₹${rate}</td>
                        <td>₹${total}</td>

                        <td>

                            <a href="javascript:void(0)" class="dropdown-item edit-btn">
                                <i class="bx bx-edit text-primary"></i>
                            </a>

                            <a href="javascript:void(0)" class="dropdown-item delete-btn">
                                <i class="bx bx-trash text-danger"></i>
                            </a>

                        </td>

                    </tr>
                `;

                tableBody.insertAdjacentHTML("beforeend", row);

            }

            updateSummary();

            document.getElementById("product_name").value="";
            document.getElementById("qty").value="";
            document.getElementById("rate").value="";
         updateSummary();

         // Clear input fields
         document.getElementById("product_name").value = "";
         document.getElementById("qty").value = "";
         document.getElementById("rate").value = "";
      });

      function updateSummary() {

         let totalQty = 0;
         let totalAmount = 0;

         [...tableBody.rows].forEach(row => {

            // Qty column
            totalQty += Number(row.cells[2].textContent);

            // Total column
            totalAmount += Number(
               row.cells[4].textContent.replace("₹", "")
            );

         });

         document.getElementById("total_qty").value = totalQty;
         document.getElementById("total_amount").value = totalAmount;

         const paidInput = document.getElementById("paid_amount");
         let paid = Number(paidInput.value) || 0;

         if (paid > totalAmount) {

            GlassToast.warning(
               'ચેતવણી',
               'આજે ચૂકવેલ રકમ કુલ રકમ કરતાં વધુ ન હોઈ શકે.'
            );

            paid = totalAmount;
            paidInput.value = totalAmount;

         }

         document.getElementById("balance_amount").value = Math.max(totalAmount - paid, 0);
      }

        // =========================
        // EDIT ROW
        // =========================

        document.addEventListener("click",function(e){

            if(e.target.closest(".edit-btn")){

                editingRow = e.target.closest("tr");

                document.getElementById("product_name").value =
                    editingRow.dataset.name;

                document.getElementById("qty").value =
                    editingRow.dataset.qty;

                document.getElementById("rate").value =
                    editingRow.dataset.rate;

                document.getElementById("saveBtn").innerText =
                    "સુધારો કરો";

                window.scrollTo({
                    top:0,
                    behavior:"smooth"
                });

            }

        });

      // Delete Row
      document.addEventListener("click", function(e) {

         if (e.target.closest(".delete-btn")) {

            e.target.closest("tr").remove();

            if(editingRow && !document.body.contains(editingRow)){

                editingRow = null;

                document.getElementById("saveBtn").innerText="સાચવો";

            }

            // Re-number rows
            [...tableBody.rows].forEach((row, index) => {
               row.cells[0].textContent = index + 1;
            });
            updateSummary();

         }

      });

   </script>
{{-- ADD NEW SUPLIER  --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        const form = document.getElementById('supplierForm');

        const name = document.getElementById('supplier_name');

        const mobile = document.getElementById('new_supplier_mobile');

        const address = document.getElementById('new_supplier_address');

        const saveBtn = document.getElementById('saveSupplierBtn');

        const saveText = document.getElementById('saveSupplierText');


        // ==========================================
        // MOBILE - ONLY NUMBERS + MAX 10 DIGITS
        // ==========================================

        mobile.addEventListener('input', function () {

            this.value = this.value
                .replace(/[^0-9]/g, '')
                .slice(0, 10);

        });


        // ==========================================
        // FORM SUBMIT
        // ==========================================

        form.addEventListener('submit', async function (e) {

            e.preventDefault();


            const nameValue = name.value.trim();

            const mobileValue = mobile.value.trim();

            const addressValue = address.value.trim();


            // ==========================================
            // NAME VALIDATION
            // ==========================================

            if (nameValue === '') {

                GlassToast.warning(
                    'ચેતવણી',
                    'સપ્લાયરનું નામ દાખલ કરો.'
                );

                name.focus();

                return;
            }


            // ==========================================
            // MOBILE VALIDATION
            // ONLY EXACTLY 10 DIGITS
            // ==========================================

            if (mobileValue === '') {

                GlassToast.warning(
                    'ચેતવણી',
                    'મોબાઇલ નંબર દાખલ કરો.'
                );

                mobile.focus();

                return;
            }


            if (mobileValue.length !== 10) {

                GlassToast.error(
                    'ભૂલ',
                    'મોબાઇલ નંબર 10 અંકનો હોવો જોઈએ.'
                );

                mobile.focus();

                return;
            }


            // ==========================================
            // ADDRESS VALIDATION
            // ==========================================

            if (addressValue === '') {

                GlassToast.warning(
                    'ચેતવણી',
                    'સરનામું દાખલ કરો.'
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
                    "{{ route('suppliers.store') }}",
                    {
                        method: 'POST',

                        headers: {

                            'X-CSRF-TOKEN':
                                document.querySelector(
                                    '#supplierForm input[name="_token"]'
                                ).value,

                            'Accept': 'application/json',

                            'X-Requested-With':
                                'XMLHttpRequest'

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
                        'સફળતા',
                        data.message
                    );


                    form.reset();


                    setTimeout(function () {

                        const modalElement =
                            document.getElementById('largeModal');

                        const modal =
                            bootstrap.Modal.getInstance(modalElement);

                        if (modal) {
                            modal.hide();
                        }

                    }, 500);


                    setTimeout(function () {
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
                            'સપ્લાયરનું નામ',
                            data.errors.name[0]
                        );

                    }

                    else if (data.errors.mobile) {

                        GlassToast.error(
                            'મોબાઇલ નંબર',
                            data.errors.mobile[0]
                        );

                    }

                    else if (data.errors.address) {

                        GlassToast.error(
                            'સરનામું',
                            data.errors.address[0]
                        );

                    }

                }


                // ==========================================
                // OTHER ERROR
                // ==========================================

                else {

                    GlassToast.error(
                        'ભૂલ',
                        data.message || 'કંઈક ખોટું થયું.'
                    );

                }

            }

            catch (error) {

                console.error(
                    'Supplier AJAX Error:',
                    error
                );

                GlassToast.error(
                    'ભૂલ',
                    'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.'
                );

            }


            finally {

                saveBtn.disabled = false;

                saveText.innerText = 'સાચવો';

            }

        });

    });

    </script>
{{-- AUTO LIST SUPPLIER --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const supplierSelect = document.getElementById('supplier_id');
        const mobileInput = document.getElementById('supplier_mobile');
        const addressInput = document.getElementById('supplier_address');

        supplierSelect.addEventListener('change', function () {

            const selectedOption =
                this.options[this.selectedIndex];

            if (this.value === '') {

                mobileInput.value = '';
                addressInput.value = '';

                return;
            }

            // Get data from selected option
            const mobile =
                selectedOption.getAttribute('data-mobile');

            const address =
                selectedOption.getAttribute('data-address');

            // Automatically fill
            mobileInput.value = mobile || '';
            addressInput.value = address || '';

        });

    });
    </script>
{{-- SAVE FULL PURCHASE (SUPPLIER + PRODUCTS + PAID AMOUNT) --}}
<script>
    document.getElementById("finalSaveBtn").addEventListener("click", async function () {

        const supplierId = document.getElementById("supplier_id").value;

        if (supplierId === "") {
            GlassToast.warning(
                'ચેતવણી',
                'કૃપા કરીને સપ્લાયર પસંદ કરો.'
            );
            return;
        }

        if (tableBody.rows.length === 0) {
            GlassToast.warning(
                'ચેતવણી',
                'કૃપા કરીને ઓછામાં ઓછું એક પ્રોડક્ટ ઉમેરો.'
            );
            return;
        }

        const totalAmount = Number(document.getElementById("total_amount").value) || 0;
        const paidAmountCheck = Number(document.getElementById("paid_amount").value) || 0;

        if (paidAmountCheck > totalAmount) {
            GlassToast.warning(
                'ચેતવણી',
                'આજે ચૂકવેલ રકમ કુલ રકમ કરતાં વધુ ન હોઈ શકે.'
            );
            return;
        }

        const items = [...tableBody.rows].map(row => ({
            product_name: row.dataset.name,
            qty: row.dataset.qty,
            rate: row.dataset.rate,
        }));

        const paidAmount = document.getElementById("paid_amount").value || 0;

        const saveBtn = this;
        const originalText = saveBtn.innerText;

        saveBtn.disabled = true;
        saveBtn.innerText = 'સાચવી રહ્યું છે...';

        try {

            const response = await fetch("{{ route('purchases.store') }}", {

                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },

                body: JSON.stringify({
                    supplier_id: supplierId,
                    paid_amount: paidAmount,
                    items: items,
                }),

            });

            const data = await response.json();

            console.log('Purchase Response:', data);


            // ==========================================
            // SUCCESS
            // ==========================================

            if (response.ok && data.status === true) {

                GlassToast.success(
                    'સફળતા',
                    data.message
                );

                tableBody.innerHTML = "";

                document.getElementById("paid_amount").value = 0;

                updateSummary();

            }


            // ==========================================
            // VALIDATION ERROR
            // ==========================================

            else if (
                response.status === 422 &&
                data.errors
            ) {

                const firstErrorKey = Object.keys(data.errors)[0];

                GlassToast.error(
                    'ભૂલ',
                    data.errors[firstErrorKey][0]
                );

            }


            // ==========================================
            // OTHER ERROR
            // ==========================================

            else {

                GlassToast.error(
                    'ભૂલ',
                    data.message || 'કંઈક ખોટું થયું.'
                );

            }

        }

        catch (error) {

            console.error('Purchase AJAX Error:', error);

            GlassToast.error(
                'ભૂલ',
                'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.'
            );

        }

        finally {

            saveBtn.disabled = false;

            saveBtn.innerText = originalText;

        }

    });
</script>

   @include('layout.footer')
