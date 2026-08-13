@include('layout.sidebar')
<style>
    /* ========================================
   Premium Supplier Field
======================================== */

    .supplier-field {
        position: relative;
    }

    /* ========================================
   Label
======================================== */

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

    /* ========================================
   Label Icon
======================================== */

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

    /* ========================================
   Select Wrapper
======================================== */

    .supplier-select-wrapper {
        position: relative;
    }

    /* ========================================
   Left Icon
======================================== */

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

    /* ========================================
   Select2 Container
======================================== */

    .supplier-select-wrapper .select2-container {
        width: 100% !important;
    }

    /* ========================================
   Select2 Main Field
======================================== */

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

    /* ========================================
   Selected Text
======================================== */

    .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__rendered {

        line-height: 40px;

        padding-left: 45px;
        padding-right: 45px;

        color: #111827;

        font-size: 14px;
    }

    /* ========================================
   Select2 Arrow
======================================== */

    .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__arrow {

        height: 40px;

        right: 12px;
    }

    /* ========================================
   Focus / Open
======================================== */

    .supplier-select-wrapper .select2-container--default.select2-container--open .select2-selection--single,

    .supplier-select-wrapper .select2-container--default .select2-selection--single:focus {

        border-color: #6366f1;

        box-shadow:
            0 0 0 4px rgba(99, 102, 241, 0.10);
    }

    /* ========================================
   Search Dropdown
======================================== */

    .select2-container--default .select2-dropdown {

        margin-top: 6px;

        border: 1px solid #e5e7eb;

        border-radius: 12px;

        overflow: hidden;

        background: #fff;

        box-shadow:
            0 12px 30px rgba(15, 23, 42, 0.12);
    }

    /* ========================================
   Search Area
======================================== */

    .select2-container--default .select2-search--dropdown {

        padding: 10px;

        background: #fff;
    }

    /* ========================================
   Search Input
======================================== */

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

    /* Search Focus */

    .select2-container--default .select2-search--dropdown .select2-search__field:focus {

        border-color: #6366f1;

        box-shadow:
            0 0 0 3px rgba(99, 102, 241, 0.08);
    }

    /* ========================================
   Dropdown Options
======================================== */

    .select2-container--default .select2-results__option {

        padding: 10px 14px;

        font-size: 14px;

        color: #374151;

        transition:
            background-color 0.15s ease,
            color 0.15s ease;
    }

    /* Hover / Highlight */

    .select2-container--default .select2-results__option--highlighted[aria-selected] {

        background: #f3f4ff;

        color: #4f46e5;
    }

    /* ========================================
   Selected Option
======================================== */

    .select2-container--default .select2-results__option[aria-selected="true"] {

        background: #f8f8ff;

        color: #4f46e5;

        font-weight: 500;
    }

    /* ========================================
   No Results
======================================== */

    .select2-container--default .select2-results__option.select2-results__message {

        padding: 12px 14px;

        color: #9ca3af;

        font-size: 13px;

        text-align: center;
    }

    /* ========================================
   Hint
======================================== */

    .supplier-hint {

        margin-top: 7px;

        color: #9ca3af;

        font-size: 11px;
    }

    /* Hint Icon */

    .supplier-hint i {

        margin-right: 4px;

        color: #6366f1;
    }

    /* ========================================
   Clear Button
======================================== */

    .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__clear {

        height: 40px;

        margin-right: 5px;

        color: #9ca3af;

        font-size: 18px;

        line-height: 38px;
    }

    /* Clear Hover */

    .supplier-select-wrapper .select2-container--default .select2-selection--single .select2-selection__clear:hover {

        color: #ef4444;
    }

    /* ========================================
   Responsive
======================================== */

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

                                                <select class="form-control premium-supplier-select" id="supplier_id"
                                                    name="supplier_id">
                                                    <option value=""></option>

                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}"
                                                            data-mobile="{{ $supplier->mobile }}"
                                                            data-address="{{ $supplier->address }}">
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

                                        <textarea class="form-control" id="supplier_address" name="supplier_address" placeholder="સરનામું દાખલ કરો"
                                            rows="3" readonly></textarea>

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
                                        <input type="text" id="product_name" class="form-control"
                                            placeholder="પ્રોડક્ટનું નામ">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Qty(જથ્થો/નંગ)</label>
                                        <input type="number" id="qty" class="form-control" placeholder="જથ્થો"
                                            min="1">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="prakar" class="form-label">પ્રકાર</label>

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
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">ભાવ</label>
                                        <input type="number" id="rate" class="form-control" placeholder="ભાવ"
                                            min="1">
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

                                <input type="text" class="form-control" id="supplier_name" name="name"
                                    placeholder="સપ્લાયરનું નામ">

                            </div>




                            <!-- Address -->
                            <div class="col-12">

                                <label class="form-label">
                                    સરનામું
                                </label>

                                <textarea class="form-control" id="new_supplier_address" name="address" rows="3"
                                    placeholder="સરનામું દાખલ કરો"></textarea>

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
                                <input type="text" id="total_amount" class="form-control" value="0"
                                    readonly>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label">ચૂકવેલ રકમ</label>
                                <input type="number" id="paid_amount" class="form-control" value="0">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label class="form-label text-danger">બાકી રકમ</label>
                                <input type="text" id="balance_amount" class="form-control text-danger fw-bold"
                                    value="0" readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-5 mb-5">
                                    <button type="button" id="finalSaveBtn"
                                        class="btn btn-outline-success">Save</button>
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

        // ========================================
        // PAID AMOUNT
        // ========================================

        document.getElementById("paid_amount").addEventListener("input", updateSummary);


        // ========================================
        // SAVE / UPDATE PRODUCT
        // ========================================

        document.getElementById("saveBtn").addEventListener("click", function() {

            const productName =
                document.getElementById("product_name").value.trim();

            const qty =
                parseFloat(document.getElementById("qty").value) || 0;

            const rate =
                parseFloat(document.getElementById("rate").value) || 0;


            // ========================================
            // PRAKAR
            // ========================================

            const prakarSelect =
                document.getElementById("prakar");

            const prakarValue =
                prakarSelect.value;

            const prakarText =
                prakarSelect.options[prakarSelect.selectedIndex].text;


            // ========================================
            // VALIDATION
            // ========================================

            if (productName === "") {

                alert("કૃપા કરીને પ્રોડક્ટનું નામ દાખલ કરો.");
                return;
            }


            if (prakarValue === "") {

                alert("કૃપા કરીને પ્રકાર પસંદ કરો.");
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
                    "afterbegin",
                    row
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

                if (typeof GlassToast !== "undefined") {

                    GlassToast.warning(
                        "ચેતવણી",
                        "આજે ચૂકવેલ રકમ કુલ રકમ કરતાં વધુ ન હોઈ શકે."
                    );

                } else {

                    alert(
                        "આજે ચૂકવેલ રકમ કુલ રકમ કરતાં વધુ ન હોઈ શકે."
                    );
                }


                paid = totalAmount;

                paidInput.value =
                    totalAmount;
            }


            // ========================================
            // BALANCE
            // ========================================

            const balance =
                Math.max(
                    totalAmount - paid,
                    0
                );


            document.getElementById("balance_amount").value =
                balance;
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
                top: 0,
                behavior: "smooth"
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

            const mobile = document.getElementById('new_supplier_mobile');

            const address = document.getElementById('new_supplier_address');

            const saveBtn = document.getElementById('saveSupplierBtn');

            const saveText = document.getElementById('saveSupplierText');


            // ==========================================
            // MOBILE - ONLY NUMBERS + MAX 10 DIGITS
            // ==========================================

            mobile.addEventListener('input', function() {

                this.value = this.value
                    .replace(/[^0-9]/g, '')
                    .slice(0, 10);

            });


            // ==========================================
            // FORM SUBMIT
            // ==========================================

            form.addEventListener('submit', async function(e) {

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
                            'સફળતા',
                            data.message
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
                                'સપ્લાયરનું નામ',
                                data.errors.name[0]
                            );

                        } else if (data.errors.mobile) {

                            GlassToast.error(
                                'મોબાઇલ નંબર',
                                data.errors.mobile[0]
                            );

                        } else if (data.errors.address) {

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

                } catch (error) {

                    console.error(
                        'Supplier AJAX Error:',
                        error
                    );

                    GlassToast.error(
                        'ભૂલ',
                        'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.'
                    );

                } finally {

                    saveBtn.disabled = false;

                    saveText.innerText = 'સાચવો';

                }

            });

        });
    </script>
    {{-- AUTO LIST SUPPLIER --}}

    {{-- SAVE FULL PURCHASE (SUPPLIER + PRODUCTS + PAID AMOUNT) --}}
    <script>
        document.getElementById("finalSaveBtn").addEventListener("click", async function() {

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

            } catch (error) {

                console.error('Purchase AJAX Error:', error);

                GlassToast.error(
                    'ભૂલ',
                    'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.'
                );

            } finally {

                saveBtn.disabled = false;

                saveBtn.innerText = originalText;

            }

        });
    </script>
    <script>
        $(document).ready(function() {

            // Initialize Select2
            $('#supplier_id').select2({
                placeholder: 'સપ્લાયર પસંદ કરો',
                allowClear: true,
                width: '100%'
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

                // Fill mobile and address
                $('#supplier_address').val(address);
            });

        });
    </script>
    @include('layout.footer')
