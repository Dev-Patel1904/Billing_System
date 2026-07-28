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
                                    <a href="add_new_product.html" class="btn btn-outline-primary mt-3">
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
                                        <tr>
                                            <td>09-07-2023</td>
                                            <td>Vijay</td>
                                            <td>2</td>
                                            <td>₹10</td>
                                            <td>₹10</td>
                                            <td>₹10</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="icon-base bx bx-dots-vertical-rounded"></i>
                                                    </button>

                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="purchase_details.html">
                                                            <i class="icon-base bx bx-edit-alt me-1"></i>
                                                            સંપાદિત કરો
                                                        </a>

                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            <i class="icon-base bx bx-trash me-1"></i>
                                                            કાઢી નાખો
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->

                    @include('layout.footer')
