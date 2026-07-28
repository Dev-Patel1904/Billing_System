@include('layout.sidebar')


                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 mt-6"> <!-- container-p-y -->
                        <!-- Basic Layout -->
                        <div class="row gy-6">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">ખરીદીની માહિતી</h5>

                                        <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#largeModal">
                                            નવો સપ્લાયર ઉમેરો
                                        </button>
                                    </div>

                                    <div class="card-body">
                                        <form>

                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="mb-6">
                                                        <label class="form-label">સપ્લાયરનું નામ</label>

                                                        <select class="form-control">
                                                            <option value="">સપ્લાયર પસંદ કરો</option>
                                                            <option value="vijay">Vijay</option>
                                                            <option value="rahul">Rahul</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-6">
                                                        <label class="form-label">સપ્લાયરનો મોબાઇલ નંબર</label>

                                                        <input type="text" class="form-control"
                                                            placeholder="સપ્લાયરનો મોબાઇલ નંબર">
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="mb-6">
                                                        <label class="form-label">સરનામું</label>

                                                        <textarea class="form-control"
                                                            placeholder="સરનામું દાખલ કરો"></textarea>
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

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">જથ્થો</label>
                                                        <input type="number" id="qty" class="form-control"
                                                            placeholder="જથ્થો">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="mb-3">
                                                        <label class="form-label">ભાવ</label>
                                                        <input type="number" id="rate" class="form-control"
                                                            placeholder="ભાવ">
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
                    <!-- model code -->
                    <div class="modal fade" id="largeModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel3">
                                        નવો સપ્લાયર ઉમેરો
                                    </h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">

                                    <div class="row">

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">સપ્લાયરનું નામ</label>
                                            <input type="text" class="form-control" placeholder="સપ્લાયરનું નામ">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">સપ્લાયરનો મોબાઇલ નંબર</label>
                                            <input type="number" class="form-control"
                                                placeholder="સપ્લાયરનો મોબાઇલ નંબર">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label">સરનામું</label>
                                            <textarea class="form-control" rows="3"
                                                placeholder="સરનામું દાખલ કરો"></textarea>
                                        </div>

                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                        બંધ કરો
                                    </button>

                                    <button type="button" class="btn btn-primary">
                                        સાચવો
                                    </button>

                                </div>

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
                                                <input type="text" id="total_qty" class="form-control" value="0"
                                                    readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">કુલ રકમ</label>
                                                <input type="text" id="total_amount" class="form-control" value="0"
                                                    readonly>
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label">આજે ચૂકવેલ રકમ</label>
                                                <input type="number" id="paid_amount" class="form-control" value="0">
                                            </div>

                                            <div class="col-md-3 mb-3">
                                                <label class="form-label text-danger">બાકી રકમ</label>
                                                <input type="text" id="balance_amount"
                                                    class="form-control text-danger fw-bold" value="0" readonly>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-5 mb-5">
                                                    <button class="btn btn-outline-success">Save</button>
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
        document.getElementById("paid_amount").addEventListener("input", updateSummary);
        document.getElementById("saveBtn").addEventListener("click", function () {

            const productName = document.getElementById("product_name").value.trim();
            const qty = parseFloat(document.getElementById("qty").value) || 0;
            const rate = parseFloat(document.getElementById("rate").value) || 0;

            if (productName === "") {
                alert("કૃપા કરીને પ્રોડક્ટનું નામ દાખલ કરો.");
                return;
            }

            const total = qty * rate;
            const rowNo = tableBody.rows.length + 1;



            const row = `
            <tr data-qty="${qty}" data-total="${total}">
                <td>${rowNo}</td>
                <td>${productName}</td>
                <td>${qty}</td>
                <td>₹${rate}</td>
                <td>₹${total}</td>
                <td>
                    <a class="dropdown-item delete-btn" href="javascript:void(0);">
                        <i class="bx bx-trash"></i>
                    </a>
                </td>
            </tr>
            `;

            tableBody.insertAdjacentHTML("beforeend", row);
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

            const paid = Number(document.getElementById("paid_amount").value) || 0;

            document.getElementById("balance_amount").value = Math.max(totalAmount - paid, 0);
        }

        // Delete Row
        document.addEventListener("click", function (e) {

            if (e.target.closest(".delete-btn")) {

                e.target.closest("tr").remove();

                // Re-number rows
                [...tableBody.rows].forEach((row, index) => {
                    row.cells[0].textContent = index + 1;
                });
                updateSummary();

            }

        });
    </script>
@include('layout.footer')

