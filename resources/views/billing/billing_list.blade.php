@include('layout.sidebar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card border-0 shadow-sm">

                            <!-- Header -->
                            <div class="card-header bg-white py-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">

                                    <div>
                                        <h4 class="mb-1 fw-bold">
                                            <i class="bx bx-detail text-primary me-2"></i>
                                            બિલની યાદી
                                        </h4>
                                        <small class="text-muted">
                                            તમામ વેચાણ બિલનું સંચાલન કરો
                                        </small>
                                    </div>

                                    <button class="btn btn-primary">
                                        <i class="bx bx-plus-circle me-1"></i>
                                        નવું બિલ બનાવો
                                    </button>

                                </div>
                            </div>

                            <!-- Search & Filter -->
                            <div class="card-body border-bottom">

                                <div class="row g-3">

                                    <div class="col-lg-4">
                                        <div class="input-group">
                                            <span class="input-group-text bg-white">
                                                <i class="bx bx-search"></i>
                                            </span>
                                            <input type="text" class="form-control"
                                                placeholder="બિલ નંબર / ગ્રાહક શોધો...">
                                        </div>
                                    </div>

                                    <div class="col-lg-2">
                                        <input type="date" class="form-control">
                                    </div>

                                    <div class="col-lg-2">
                                        <select class="form-select">
                                            <option>ચુકવણી પ્રકાર</option>
                                            <option>રોકડ</option>
                                            <option>બાકી</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2">
                                        <select class="form-select">
                                            <option>બધી સ્થિતિ</option>
                                            <option>ચૂકવેલ</option>
                                            <option>આંશિક</option>
                                            <option>બાકી</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-1">
                                        <button class="btn btn-outline-primary w-100">
                                            <i class="bx bx-filter-alt"></i>
                                        </button>
                                    </div>

                                    <div class="col-lg-1">
                                        <button class="btn btn-outline-secondary w-100">
                                            <i class="bx bx-reset"></i>
                                        </button>
                                    </div>

                                </div>

                            </div>

                            <!-- Billing Table -->
                            <div class="table-responsive">

                                <table class="table table-hover align-middle mb-0">

                                    <thead class="table-light">

                                        <tr>

                                            <th>ક્રમાંક</th>
                                            <th>બિલ નંબર</th>
                                            <th>તારીખ</th>
                                            <th>ગ્રાહક</th>
                                            <th>મોબાઇલ નંબર</th>
                                            <th>કુલ વસ્તુઓ</th>
                                            <th>કુલ રકમ</th>
                                            <th>ચુકવણી</th>
                                            <th>સ્થિતિ</th>
                                            <th class="text-center">ક્રિયા</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <td>1</td>

                                            <td>
                                                <span class="fw-bold text-primary">
                                                    BILL-1001
                                                </span>
                                            </td>

                                            <td>20-07-2026</td>

                                            <td>

                                                <div class="d-flex align-items-center">

                                                    <img src="https://ui-avatars.com/api/?name=Rahul+Patel"
                                                        class="rounded-circle me-2" width="40" height="40">

                                                    <div>

                                                        <h6 class="mb-0">
                                                            રાહુલ પટેલ
                                                        </h6>

                                                        <small class="text-muted">
                                                            CUS001
                                                        </small>

                                                    </div>

                                                </div>

                                            </td>

                                            <td>9876543210</td>

                                            <td>
                                                <span class="badge bg-primary">
                                                    8
                                                </span>
                                            </td>

                                            <td class="fw-bold text-success">
                                                ₹2,450
                                            </td>

                                            <td>
                                                <span class="badge bg-success">
                                                    રોકડ
                                                </span>
                                            </td>

                                            <td>
                                                <span class="badge bg-success">
                                                    ચૂકવેલ
                                                </span>
                                            </td>

                                            <td class="text-center">

                                                <button class="btn btn-sm btn-outline-info">
                                                    <i class="bx bx-show"></i>
                                                </button>

                                                <button class="btn btn-sm btn-outline-secondary">
                                                    <i class="bx bx-printer"></i>
                                                </button>

                                                <button class="btn btn-sm btn-outline-warning">
                                                    <i class="bx bx-edit"></i>
                                                </button>

                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bx bx-trash"></i>
                                                </button>

                                            </td>

                                        </tr>

                                        <tr>

                                            <td>2</td>

                                            <td>
                                                <span class="fw-bold text-primary">
                                                    BILL-1002
                                                </span>
                                            </td>

                                            <td>19-07-2026</td>

                                            <td>

                                                <div class="d-flex align-items-center">

                                                    <img src="https://ui-avatars.com/api/?name=Amit+Shah"
                                                        class="rounded-circle me-2" width="40" height="40">

                                                    <div>

                                                        <h6 class="mb-0">
                                                            અમિત શાહ
                                                        </h6>

                                                        <small class="text-muted">
                                                            CUS002
                                                        </small>

                                                    </div>

                                                </div>

                                            </td>

                                            <td>9876501234</td>

                                            <td>
                                                <span class="badge bg-primary">
                                                    12
                                                </span>
                                            </td>

                                            <td class="fw-bold text-success">
                                                ₹5,780
                                            </td>

                                            <td>
                                                <span class="badge bg-warning text-dark">
                                                    બાકી
                                                </span>
                                            </td>

                                            <td>
                                                <span class="badge bg-danger">
                                                    બાકી
                                                </span>
                                            </td>

                                            <td class="text-center">

                                                <button class="btn btn-sm btn-outline-info">
                                                    <i class="bx bx-show"></i>
                                                </button>

                                                <button class="btn btn-sm btn-outline-secondary">
                                                    <i class="bx bx-printer"></i>
                                                </button>

                                                <button class="btn btn-sm btn-outline-warning">
                                                    <i class="bx bx-edit"></i>
                                                </button>

                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bx bx-trash"></i>
                                                </button>

                                            </td>

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                            @include('layout.footer')
