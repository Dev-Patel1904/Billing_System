@include('layout.sidebar')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <!-- Welcome Header -->
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mb-4">
            <div>
                <h3 class="fw-bold mb-1">
                    <i class="bx bx-home-circle text-primary me-2"></i>
                    ડેશબોર્ડ
                </h3>
                <p class="text-muted mb-0">
                    ફરીથી સ્વાગત છે 👋 આજના વ્યવસાયનો સંક્ષિપ્ત અહેવાલ અહીં દર્શાવવામાં આવ્યો છે.
                </p>
            </div>

            <div class="mt-3 mt-lg-0">
                <span class="badge bg-primary fs-6 px-3 py-2">
                    <i class="bx bx-calendar me-1"></i>
                    {{ now()->format('d F Y') }}
                </span>
            </div>
        </div>

        {{-- FILTER DATE --}}
        <!-- Date Filter -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('dashboard') }}" id="dashboardFilter">

                    <div class="row g-3 align-items-end">

                        <!-- From Date -->
                        <div class="col-md-4">

                            <label for="from_date" class="form-label fw-semibold">
                                શરૂઆતની તારીખ
                            </label>

                            <input type="date" name="from_date" id="from_date" class="form-control"
                                value="{{ $isFiltered ? $fromDate : '' }}" max="{{ now()->format('Y-m-d') }}">

                            <div class="invalid-feedback">
                                શરૂઆતની તારીખ પસંદ કરો.
                            </div>

                        </div>


                        <!-- To Date -->
                        <div class="col-md-4">

                            <label for="to_date" class="form-label fw-semibold">
                                અંતિમ તારીખ
                            </label>

                            <input type="date" name="to_date" id="to_date" class="form-control"
                                value="{{ $isFiltered ? $toDate : '' }}" max="{{ now()->format('Y-m-d') }}">

                            <div class="invalid-feedback">
                                અંતિમ તારીખ શરૂઆતની તારીખ કરતા નાની હોઈ શકે નહીં.
                            </div>

                        </div>


                        <!-- Filter Buttons -->
                        <div class="col-md-4">

                            <div class="d-flex gap-2">

                                <!-- Filter Button -->
                                <button type="submit" class="btn btn-primary flex-fill">
                                    <i class="bx bx-filter-alt me-1"></i>
                                    ફિલ્ટર કરો
                                </button>


                                <!-- Reset Button -->
                                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary flex-fill">
                                    <i class="bx bx-reset me-1"></i>
                                    રીસેટ
                                </a>

                            </div>

                        </div>

                    </div>

                </form>

            </div>
        </div>


        <div class="row g-4">

            <!-- Sales -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted">

                                    @if ($isFiltered)
                                        કુલ વેચાણ
                                    @else
                                        આજનું વેચાણ
                                    @endif

                                </small>

                                <h3 class="fw-bold mt-2 mb-1">
                                    ₹{{ number_format($todaysSales, 0) }}
                                </h3>

                            </div>

                            <div class="bg-primary bg-opacity-10 rounded-circle p-3">

                                <i class="bx bx-rupee text-primary fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Bills -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted">

                                    @if ($isFiltered)
                                        કુલ બિલ
                                    @else
                                        આજના બિલ
                                    @endif

                                </small>

                                <h3 class="fw-bold mt-2 mb-1">
                                    {{ $todaysBillCount }}
                                </h3>

                                <span class="badge bg-info">
                                    બનાવ્યા
                                </span>

                            </div>

                            <div class="bg-info bg-opacity-10 rounded-circle p-3">

                                <i class="bx bx-receipt text-info fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Due Amount -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted">
                                    બાકી લેણું
                                </small>

                                <h3 class="fw-bold mt-2 mb-1">
                                    ₹{{ number_format($totalDue, 0) }}
                                </h3>

                                <span class="badge bg-warning text-dark">
                                    બાકી
                                </span>

                            </div>

                            <div class="bg-warning bg-opacity-10 rounded-circle p-3">

                                <i class="bx bx-time-five text-warning fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- Customers -->
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <small class="text-muted">
                                    ગ્રાહકો
                                </small>

                                <h3 class="fw-bold mt-2 mb-1">
                                    {{ $totalCustomers }}
                                </h3>

                            </div>

                            <div class="bg-success bg-opacity-10 rounded-circle p-3">

                                <i class="bx bx-group text-success fs-2"></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="row mt-4">

            <!-- Monthly Sales Chart -->
            <div class="col-xl-8 col-lg-7 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white d-flex justify-content-between align-items-center">

                        <div>
                            <h5 class="mb-0 fw-bold">
                                <i class="bx bx-line-chart text-primary me-2"></i>
                                માસિક વેચાણ
                            </h5>

                            <small class="text-muted">
                                {{ $selectedYear }} વર્ષના વેચાણનો સંક્ષિપ્ત અહેવાલ
                            </small>
                        </div>

                        <select class="form-select w-auto" id="yearSelect">
                            @foreach ($availableYears as $yearOption)
                                <option value="{{ $yearOption }}" @selected($yearOption == $selectedYear)>{{ $yearOption }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="card-body">

                        <div id="monthlySalesChart"></div>

                    </div>

                </div>

            </div>

            <!-- Sales Summary -->
            <div class="col-xl-4 col-lg-5 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-header bg-white">
                        <h5 class="fw-bold mb-0">
                            <i class="bx bx-pie-chart-alt-2 text-success me-2"></i>
                            વેચાણનો સારાંશ
                        </h5>
                    </div>

                    <div class="card-body">

                        <div id="billTypeChart"></div>

                        <hr>

                        <div class="d-flex justify-content-between mb-3">
                            <span>રોકડ બિલ</span>
                            <strong class="text-success">₹{{ number_format($cashTotal, 0) }}</strong>
                        </div>

                        <div class="progress mb-3" style="height:8px;">
                            <div class="progress-bar bg-success" style="width:{{ $cashPercent }}%"></div>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>બાકી બિલ</span>
                            <strong class="text-warning">₹{{ number_format($dueTotal, 0) }}</strong>
                        </div>

                        <div class="progress mb-4" style="height:8px;">
                            <div class="progress-bar bg-warning" style="width:{{ $duePercent }}%"></div>
                        </div>

                        <div class="row text-center">

                            <div class="col-6 border-end">

                                <h4 class="fw-bold text-primary">
                                    ₹{{ number_format($todaysSales, 0) }}
                                </h4>

                                <small class="text-muted">
                                    આજનું વેચાણ
                                </small>

                            </div>

                            <div class="col-6">

                                <h4 class="fw-bold text-danger">
                                    ₹{{ number_format($totalDue, 0) }}
                                </h4>

                                <small class="text-muted">
                                    બાકી લેણું
                                </small>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="row mt-4">

            <div class="col-12">

                <div class="card shadow-sm border-0">

                    <!-- Card Header -->
                    <div class="card-header bg-white">

                        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center">

                            <div>
                                <h5 class="fw-bold mb-1">
                                    <i class="bx bx-receipt text-primary me-2"></i>
                                    તાજેતરના બિલ
                                </h5>

                                <small class="text-muted">
                                    તાજેતરમાં બનાવેલા બિલના રેકોર્ડ
                                </small>
                            </div>

                        </div>

                    </div>

                    <!-- Table -->
                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead class="table-light">

                                <tr>

                                    <th>બિલ નં.</th>

                                    <th>ગ્રાહક</th>

                                    <th>મોબાઇલ</th>

                                    <th>તારીખ</th>

                                    <th>ચુકવણી</th>

                                    <th>કુલ રકમ</th>

                                    <th>સ્થિતિ</th>

                                    <th class="text-center">
                                        ક્રિયા
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse ($recentBills as $bill)
                                    <tr>

                                        <td>
                                            <strong>#{{ str_pad($bill->bill_no ?? $bill->id, 4, '0', STR_PAD_LEFT) }}</strong>
                                        </td>

                                        <td>
                                            {{ $bill->customer->name ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $bill->customer->mobile ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $bill->created_at->format('d-m-Y') }}
                                        </td>

                                        <td>

                                            @if ($bill->payment_type === 'cash')
                                                <span class="badge bg-success">
                                                    રોકડ
                                                </span>
                                            @else
                                                <span class="badge bg-warning text-dark">
                                                    બાકી
                                                </span>
                                            @endif

                                        </td>

                                        <td>

                                            <strong>
                                                ₹{{ $bill->grand_total }}
                                            </strong>

                                        </td>

                                        <td>

                                            @if ($bill->payment_type === 'cash')
                                                <span class="badge bg-primary">
                                                    ચૂકવેલ
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    બાકી
                                                </span>
                                            @endif

                                        </td>

                                        <td class="text-center">

                                            <a href="{{ route('show_sales', $bill->id) }}"
                                                class="btn btn-sm btn-outline-primary me-1">
                                                <i class="bx bx-show"></i>
                                            </a>

                                            <a href="{{ route('billing.print', $bill->id) }}" target="_blank"
                                                class="btn btn-sm btn-outline-secondary">
                                                <i class="bx bx-printer"></i>
                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="8" class="text-center">
                                            હજુ સુધી કોઈ બિલ બનાવ્યું નથી.
                                        </td>
                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <!-- Footer -->

                    <div class="card-footer bg-white">

                        <div class="d-flex justify-content-between align-items-center">

                            <small class="text-muted">

                                કુલ {{ $totalBillsCount }} બિલમાંથી {{ $recentBills->count() }} બિલ દર્શાવવામાં આવ્યા
                                છે

                            </small>

                            <a href="{{ route('sales') }}" class="btn btn-primary">

                                <i class="bx bx-list-ul me-1"></i>

                                બધા બિલ જુઓ

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <div class="row mt-4">

            <!-- Pending Due Customers -->
            <div class="row mt-4">

                <!-- Pending Customers - Left -->
                <div class="col-xl-8 col-lg-7 mb-4">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-header bg-white d-flex justify-content-between align-items-center">

                            <div>
                                <h5 class="fw-bold mb-0">
                                    <i class="bx bx-time-five text-warning me-2"></i>
                                    બાકી લેણાવાળા ગ્રાહકો
                                </h5>

                                <small class="text-muted">
                                    જેમના પાસે બાકી રકમ છે તે ગ્રાહકો
                                </small>
                            </div>

                            <a href="{{ route('customer_list') }}" class="btn btn-sm btn-outline-warning">
                                બધા જુઓ
                            </a>

                        </div>

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th>ગ્રાહક</th>
                                        <th>મોબાઇલ</th>
                                        <th>બાકી રકમ</th>
                                        <th class="text-center">ક્રિયા</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @forelse ($pendingCustomers as $customer)
                                        <tr>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->mobile }}</td>
                                            <td>
                                                <span class="fw-bold text-danger">
                                                    ₹{{ number_format($customer->balance_due, 0) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('customer.bills', $customer->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="bx bx-show"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="4" class="text-center">
                                                હાલમાં કોઈ ગ્રાહકની બાકી રકમ નથી.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                    </div>

                </div>


                <!-- Quick Actions - Right -->
                <div class="col-xl-4 col-lg-5 mb-4">

                    <div class="card border-0 shadow-sm h-100">

                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">
                                <i class="bx bx-grid-alt text-primary me-2"></i>
                                ઝડપી ક્રિયાઓ
                            </h5>
                        </div>

                        <div class="card-body">

                            <div class="row g-3">

                                <div class="col-6">
                                    <a href="{{ route('billing.create') }}" class="btn btn-primary w-100 py-3">
                                        <i class="bx bx-receipt fs-3 d-block mb-2"></i>
                                        નવું બિલ
                                    </a>
                                </div>

                                <div class="col-6">
                                    <a href="{{ route('customer_list') }}" class="btn btn-success w-100 py-3">
                                        <i class="bx bx-user-plus fs-3 d-block mb-2"></i>
                                        ગ્રાહક
                                    </a>
                                </div>

                                <div class="col-6">
                                    <a href="{{ route('add_product') }}"
                                        class="btn btn-warning w-100 py-3 text-dark">
                                        <i class="bx bx-package fs-3 d-block mb-2"></i>
                                        પ્રોડક્ટ્સ
                                    </a>
                                </div>

                                <div class="col-6">
                                    <a href="{{ route('purchase') }}" class="btn btn-info w-100 py-3 text-white">
                                        <i class="bx bx-cart fs-3 d-block mb-2"></i>
                                        ખરીદી
                                    </a>
                                </div>

                                {{-- <div class="col-6">
                                <a href="#" class="btn btn-danger w-100 py-3">
                                    <i class="bx bx-wallet fs-3 d-block mb-2"></i>
                                    ખર્ચ
                                </a>
                            </div>

                            <div class="col-6">
                                <a href="#" class="btn btn-dark w-100 py-3">
                                    <i class="bx bx-bar-chart-alt-2 fs-3 d-block mb-2"></i>
                                    અહેવાલો
                                </a>
                            </div> --}}

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- / Content -->

        @include('layout.footer')

        {{-- YEAR SELECTOR --}}
        <script>
            document.getElementById('yearSelect').addEventListener('change', function() {
                window.location.href = "{{ route('dashboard') }}?year=" + this.value;
            });
        </script>

        {{-- DASHBOARD CHARTS (real data) — placed AFTER footer so apexcharts.js is already loaded --}}
        <script>
            window.addEventListener('load', function() {

                var monthlyOptions = {

                    series: [{
                        name: 'Sales',
                        data: @json($monthlyTotals)
                    }],

                    chart: {
                        type: 'area',
                        height: 350,
                        width: '100%',
                        toolbar: {
                            show: false
                        }
                    },

                    dataLabels: {
                        enabled: false
                    },

                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },

                    fill: {
                        type: 'gradient'
                    },

                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov',
                            'Dec'
                        ]
                    },

                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return "₹ " + val;
                            }
                        }
                    }

                };

                var monthlyEl = document.querySelector("#monthlySalesChart");

                if (monthlyEl) {
                    new ApexCharts(monthlyEl, monthlyOptions).render();
                }


                var pieOptions = {

                    series: [{{ $cashTotal }}, {{ $dueTotal }}],

                    chart: {
                        type: 'donut',
                        height: 300,
                        width: '100%'
                    },

                    labels: ['Cash', 'Due'],

                    legend: {
                        position: 'bottom'
                    },

                    colors: ['#28a745', '#ffc107'],

                    dataLabels: {
                        enabled: true
                    }

                };

                var pieEl = document.querySelector("#billTypeChart");

                if (pieEl) {
                    new ApexCharts(pieEl, pieOptions).render();
                }

            });
        </script>

        {{-- FILTER DATE --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const form = document.getElementById('dashboardFilter');

                const fromDate = document.getElementById('from_date');

                const toDate = document.getElementById('to_date');


                if (!form) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | From Date Change
                |--------------------------------------------------------------------------
                */

                fromDate.addEventListener('change', function() {

                    // To date cannot be before from date
                    toDate.min = fromDate.value;


                    // If existing To Date is smaller
                    if (
                        toDate.value &&
                        toDate.value < fromDate.value
                    ) {

                        toDate.value = fromDate.value;

                    }

                });


                /*
                |--------------------------------------------------------------------------
                | Form Submit Validation
                |--------------------------------------------------------------------------
                */

                form.addEventListener('submit', function(e) {

                    let isValid = true;


                    // Remove previous errors
                    fromDate.classList.remove('is-invalid');

                    toDate.classList.remove('is-invalid');


                    /*
                    |--------------------------------------------------------------------------
                    | From Date Required
                    |--------------------------------------------------------------------------
                    */

                    if (!fromDate.value) {

                        fromDate.classList.add('is-invalid');

                        isValid = false;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | To Date Required
                    |--------------------------------------------------------------------------
                    */

                    if (!toDate.value) {

                        toDate.classList.add('is-invalid');

                        isValid = false;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Date Range Validation
                    |--------------------------------------------------------------------------
                    */

                    if (
                        fromDate.value &&
                        toDate.value &&
                        toDate.value < fromDate.value
                    ) {

                        toDate.classList.add('is-invalid');

                        isValid = false;

                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Stop Form Submit
                    |--------------------------------------------------------------------------
                    */

                    if (!isValid) {

                        e.preventDefault();

                        return;

                    }

                });

            });
        </script>
