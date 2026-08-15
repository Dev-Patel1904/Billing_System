@include('layout.sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card border-0 shadow-sm">

            <!-- Header -->
            <div class="card-header bg-white py-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                    <div>
                        <h4 class="mb-1 fw-bold">
                            <i class="bx bx-detail text-primary me-2"></i>
                            બિલની યાદી
                        </h4>
                        <small class="text-muted">
                            આ ગ્રાહકના તમામ વેચાણ બિલ
                        </small>
                    </div>

                    <a href="{{ route('customer_list') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i>
                        પાછળ જાઓ
                    </a>

                </div>
            </div>

            <!-- Customer Info -->
            <div class="card-body border-bottom pb-3">

                <div class="row g-3">

                    <div class="col-md-3">
                        <div class="card border shadow-sm h-100">
                            <div class="card-body">
                                <small class="text-muted d-block mb-1">
                                    <i class="bx bx-user text-primary"></i>
                                    ગ્રાહકનું નામ
                                </small>
                                <h6 class="fw-bold mb-0">
                                    {{ $customer->name }}
                                </h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border shadow-sm h-100">
                            <div class="card-body">
                                <small class="text-muted d-block mb-1">
                                    <i class="bx bx-id-card text-success"></i>
                                    ગ્રાહક ID
                                </small>
                                <h6 class="fw-bold mb-0">
                                    CUS{{ str_pad($customer->id, 3, '0', STR_PAD_LEFT) }}
                                </h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card border shadow-sm h-100">
                            <div class="card-body">
                                <small class="text-muted d-block mb-1">
                                    <i class="bx bx-phone text-info"></i>
                                    મોબાઇલ નંબર
                                </small>
                                <h6 class="fw-bold mb-0">
                                    {{ $customer->mobile }}
                                </h6>
                            </div>
                        </div>
                    </div>

                    <!-- બાકી રકમ અને બટન -->
                    <div class="col-md-3">
                        <div class="card border shadow-sm h-100 bg-light">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <small class="text-muted d-block mb-1">
                                        <i class="bx bx-wallet text-danger"></i>
                                        કુલ બાકી રકમ
                                    </small>
                                    <h6 class="fw-bold mb-0 text-danger" id="displayBalanceDue">
                                        ₹{{ number_format($customer->balance_due, 2) }}
                                    </h6>
                                </div>
                                @if($customer->balance_due > 0)
                                    <div class="mt-2">
                                        <button type="button" class="btn btn-sm btn-success w-100" id="openDueModalBtn">
                                            <i class="bx bx-money"></i> બાકી જમા કરો
                                        </button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Search & Filter -->
            <div class="card-body border-bottom">

                <form method="GET" action="{{ route('customer.bills', $customer->id) }}">

                    <div class="row g-3">

                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bx bx-search"></i>
                                </span>
                                <input type="text" name="search" class="form-control" placeholder="બિલ નંબર શોધો..." value="{{ $search }}">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <input type="date" name="date" class="form-control" value="{{ $date }}">
                        </div>

                        <div class="col-lg-2">
                            <select name="payment_type" class="form-select">
                                <option value="">ચુકવણી પ્રકાર</option>
                                <option value="cash" @selected($paymentType === 'cash')>રોકડ</option>
                                <option value="due" @selected($paymentType === 'due')>બાકી</option>
                            </select>
                        </div>

                        <div class="col-lg-1">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bx bx-filter-alt"></i>
                            </button>
                        </div>

                        <div class="col-lg-1">
                            <a href="{{ route('customer.bills', $customer->id) }}" class="btn btn-outline-secondary w-100">
                                <i class="bx bx-reset"></i>
                            </a>
                        </div>

                    </div>

                </form>

            </div>

            <!-- Billing Table -->
            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">

                        <tr>

                            <th>ક્રમાંક</th>
                            <th>બિલ નંબર</th>
                            <th>તારીખ</th>
                            <th>કુલ વસ્તુઓ</th>
                            <th>કુલ રકમ</th>

                            <th class="text-center">ક્રિયા</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($bills as $index => $bill)

                        <tr>

                            <td>{{ $bills->firstItem() + $index }}</td>

                            <td>
                                <span class="fw-bold text-primary">
                                    BILL-{{ str_pad($bill->bill_no, 4, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            <td>{{ $bill->created_at->format('d-m-Y') }}</td>

                            <td>
                                <span class="badge bg-primary">
                                    {{ $bill->items_count }}
                                </span>
                            </td>

                            <td class="fw-bold text-success">
                                ₹{{ $bill->grand_total }}
                            </td>

                            <td class="text-center">

                                <a href="{{ route('show_sales', $bill->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bx bx-show"></i>
                                </a>

                                <a href="{{ route('billing.pdf', $bill->id) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    <i class="bx bx-printer"></i>
                                </a>

                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                આ ગ્રાહકનું હજુ સુધી કોઈ બિલ નથી.
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

                <!-- Footer -->
                <div class="card-footer bg-white">

                    <div class="d-flex flex-wrap justify-content-between align-items-center">

                        <small class="text-muted">
                            {{ $bills->total() }} બિલમાંથી {{ $bills->total() ? $bills->firstItem() : 0 }} થી {{ $bills->lastItem() ?? 0 }} દર્શાવવામાં આવ્યા છે
                        </small>

                        <nav>

                            <ul class="pagination pagination-sm mb-0">

                                <li class="page-item {{ $bills->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $bills->onFirstPage() ? '#' : $bills->previousPageUrl() }}">પાછળ</a>
                                </li>

                                @php
                                    $current = $bills->currentPage();
                                    $last = $bills->lastPage();
                                    $window = 1;
                                @endphp

                                <li class="page-item {{ $current == 1 ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $bills->url(1) }}">1</a>
                                </li>

                                @if ($current - $window > 2)
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">...</a>
                                    </li>
                                @endif

                                @for ($page = max(2, $current - $window); $page <= min($last - 1, $current + $window); $page++)

                                    <li class="page-item {{ $current == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $bills->url($page) }}">{{ $page }}</a>
                                    </li>

                                @endfor

                                @if ($current + $window < $last - 1)
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">...</a>
                                    </li>
                                @endif

                                @if ($last > 1)
                                    <li class="page-item {{ $current == $last ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $bills->url($last) }}">{{ $last }}</a>
                                    </li>
                                @endif

                                <li class="page-item {{ !$bills->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $bills->hasMorePages() ? $bills->nextPageUrl() : '#' }}">આગળ</a>
                                </li>

                            </ul>

                        </nav>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
<!-- / Content -->

{{-- MODEL FOR BAKI CHUKVANI RAKAM --}}
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
                    <input type="number" id="modal_previous_due" class="form-control" value="{{ $customer->balance_due }}" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">બાકી ચૂકવણી રકમ</label>
                    <input type="number" id="paid_due_amount" class="form-control" placeholder="રકમ દાખલ કરો">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">બંધ</button>
                <button class="btn btn-success" id="saveDuePayment">₹ જમા કરો</button>
            </div>

        </div>
    </div>
</div>

@include('layout.footer')

<!-- jQuery & AJAX Script for Modal functionality -->
<script>
    $(document).ready(function() {
        let currentBalanceDue = {{ $customer->balance_due }};
        let customerMobile = "{{ $customer->mobile }}";

        // Open Modal
        $("#openDueModalBtn").on("click", function() {
            $("#modal_previous_due").val(currentBalanceDue);
            $("#paid_due_amount").val('');
            let modal = new bootstrap.Modal(document.getElementById('duePaymentModal'));
            modal.show();
        });

        // Save Due Payment via AJAX
        $("#saveDuePayment").click(function() {
            let paidAmount = parseFloat($("#paid_due_amount").val()) || 0;

            if (paidAmount <= 0) {
                GlassToast.warning("રકમ", "ચૂકવણી રકમ દાખલ કરો.");
                return;
            }

            if (paidAmount > currentBalanceDue) {
                GlassToast.warning("રકમ", "ચૂકવણી રકમ બાકી રકમ કરતાં વધુ હોઈ શકે નહીં.");
                return;
            }

            GlassToast.confirm(
                "ચૂકવણીની ખાતરી", "શું તમે બાકી રકમની ચૂકવણી સેવ કરવા માંગો છો?",
                function() {
                    $.ajax({
                        url: "{{ route('billing.pay-due') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            customer_mobile: customerMobile,
                            paid_amount: paidAmount
                        },
                        success: function(res) {
                            if (res.success) {
                                currentBalanceDue = res.remaining_due;
                                $("#modal_previous_due").val(currentBalanceDue);
                                $("#displayBalanceDue").text("₹" + currentBalanceDue.toFixed(2));

                                if (currentBalanceDue <= 0) {
                                    $("#openDueModalBtn").closest('.col-md-3').fadeOut();
                                }

                                GlassToast.success("સફળ", res.message);

                                bootstrap.Modal.getInstance(
                                    document.getElementById('duePaymentModal')
                                ).hide();

                                // Optional: reload to sync everything cleanly
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);

                            } else {
                                GlassToast.warning("ભૂલ", res.message);
                            }
                        },
                        error: function(xhr) {
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