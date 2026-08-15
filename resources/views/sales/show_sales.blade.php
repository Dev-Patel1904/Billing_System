@include('layout.sidebar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">

                            <div class="justify-content-between d-flex p-1">
                                <div>
                                    <h5 class="card-header">{{ $bill->customer->name ?? '-' }}</h5>
                                </div>

                                <div class="text-center mt-5">
                                    <div>{{ $bill->created_at->format('d-m-Y') }}</div>
                                </div>
                            </div>

                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ક્રમાંક</th>
                                            <th>પ્રોડક્ટનું નામ</th>
                                            <th>જથ્થો (Qty)</th>
                                            <th>ભાવ</th>
                                            <th>કુલ રકમ</th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-border-bottom-0">

                                        @foreach ($bill->items as $index => $item)

                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->qty }} {{ $item->prakar }}</td>
                                            <td>₹{{ $item->rate }}</td>
                                            <td>₹{{ $item->amount }}</td>
                                        </tr>

                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <!-- Total Summary -->
                            <div class="card-body border-top">
                                <div class="row justify-content-end">

                                    <div class="col-lg-4 col-md-5">

                                        <table class="table table-borderless mb-0">

                                            <tr>
                                                <td class="fw-semibold">કુલ પ્રોડક્ટ</td>
                                                <td class="text-end">{{ $bill->items->count() }}</td>
                                            </tr>

                                            <tr>
                                                <td class="fw-semibold">કુલ જથ્થો</td>
                                                <td class="text-end">{{ $bill->total_qty }}</td>
                                            </tr>

                                            <tr>
                                                <td class="fw-semibold">પેટા કુલ</td>
                                                <td class="text-end">₹{{ $bill->total_amount }}</td>
                                            </tr>

                                            @if($bill->due_paid_now > 0)
                                            <tr>
                                                <td class="fw-semibold text-success">બાકી ચૂકવણી</td>
                                                <td class="text-end text-success">₹{{ $bill->due_paid_now }}</td>
                                            </tr>
                                            @endif

                                            <tr class="border-top">
                                                <td class="fw-bold fs-5">ચૂકવવાની કુલ રકમ</td>
                                                <td class="text-end fw-bold fs-5 text-primary">
                                                    ₹{{ $bill->grand_total }}
                                                </td>
                                            </tr>

                                        </table>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- / Content -->

                    @include('layout.footer')
