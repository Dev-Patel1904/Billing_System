@include('layout.sidebar')


<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="justify-content-between d-flex align-items-center p-3">
                <div>
                    <h5 class="card-header p-0 mb-1">
                        {{ $supplier->name }} ની ખરીદીઓ
                    </h5>
                    <small class="text-muted">
                        {{ $supplier->mobile }} &bull; {{ $supplier->address }}
                    </small>
                </div>
                <div class="text-center justify-content-center">
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
                                    <a href="#" class="btn btn-sm btn-outline-secondary">
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
                </table>
            </div>
        </div>
    </div>
    <!-- / Content -->

    @include('layout.footer')
