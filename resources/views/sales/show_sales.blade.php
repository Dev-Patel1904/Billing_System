@include('layout.sidebar')


                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card">

                            <div class="justify-content-between d-flex p-1">
                                <div>
                                    <h5 class="card-header">Parmar Vijay</h5>
                                </div>

                                <div class="text-center mt-5">
                                    <small>12-07-2026</small>
                                </div>
                            </div>

                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ક્રમાંક</th>
                                            <th>પ્રોડક્ટનું નામ</th>
                                            <th>જથ્થો</th>
                                            <th>ભાવ</th>
                                            <th>કુલ રકમ</th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>1</td>
                                            <td>Milk</td>
                                            <td>1</td>
                                            <td>₹10</td>
                                            <td>₹10</td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td>Colgate</td>
                                            <td>1</td>
                                            <td>₹10</td>
                                            <td>₹10</td>
                                        </tr>
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
                                                <td class="text-end">2</td>
                                            </tr>

                                            <tr>
                                                <td class="fw-semibold">કુલ જથ્થો</td>
                                                <td class="text-end">2</td>
                                            </tr>

                                            <tr>
                                                <td class="fw-semibold">પેટા કુલ</td>
                                                <td class="text-end">₹20</td>
                                            </tr>



                                            <tr class="border-top">
                                                <td class="fw-bold fs-5">ચૂકવવાની કુલ રકમ</td>
                                                <td class="text-end fw-bold fs-5 text-primary">
                                                    ₹20
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

