@include('layout.sidebar')


                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">
                            <div class="justify-content-between d-flex p-1">
                                <div>
                                    <h5 class="card-header">ખરીદીની યાદી</h5>
                                </div>
                                <div class="text-center justify-content-center">
                                    <a href="{{ route('add_product') }}" class="btn btn-outline-primary mt-3">
                                        નવી ખરીદી ઉમેરો
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>

                                            <th>તારીખ</th>
                                            <th>સપ્લાયરનું નામ</th>
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
                                                <td>{{ $purchase->created_at->format('d-m-Y') }}</td>
                                                <td>{{ $purchase->supplier->name ?? '-' }}</td>
                                                <td>{{ $purchase->total_qty }}</td>
                                                <td>₹{{ $purchase->paid_amount }}</td>
                                                <td>₹{{ $purchase->balance_amount }}</td>
                                                <td>₹{{ $purchase->total_amount }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                            data-bs-toggle="dropdown">
                                                            <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                        </button>

                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('purchase_detail', $purchase->id) }}">
                                                                <i class="icon-base bx bx-edit-alt me-1"></i>
                                                                સંપાદિત કરો
                                                            </a>

                                                            <a class="dropdown-item delete-purchase-btn" href="javascript:void(0);" data-id="{{ $purchase->id }}">
                                                                <i class="icon-base bx bx-trash me-1"></i>
                                                                કાઢી નાખો
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                        @empty

                                            <tr>
                                                <td colspan="7" class="text-center">
                                                    હજુ સુધી કોઈ ખરીદી ઉમેરાઈ નથી.
                                                </td>
                                            </tr>

                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

{{-- DELETE PURCHASE --}}
<script>
    document.addEventListener('click', function (e) {

        const btn = e.target.closest('.delete-purchase-btn');

        if (!btn) {
            return;
        }

        GlassToast.confirm(
            'ખરીદી કાઢી નાખો',
            'શું તમે ખરેખર આ ખરીદી કાઢી નાખવા માંગો છો?',
            async function () {

                const purchaseId = btn.dataset.id;

                try {

                    const response = await fetch(`/purchases/${purchaseId}`, {

                        method: 'DELETE',

                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },

                    });

                    const data = await response.json();

                    if (response.ok && data.status === true) {

                        GlassToast.success('સફળતા', data.message);

                        btn.closest('tr').remove();

                    } else {

                        GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

                    }

                } catch (error) {

                    console.error('Delete Purchase Error:', error);

                    GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

                }

            }
        );

    });
</script>

                    @include('layout.footer')
