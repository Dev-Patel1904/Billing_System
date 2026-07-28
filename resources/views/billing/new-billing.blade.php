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
                                                <input type="text" class="form-control" id="customerMobile"
                                                    placeholder="ગ્રાહકનો મોબાઇલ નંબર">
                                            </div>

                                            <div class="mb-0">
                                                <label class="form-label">ગ્રાહકનું નામ</label>

                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="ગ્રાહકનું નામ">

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
                                                                <input type="text" id="productName"
                                                                    class="form-control productName"
                                                                    placeholder="પ્રોડક્ટનું નામ">

                                                                <span class="input-group-text voiceProduct voice-btn">
                                                                    <i class="bx bx-microphone"></i>
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">નંગ / જથ્થો</label>
                                                            <input type="number" id="qty" class="form-control"
                                                                placeholder="0">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label class="form-label">રકમ</label>
                                                            <input type="number" id="rate" class="form-control"
                                                                placeholder="₹ 0.00">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                id="addItem">
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
                                        <form>

                                            <div class="table-responsive text-nowrap mt-3">
                                                <table class="table table-bordered text-center align-middle"
                                                    id="productTable">

                                                    <thead class="table-light">
                                                        <tr>
                                                            <th width="10%">NO</th>
                                                            <th>Product Name</th>
                                                            <th>QTY</th>
                                                            <th>Rate (₹)</th>
                                                            <th>Amount (₹)</th>
                                                            <th width="8%">Action</th>
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
                                                            <input type="text" id="total_qty"
                                                                class="form-control text-end" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center mb-3">
                                                        <div class="col-md-6">
                                                            <label class="fw-semibold">કુલ રકમ</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" id="total_amount"
                                                                class="form-control text-end" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row align-items-center mb-3" id="previousDueRow">
                                                        <div class="col-md-6">
                                                            <label class="fw-semibold text-danger">આગળની બાકી
                                                                રકમ</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="number" id="previous_due" disabled
                                                                class="form-control text-end" value="10"
                                                                placeholder="₹ 0.00">
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="row align-items-center mb-4">
                                                        <div class="col-md-6">
                                                            <label class="fw-bold text-success fs-5">ચૂકવવાની કુલ
                                                                રકમ</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" id="grand_total"
                                                                class="form-control form-control-lg fw-bold text-end border-success"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    <div class="border rounded-3 p-3">
                                                        <label class="form-label fw-bold mb-3">બિલનો પ્રકાર</label>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="bill_type" id="withoutGst"
                                                                        value="without_gst" checked>
                                                                    <label class="form-check-label fw-semibold"
                                                                        for="withoutGst">
                                                                        GST વગર
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="bill_type" id="withGst" value="with_gst">
                                                                    <label class="form-check-label fw-semibold"
                                                                        for="withGst">
                                                                        GST સાથે
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row g-3 mt-3">
                                                <div class="col-6">
                                                    <a href="pdf.html"
                                                        class="btn btn-outline-warning w-100 d-flex align-items-center justify-content-center gap-2 py-2"
                                                        id="dueBtn">
                                                        <i class="bx bx-time-five fs-4"></i>
                                                        <span class="fw-semibold">બાકી</span>
                                                </a>
                                                </div>

                                                <div class="col-6">
                                                    <a href="pdf.html"
                                                        class="btn btn-outline-success w-100 d-flex align-items-center justify-content-center gap-2 py-2"
                                                        id="cashBtn">
                                                        <i class="bx bx-money fs-4"></i>
                                                        <span class="fw-semibold">રોકડ</span>
                                                </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->


    <script>

        $(document).ready(function () {
            // Recalculate when Previous Due changes
            $(document).on("input keyup change", "#previous_due", function () {
                updateTotals();
            });
            updateTotals();

            // Add Item
            $("#addItem").click(function () {

                let product = $("#productName").val().trim();
                let qty = parseFloat($("#qty").val()) || 0;
                let rate = parseFloat($("#rate").val()) || 0;

                if (product == "") {
                    alert("Please enter Product Name");
                    $("#productName").focus();
                    return;
                }

                if (qty <= 0) {
                    alert("Please enter Qty");
                    $("#qty").focus();
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
                <button type="button"
                        class="btn btn-danger btn-sm removeRow">
                    <i class="bx bx-trash"></i>
                </button>
            </td>

        </tr>
        `;

                $("#productTable tbody").append(row);

                // Clear Inputs
                $("#productName").val('');
                $("#qty").val('');
                $("#rate").val('');

                updateTotals();

            });




            // Remove Row

            $(document).on("click", ".removeRow", function () {

                $(this).closest("tr").remove();

                $("#productTable tbody tr").each(function (index) {

                    $(this).find(".row-no").text(index + 1);

                });

                updateTotals();

            });




            function updateTotals() {

                let totalQty = 0;
                let totalAmount = 0;

                $(".qty").each(function () {
                    totalQty += parseFloat($(this).val()) || 0;
                });

                $(".amount").each(function () {
                    totalAmount += parseFloat($(this).val()) || 0;
                });

                let previousDue = parseFloat($("#previous_due").val()) || 0;

                let grandTotal = totalAmount + previousDue;

                $("#total_qty").val(totalQty);
                $("#total_amount").val(totalAmount.toFixed(2));
                $("#grand_total").val(grandTotal.toFixed(2));
            }

        });


    </script>
    <style>
        .voice-btn {
            cursor: pointer;
            transition: 0.3s;
        }

        .voice-btn:hover {
            background: #f0f0f0;
            color: #696cff;
        }

        .voice-btn.listening {
            color: #dc3545;
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.15);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <script>
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

        if (SpeechRecognition) {
            const recognition = new SpeechRecognition();
            recognition.lang = 'gu-IN'; // Gujarati
            recognition.interimResults = false;
            recognition.continuous = false;

            const input = document.querySelector('input[placeholder="ગ્રાહકનું નામ"]');
            const btn = document.getElementById('voiceCustomerName');

            btn.addEventListener('click', () => {
                btn.classList.add('listening');
                recognition.start();
            });

            recognition.onresult = function (event) {
                input.value = event.results[0][0].transcript;
            };

            recognition.onend = function () {
                btn.classList.remove('listening');
            };

            recognition.onerror = function () {
                btn.classList.remove('listening');
            };
        } else {
            alert("અવાજ ઓળખવામાં ભૂલ થઈ");
        }
    </script>
    <script>
        const SpeechRecognitionP = window.SpeechRecognition || window.webkitSpeechRecognition;

        if (SpeechRecognitionP) {

            document.addEventListener("click", function (e) {

                const btn = e.target.closest(".voiceProduct");

                if (!btn) return;

                const input = btn.closest(".input-group").querySelector(".productName");

                const recognition = new SpeechRecognitionP();

                recognition.lang = "gu-IN";
                recognition.interimResults = false;
                recognition.continuous = false;

                btn.classList.add("listening");

                recognition.start();

                recognition.onresult = function (event) {
                    input.value = event.results[0][0].transcript;
                };

                recognition.onend = function () {
                    btn.classList.remove("listening");
                };

                recognition.onerror = function () {
                    btn.classList.remove("listening");
                    alert("અવાજ ઓળખવામાં ભૂલ થઈ.");
                };

            });

        } else {
            alert("તમારું બ્રાઉઝર Voice Recognition ને સપોર્ટ કરતું નથી.");
        }
    </script>




    @include('layout.footer')
