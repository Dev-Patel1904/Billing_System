@include('layout.sidebar')
                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">
                            <div class="justify-content-between d-flex p-1">
                                <div>
                                    <h5 class="card-header">Salse</h5>
                                </div>
                                <!-- <div class="text-center justify-content-center">
                                    <a href="add_new_product.html" class="btn btn-outline-primary mt-3">Add new</a>
                                </div> -->
                            </div>

                            <!-- Search & Filter -->
                            <div class="card-body border-bottom">

                                <form method="GET" action="{{ route('sales') }}">

                                    <div class="row g-3">

                                        <div class="col-lg-4">
                                            <div class="input-group">
                                                <span class="input-group-text bg-white">
                                                    <i class="bx bx-search"></i>
                                                </span>
                                                <input type="text" name="search" class="form-control" placeholder="બિલ નંબર / ગ્રાહકનું નામ શોધો..." value="{{ $search }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-2">
                                            <input type="date" name="date" class="form-control" value="{{ $date }}">
                                        </div>

                                        <div class="col-lg-2">
                                            <select name="payment_type" class="form-select">
                                                <option value="">ચુકવણી પ્રકાર</option>
                                                <option value="cash" @selected($paymentType === 'cash')>રોકડ</option>
                                                <option value="due" @selected($paymentType === 'due')>ઉધાર</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-outline-primary w-100">
                                                <i class="bx bx-filter-alt"></i>
                                                ફિલ્ટર
                                            </button>
                                        </div>

                                        <div class="col-lg-2">
                                            <a href="{{ route('sales') }}" class="btn btn-outline-secondary w-100">
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
                                            <th>ક્રમાંક</th>
                                            <th>તારીખ</th>
                                            <th>ગ્રાહકનું નામ</th>
                                            <th>કુલ જથ્થો (Qty)</th>
                                            <th>કુલ રકમ</th>
                                            <th>સ્થિતિ</th>
                                            <th>ક્રિયાઓ</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse ($bills as $index => $bill)
                                        <tr>
                                            <td>{{ $bills->firstItem() + $index }}</td>
                                            <td>{{ $bill->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $bill->customer->name ?? '-' }}</td>
                                            <td>{{ $bill->total_qty }}</td>
                                            <td>₹{{ $bill->grand_total }}</td>
                                            <td>
                                                @if($bill->payment_type === 'due')
                                                    ઉધાર
                                                @else
                                                    રોકડ
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('show_sales', $bill->id) }}">
                                                            <i class="icon-base bx bx-edit-alt me-1"></i> સંપાદિત કરો
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">
                                                હજુ સુધી કોઈ બિલ ઉમેરાયું નથી.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
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
                                                $window = 1; // how many pages to show on each side of current
                                            @endphp
                                            {{-- First page --}}
                                            <li class="page-item {{ $current == 1 ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $bills->url(1) }}">1</a>
                                            </li>
                                            {{-- Left ellipsis --}}
                                            @if ($current - $window > 2)
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#">...</a>
                                                </li>
                                            @endif
                                            {{-- Middle window --}}
                                            @for ($page = max(2, $current - $window); $page <= min($last - 1, $current + $window); $page++)
                                                <li class="page-item {{ $current == $page ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $bills->url($page) }}">{{ $page }}</a>
                                                </li>
                                            @endfor
                                            {{-- Right ellipsis --}}
                                            @if ($current + $window < $last - 1)
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#">...</a>
                                                </li>
                                            @endif
                                            {{-- Last page --}}
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
                    <!-- / Content -->
                    @include('layout.footer')
