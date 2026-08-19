@include('layout.sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card border-0 shadow-sm">
            
            @php
                $totalBalanceDue = $purchases->sum('balance_amount');
            @endphp

            <!-- Header -->
            <div class="justify-content-between d-flex align-items-center flex-wrap gap-3 p-3 border-bottom">
                <div>
                    <h5 class="card-header p-0 mb-1">
                        {{ $supplier->name }} ની ખરીદીઓ
                    </h5>
                    <small class="text-muted">
                        {{ $supplier->mobile }} &bull; {{ $supplier->address }}
                    </small>
                </div>

                <div class="d-flex align-items-center gap-2">
                    @if($totalBalanceDue > 0)
                        <button type="button" class="btn btn-sm btn-success" id="openDueModalBtn" style="{{ $totalBalanceDue <= 0 ? 'display: none;' : '' }}">
                            <i class="bx bx-money me-1"></i> બાકી રકમ જમા કરો
                        </button>
                    @endif

                    <a href="{{ route('supplier_list') }}" class="btn btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i>
                        પાછળ જાઓ
                    </a>
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>તારીખ</th>
                            <th>કુલ જથ્થો</th>
                            <th>ચૂકવેલ રકમ</th>
                            <th>બાકી રકમ</th>
                            <th>કુલ રકમ</th>
                            <th>ક્રિયાઓ</th>
                        </tr>
                    </thead>

                    <tbody class="table-border-bottom-0">

                        @forelse ($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->invoice_date }}</td>
                                <td>{{ $purchase->total_qty }}</td>
                                <td>₹{{ $purchase->paid_amount }}</td>
                                <td>₹{{ $purchase->balance_amount }}</td>
                                <td>₹{{ $purchase->total_amount }}</td>
                                <td>
                                    <a href="{{ route('purchase_detail', $purchase->id) }}"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class="bx bx-show"></i>
                                    </a>
                                    <a href="{{ route('purchase.pdf', $purchase->id) }}" target="_blank"
                                        class="btn btn-sm btn-outline-secondary" title="પ્રિન્ટ કરો">
                                        <i class="bx bx-printer"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center">
                                    આ સપ્લાયર માટે હજુ સુધી કોઈ ખરીદી નથી.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                    @if ($purchases->count())
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold">
                                    કુલ બાકી રકમ
                                </td>
                                <td class="fw-bold text-danger" id="footerBalanceDue">
                                    ₹{{ number_format($totalBalanceDue, 2) }}
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    @endif

                </table>
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
                        <input type="number" id="modal_previous_due" class="form-control" value="{{ $totalBalanceDue }}" readonly>
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
    <!-- jQuery & AJAX Script for Modal functionality -->
    <script>
        $(document).ready(function() {
            let currentBalanceDue = {{ $totalBalanceDue }};
            let supplierId = "{{ $supplier->id }}";

            // Open Modal
            $("#openDueModalBtn").on("click", function() {
                $("#modal_previous_due").val(currentBalanceDue.toFixed(2));
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

                // Modal બંધ કરો (પહેલાં)
                let modalEl = document.getElementById('duePaymentModal');
                let modalInstance = bootstrap.Modal.getInstance(modalEl);
                if (modalInstance) modalInstance.hide();
                $('.modal-backdrop').remove(); // Backdrop કાઢી નાખો
                $('body').removeClass('modal-open').css('overflow', '');

                GlassToast.confirm(
                    "ચૂકવણીની ખાતરી", "શું તમે બાકી રકમની ચૂકવણી સેવ કરવા માંગો છો?",
                    function() {
                        $.ajax({
                            url: "{{ route('supplier.pay-due') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                supplier_id: supplierId,
                                paid_amount: paidAmount
                            },
                            success: function(res) {
                                if (res.success) {
                                    // 1. વેલ્યુ અપડેટ કરો
                                    currentBalanceDue = parseFloat(res.remaining_due);
                                    $("#footerBalanceDue").text("₹" + currentBalanceDue.toFixed(2));

                                    // 2. સક્સેસ મેસેજ
                                    GlassToast.success("સફળ", res.message);

                                    // 3. જો બાકી રકમ 0 થઈ જાય તો બટન છુપાવો
                                    if (currentBalanceDue <= 0) {
                                        $("#openDueModalBtn").fadeOut();
                                    }

                                    // 4. પેજ રિલોડ કરવાને બદલે નાનો Delay આપીને 
                                    // યુઝરને ખબર ન પડે તેમ silent reload
                                    setTimeout(function() {
                                        window.location.reload(); 
                                    }, 500); 

                                } else {
                                    GlassToast.warning("ભૂલ", res.message);
                                }
                            },
                            error: function(xhr) {
                                GlassToast.warning("ભૂલ", "કંઈક ખોટું થયું, ફરી પ્રયાસ કરો.");
                            }
                        });
                    }
                );
            });
        });
    </script>
</div>