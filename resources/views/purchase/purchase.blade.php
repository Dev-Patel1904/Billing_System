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

            <!-- Search Filter -->
            <div class="card-body border-bottom">
                <form method="GET" action="{{ route('purchase') }}">
                    <div class="row g-3">

                        <div class="col-lg-4">
                            <div class="input-group">
                                <span class="input-group-text bg-white">
                                    <i class="bx bx-search"></i>
                                </span>
                                <input type="text" name="search" id="supplierSearch" class="form-control"
                                    placeholder="સપ્લાયરનું નામ શોધો..." value="{{ $search }}" autocomplete="off">
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bx bx-filter-alt"></i>
                                ફિલ્ટર
                            </button>
                        </div>

                        <div class="col-lg-2">
                            <a href="{{ route('purchase') }}" class="btn btn-outline-secondary w-100">
                                <i class="bx bx-reset"></i>
                                રીસેટ
                            </a>
                        </div>

                    </div>
                </form>
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
                                            <a class="dropdown-item"
                                                href="{{ route('purchase_detail', $purchase->id) }}">
                                                <i class="icon-base bx bx-edit-alt me-1"></i>
                                                સંપાદિત કરો
                                            </a>

                                            <a class="dropdown-item delete-purchase-btn" href="javascript:void(0);"
                                                data-id="{{ $purchase->id }}">
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
                                    @if ($search)
                                        "{{ $search }}" માટે કોઈ ખરીદી મળી નથી.
                                    @else
                                        હજુ સુધી કોઈ ખરીદી ઉમેરાઈ નથી.
                                    @endif
                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                    @if ($purchases->count())
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">
                                    કુલ બાકી રકમ
                                </td>
                                <td class="fw-bold text-danger">
                                    ₹{{ number_format($purchases->sum('balance_amount'), 2) }}
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                    @endif

                </table>
            </div>

            <!-- Pagination -->
            @if ($purchases->hasPages())
                <div class="card-footer bg-white">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">

                        <small class="text-muted">
                            {{ $purchases->total() }} ખરીદીમાંથી {{ $purchases->firstItem() }} થી {{ $purchases->lastItem() }} દર્શાવવામાં આવ્યા છે
                        </small>

                        <nav>
                            <ul class="pagination pagination-sm mb-0">

                                <li class="page-item {{ $purchases->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $purchases->onFirstPage() ? '#' : $purchases->previousPageUrl() }}">પાછળ</a>
                                </li>

                                @php
                                    $current = $purchases->currentPage();
                                    $last = $purchases->lastPage();
                                    $window = 1;
                                @endphp

                                <li class="page-item {{ $current == 1 ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $purchases->url(1) }}">1</a>
                                </li>

                                @if ($current - $window > 2)
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">...</a>
                                    </li>
                                @endif

                                @for ($page = max(2, $current - $window); $page <= min($last - 1, $current + $window); $page++)
                                    <li class="page-item {{ $current == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $purchases->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endfor

                                @if ($current + $window < $last - 1)
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#">...</a>
                                    </li>
                                @endif

                                @if ($last > 1)
                                    <li class="page-item {{ $current == $last ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $purchases->url($last) }}">{{ $last }}</a>
                                    </li>
                                @endif

                                <li class="page-item {{ !$purchases->hasMorePages() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $purchases->hasMorePages() ? $purchases->nextPageUrl() : '#' }}">આગળ</a>
                                </li>

                            </ul>
                        </nav>

                    </div>
                </div>
            @endif

        </div>
    </div>
    <!-- / Content -->

    {{-- SEARCH FIELD: ENGLISH -> GUJARATI TRANSLITERATION (on Enter) --}}
    <script>
        (function() {

            const el = document.getElementById('supplierSearch');

            if (!el) {
                return;
            }

            el.addEventListener('keydown', function(e) {

                if (e.key !== 'Enter') {
                    return;
                }

                const cursorPos = el.selectionStart;
                const textBeforeCursor = el.value.substring(0, cursorPos);
                const match = textBeforeCursor.match(/[a-zA-Z]+$/);

                if (!match) {
                    // No English word to translate -> let Enter submit the form normally
                    return;
                }

                const englishWord = match[0];
                const wordStart = cursorPos - englishWord.length;
                const textAfterCursor = el.value.substring(cursorPos);

                e.preventDefault();

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

                        const gujaratiWord = data[1][0][1][0];

                        el.value = el.value.substring(0, wordStart) + gujaratiWord + textAfterCursor;

                        const newCursorPos = wordStart + gujaratiWord.length;
                        el.setSelectionRange(newCursorPos, newCursorPos);

                    })
                    .catch(function(error) {
                        console.error('Gujarati Transliteration Error:', error);
                    });

            });

        })();
    </script>

    {{-- DELETE PURCHASE --}}
    <script>
        document.addEventListener('click', function(e) {

            const btn = e.target.closest('.delete-purchase-btn');

            if (!btn) {
                return;
            }

            GlassToast.confirm(
                'ખરીદી કાઢી નાખો',
                'શું તમે ખરેખર આ ખરીદી કાઢી નાખવા માંગો છો?',
                async function() {

                    const purchaseId = btn.dataset.id;

                    try {

                        const response = await fetch(`/purchases/${purchaseId}`, {

                            method: 'DELETE',

                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
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
