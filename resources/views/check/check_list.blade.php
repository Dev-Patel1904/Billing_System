@include('layout.sidebar')



<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card border-0 shadow-sm">


<div class="card">

    {{-- હેડર --}}
    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            ચેકની યાદી
        </h5>

    </div>


    {{-- ફિલ્ટર --}}

    <div class="card-body border-bottom">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h6 class="mb-0 fw-semibold">
                ચેક શોધો
            </h6>

        </div>

        <form method="GET" action="{{ route('checks.index') }}">

            <div class="row g-3 align-items-end">

                {{-- તારીખ --}}
                <div class="col-md-3">

                    <label class="form-label">
                        ચેકની તારીખ
                    </label>

                    <input type="date"
                           class="form-control"
                           name="date"
                           value="{{ $date }}">

                </div>


                {{-- ચેક નંબર / ઇન્વૉઇસ નંબર --}}
                <div class="col-md-3">

                    <label class="form-label">
                        ચેક નંબર / ઇન્વૉઇસ નંબર
                    </label>

                    <input type="text"
                           class="form-control"
                           name="check_number"
                           placeholder="ચેક નંબર / ઇન્વૉઇસ નંબર દાખલ કરો"
                           value="{{ $checkNumber }}">

                </div>


                {{-- સપ્લાયર --}}
                <div class="col-md-3">

                    <label class="form-label">
                        સપ્લાયરનું નામ
                    </label>

                    <select class="form-select"
                            name="supplier_id">

                        <option value="">
                            બધા સપ્લાયર
                        </option>

                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" @selected($supplierId == $supplier->id)>
                                {{ $supplier->name }}
                            </option>
                        @endforeach

                    </select>

                </div>


                {{-- બટનો --}}
                <div class="col-md-3">

                    <div class="d-flex gap-2">

                        {{-- શોધો --}}
                        <button type="submit"
                                class="btn btn-primary">

                            <i class="bx bx-search"></i>
                            શોધો

                        </button>


                        {{-- સાફ કરો --}}
                        <a href="{{ route('checks.index') }}"
                           class="btn btn-outline-secondary">

                            <i class="bx bx-reset"></i>
                            સાફ કરો

                        </a>

                    </div>

                </div>

            </div>

        </form>

    </div>


    {{-- ટેબલ --}}
    <div class="table-responsive text-nowrap">

        <table class="table table-hover align-middle">

            <thead class="table-light">

                <tr>

                    <th>ક્રમ</th>

                    <th>ચેક નંબર</th>

                    <th>ચેકની રકમ</th>

                    <th>ચેકની તારીખ</th>

                    <th>સપ્લાયરનું નામ</th>

                    <th>ઇન્વૉઇસ નંબર</th>

                    {{-- <th>સ્થિતિ</th> --}}

                    <th class="text-center">
                        કાર્યવાહી
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse ($checks as $index => $check)

                @php
                    // Is the check's date today or already past? If so, the check
                    // is "due" and BOTH ચેક પાસ and ચેક બાઉન્સ become available
                    // (and blink continuously). Before that date, only રદ કરો works.
                    $checkDateObj = $check->check_date ? \Carbon\Carbon::parse($check->check_date)->startOfDay() : null;
                    $isCheckDue   = $checkDateObj ? $checkDateObj->lte(\Carbon\Carbon::today()) : false;
                @endphp

                <tr id="checkRow{{ $check->id }}">

                    <td>
                        {{ $checks->firstItem() + $index }}
                    </td>

                    <td>
                        <span class="fw-semibold">
                            {{ $check->check_number }}
                        </span>
                    </td>

                    <td>
                        ₹{{ number_format($check->amount, 2) }}
                    </td>

                    <td>
                        {{ $checkDateObj ? $checkDateObj->format('d-m-Y') : '-' }}
                    </td>

                    <td>
                        {{ $check->purchase->supplier->name ?? '-' }}
                    </td>

                    <td>
                        {{ $check->purchase->billing_no ?? '-' }}
                    </td>

                    {{-- <td id="checkStatus{{ $check->id }}">

                        @if ($check->status === 'passed')
                            <span class="badge bg-success blink-badge">ચેક પાસ</span>
                        @elseif ($check->status === 'bounced')
                            <span class="badge bg-danger blink-badge">ચેક બાઉન્સ</span>
                        @elseif ($check->status === 'cancelled')
                            <span class="badge bg-secondary">રદ થયેલ</span>
                        @else
                            <span class="badge bg-warning">બાકી</span>
                        @endif

                    </td> --}}

                    <td class="text-center" id="checkActions{{ $check->id }}">

                        @if ($check->status === 'pending')

                            <div class="d-flex justify-content-center gap-1 check-action-buttons {{ $isCheckDue ? 'blink-buttons-infinite' : '' }}">

                                @if ($isCheckDue)

                                    {{-- Check date has arrived: all 3 buttons active + blinking forever --}}

                                    {{-- ચેક બાઉન્સ --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger check-status-btn"
                                            data-id="{{ $check->id }}"
                                            data-status="bounced"
                                            data-label="ચેક બાઉન્સ"
                                            title="ચેક બાઉન્સ">

                                        <i class="bx bx-x-circle"></i>
                                        ચેક બાઉન્સ

                                    </button>

                                    {{-- ચેક પાસ --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-success check-status-btn"
                                            data-id="{{ $check->id }}"
                                            data-status="passed"
                                            data-label="ચેક પાસ"
                                            title="ચેક પાસ">

                                        <i class="bx bx-check-circle"></i>
                                        ચેક પાસ

                                    </button>

                                    {{-- રદ કરો --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary check-status-btn"
                                            data-id="{{ $check->id }}"
                                            data-status="cancelled"
                                            data-label="ચેક રદ કરો"
                                            title="ચેક રદ કરો">

                                        <i class="bx bx-block"></i>
                                        રદ કરો

                                    </button>

                                @else

                                    {{-- Check date is still in the future:
                                         ચેક બાઉન્સ and ચેક પાસ are disabled — only રદ કરો works --}}

                                    <button type="button"
                                            class="btn btn-sm btn-outline-danger"
                                            disabled
                                            title="ચેકની તારીખ {{ $checkDateObj->format('d-m-Y') }} સુધી રાહ જુઓ">
                                        <i class="bx bx-x-circle"></i>
                                        ચેક બાઉન્સ
                                    </button>

                                    <button type="button"
                                            class="btn btn-sm btn-outline-success"
                                            disabled
                                            title="ચેકની તારીખ {{ $checkDateObj->format('d-m-Y') }} સુધી રાહ જુઓ">
                                        <i class="bx bx-check-circle"></i>
                                        ચેક પાસ
                                    </button>

                                    {{-- રદ કરો — always active, no date restriction --}}
                                    <button type="button"
                                            class="btn btn-sm btn-outline-secondary check-status-btn"
                                            data-id="{{ $check->id }}"
                                            data-status="cancelled"
                                            data-label="ચેક રદ કરો"
                                            title="ચેક રદ કરો">

                                        <i class="bx bx-block"></i>
                                        રદ કરો

                                    </button>

                                @endif

                            </div>

                            @if (!$isCheckDue)
                                <small class="d-block text-muted mt-1">
                                    <i class="bx bx-time"></i>
                                    {{ $checkDateObj->format('d-m-Y') }} સુધી ફક્ત "રદ કરો" જ શક્ય છે.
                                </small>
                            @endif

                        @else

                            {{-- Status button after action --}}
                            <div class="d-flex justify-content-center gap-1 check-action-buttons">

                                @if ($check->status === 'passed')

                                    <span class="btn btn-sm btn-success w-100 ">
                                        <i class="bx bx-check-circle"></i>
                                        ચેક પાસ
                                    </span>

                                @elseif ($check->status === 'bounced')

                                    <span class="btn btn-sm btn-danger w-100  ">
                                        <i class="bx bx-x-circle"></i>
                                        ચેક બાઉન્સ
                                    </span>

                                @elseif ($check->status === 'cancelled')

                                    <span class="btn btn-sm btn-secondary w-100  ">
                                        <i class="bx bx-block"></i>
                                        રદ થયેલ
                                    </span>

                                @endif

                            </div>

                        @endif

                    </td>
                </tr>

                @empty

                <tr>
                    <td colspan="8" class="text-center">
                        કોઈ ચેક મળ્યો નથી.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    @if ($checks->hasPages())
        <div class="card-footer bg-white">
            <div class="d-flex flex-wrap justify-content-between align-items-center">

                <small class="text-muted">
                    {{ $checks->total() }} ચેકમાંથી {{ $checks->firstItem() }} થી {{ $checks->lastItem() }} દર્શાવવામાં આવ્યા છે
                </small>

                <nav>
                    <ul class="pagination pagination-sm mb-0">

                        <li class="page-item {{ $checks->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $checks->onFirstPage() ? '#' : $checks->previousPageUrl() }}">પાછળ</a>
                        </li>

                        @php
                            $current = $checks->currentPage();
                            $last = $checks->lastPage();
                            $window = 1;
                        @endphp

                        <li class="page-item {{ $current == 1 ? 'active' : '' }}">
                            <a class="page-link" href="{{ $checks->url(1) }}">1</a>
                        </li>

                        @if ($current - $window > 2)
                            <li class="page-item disabled">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif

                        @for ($page = max(2, $current - $window); $page <= min($last - 1, $current + $window); $page++)
                            <li class="page-item {{ $current == $page ? 'active' : '' }}">
                                <a class="page-link" href="{{ $checks->url($page) }}">{{ $page }}</a>
                            </li>
                        @endfor

                        @if ($current + $window < $last - 1)
                            <li class="page-item disabled">
                                <a class="page-link" href="#">...</a>
                            </li>
                        @endif

                        @if ($last > 1)
                            <li class="page-item {{ $current == $last ? 'active' : '' }}">
                                <a class="page-link" href="{{ $checks->url($last) }}">{{ $last }}</a>
                            </li>
                        @endif

                        <li class="page-item {{ !$checks->hasMorePages() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $checks->hasMorePages() ? $checks->nextPageUrl() : '#' }}">આગળ</a>
                        </li>

                    </ul>
                </nav>

            </div>
        </div>
    @endif

</div>
</div>
    </div>
</div>

<style>
    @keyframes blinkStatus {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.35; }
    }

    .blink-badge {
        animation: blinkStatus 1s ease-in-out 3;
    }

    /* Blink ALL 3 buttons CONTINUOUSLY (infinite) once check_date has arrived */
    @keyframes blinkButtonsInfinite {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.55; transform: scale(1.05); }
    }

    .blink-buttons-infinite .btn:not(:disabled) {
        animation: blinkButtonsInfinite 1.2s ease-in-out infinite;
    }
</style>

{{-- CHECK STATUS ACTIONS: pass / bounce / cancel --}}
<script>
    document.addEventListener('click', function(e) {

        const btn = e.target.closest('.check-status-btn');

        if (!btn) {
            return;
        }

        // Extra safety: ignore clicks on disabled buttons (shouldn't fire anyway)
        if (btn.disabled) {
            return;
        }

        const paymentId = btn.dataset.id;
        const newStatus = btn.dataset.status;
        const label = btn.dataset.label;

        GlassToast.confirm(
            label,
            `શું તમે ખરેખર "${label}" કરવા માંગો છો?`,
            async function() {

                try {

                    const response = await fetch(`/checks/${paymentId}/status`, {

                        method: 'POST',

                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json',
                        },

                        body: JSON.stringify({ status: newStatus }),

                    });

                    const data = await response.json();

                    if (response.ok && data.status === true) {

                        GlassToast.success('સફળ', data.message);

                        // Replace the actions cell with the final status pill
                        const actionsCell = document.getElementById(`checkActions${paymentId}`);
                        if (actionsCell) {

                            let badgeClass = 'btn-secondary';
                            let badgeText  = 'રદ થયેલ';
                            let icon       = 'bx-block';

                            if (data.new_status === 'passed') {
                                badgeClass = 'btn-success';
                                badgeText  = 'ચેક પાસ';
                                icon       = 'bx-check-circle';
                            } else if (data.new_status === 'bounced') {
                                badgeClass = 'btn-danger';
                                badgeText  = 'ચેક બાઉન્સ';
                                icon       = 'bx-x-circle';
                            }

                            actionsCell.innerHTML =
                                `<div class="d-flex justify-content-center gap-1 check-action-buttons">
                                    <span class="btn btn-sm ${badgeClass} w-100">
                                        <i class="bx ${icon}"></i>
                                        ${badgeText}
                                    </span>
                                 </div>`;
                        }

                    } else {

                        GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

                        // If server rejected a premature pass/bounce attempt, reload
                        // so the row correctly re-renders with the disabled buttons.
                        if (data.reason === 'check_date_not_due') {
                            setTimeout(function() {
                                window.location.reload();
                            }, 1200);
                        }

                    }

                } catch (error) {

                    console.error('Check Status Update Error:', error);
                    GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

                }

            }
        );

    });
</script>

@include('layout.footer')
