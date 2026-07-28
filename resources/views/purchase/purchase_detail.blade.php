@include('layout.sidebar')


                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card border-0 shadow-lg rounded-4 mt-4">

                            <!-- Header -->
                            <div class="card-header bg-primary text-white rounded-top-4 py-3">
                                <div
                                    class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3"
                                            style="width:55px;height:55px;">
                                            <i class="bx bx-package fs-2"></i>
                                        </div>

                                        <div>
                                            <h4 class="mb-0 fw-bold">ખરીદીની વિગતો</h4>
                                            <small class="text-white-50">
                                                સપ્લાયરની ખરીદેલી વસ્તુઓ
                                            </small>
                                        </div>
                                    </div>

                                    <div class="text-lg-end">
                                        <span class="badge bg-warning text-dark px-3 py-2 fs-6">
                                            બિલ નં. #1001
                                        </span>

                                        <div class="mt-2">
                                            <span class="badge bg-success">
                                                <i class="bx bx-check-circle me-1"></i>
                                                ખરીદી
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body">

                                <!-- Supplier Information -->
                                <div class="row g-3 mb-5 mt-5">

                                    <div class="col-12 col-md-4">
                                        <div class="card border shadow-sm h-100">
                                            <div class="card-body">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="bx bx-user text-primary"></i>
                                                    સપ્લાયરનું નામ
                                                </small>

                                                <h6 class="fw-bold mb-0">
                                                    Vijay
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="card border shadow-sm h-100">
                                            <div class="card-body">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="bx bx-calendar text-success"></i>
                                                    તારીખ
                                                </small>

                                                <h6 class="fw-bold mb-0">
                                                    17-07-2026
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-4">
                                        <div class="card border shadow-sm h-100">
                                            <div class="card-body">
                                                <small class="text-muted d-block mb-1">
                                                    <i class="bx bx-phone text-info"></i>
                                                    મોબાઇલ નંબર
                                                </small>

                                                <h6 class="fw-bold mb-0">
                                                    9876543210
                                                </h6>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Summary -->
                                <div class="row g-3 mb-4">

                                    <div class="col-6 col-lg-3">
                                        <div class="card border-0 bg-label-primary shadow-sm h-100">
                                            <div class="card-body text-center">
                                                <i class="bx bx-package text-primary fs-1"></i>

                                                <h3 class="fw-bold text-primary mt-2 mb-0">
                                                    25
                                                </h3>

                                                <small class="text-muted">
                                                    કુલ જથ્થો
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-lg-3">
                                        <div class="card border-0 bg-label-success shadow-sm h-100">
                                            <div class="card-body text-center">
                                                <i class="bx bx-wallet text-success fs-1"></i>

                                                <h3 class="fw-bold text-success mt-2 mb-0">
                                                    ₹1,250
                                                </h3>

                                                <small class="text-muted">
                                                    કુલ રકમ
                                                </small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-3">
                                        <div class="card border-0 bg-label-info shadow-sm h-100">
                                            <div class="card-body">

                                                <label class="form-label fw-semibold">
                                                    <i class="bx bx-money text-info me-1"></i>
                                                    ચૂકવેલ રકમ
                                                </label>

                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">₹</span>

                                                    <input type="number" class="form-control" id="edit_paid_amount"
                                                        value="1000">
                                                </div>

                                                <button class="btn btn-info w-100">
                                                    <i class="bx bx-save me-1"></i>
                                                    ચુકવણી અપડેટ કરો
                                                </button>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-lg-3">
                                        <div class="card border-0 bg-label-danger shadow-sm h-100">
                                            <div class="card-body">

                                                <div class="d-flex justify-content-between align-items-center">

                                                    <div>
                                                        <small class="text-muted">
                                                            બાકી રકમ
                                                        </small>

                                                        <h2 class="fw-bold text-danger mb-0">
                                                            ₹250
                                                        </h2>
                                                    </div>

                                                    <i class="bx bx-time-five text-danger fs-1"></i>

                                                </div>

                                                <hr>

                                                <div class="d-flex justify-content-between">
                                                    <small class="text-muted">
                                                        કુલ રકમ
                                                    </small>

                                                    <strong>
                                                        ₹1,250
                                                    </strong>
                                                </div>

                                                <div class="d-flex justify-content-between mt-2">
                                                    <small class="text-muted">
                                                        ચૂકવેલ
                                                    </small>

                                                    <strong class="text-success">
                                                        ₹1,000
                                                    </strong>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <!-- Product Table -->
                                <div class="card border shadow-sm">

                                    <div class="card-header bg-light">
                                        <div class="d-flex justify-content-between align-items-center">

                                            <h5 class="mb-0">
                                                <i class="bx bx-list-ul text-primary me-2"></i>
                                                ખરીદેલ પ્રોડક્ટ
                                            </h5>

                                            <span class="badge bg-primary">
                                                કુલ 3 પ્રોડક્ટ
                                            </span>

                                        </div>
                                    </div>

                                    <div class="table-responsive">

                                        <table class="table table-hover align-middle mb-0">

                                            <thead class="table-primary">

                                                <tr>
                                                    <th width="70">ક્રમાંક</th>
                                                    <th>પ્રોડક્ટનું નામ</th>
                                                    <th class="text-center">જથ્થો</th>
                                                    <th class="text-end">ભાવ</th>
                                                    <th class="text-end">કુલ</th>
                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <strong>Milk</strong>
                                                    </td>
                                                    <td class="text-center">5</td>
                                                    <td class="text-end">₹20</td>
                                                    <td class="text-end fw-bold">₹100</td>
                                                </tr>

                                                <tr>
                                                    <td>2</td>
                                                    <td>
                                                        <strong>Sugar</strong>
                                                    </td>
                                                    <td class="text-center">4</td>
                                                    <td class="text-end">₹50</td>
                                                    <td class="text-end fw-bold">₹200</td>
                                                </tr>

                                                <tr>
                                                    <td>3</td>
                                                    <td>
                                                        <strong>Tea</strong>
                                                    </td>
                                                    <td class="text-center">2</td>
                                                    <td class="text-end">₹150</td>
                                                    <td class="text-end fw-bold">₹300</td>
                                                </tr>

                                            </tbody>

                                            <tfoot class="table-light">

                                                <tr class="fw-bold">
                                                    <td colspan="2" class="text-end">
                                                        કુલ
                                                    </td>

                                                    <td class="text-center">
                                                        11
                                                    </td>

                                                    <td></td>

                                                    <td class="text-end text-success">
                                                        ₹600
                                                    </td>
                                                </tr>

                                            </tfoot>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- / Content -->

                    @include('layout.footer')

