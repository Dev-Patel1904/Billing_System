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
                                            <i class="bx bx-package text-primary me-2"></i>
                                            સપ્લાયરની યાદી
                                        </h4>
                                        <small class="text-muted">
                                            તમામ સપ્લાયરોનું સંચાલન કરો
                                        </small>
                                    </div>

                                    <button class="btn btn-primary">
                                        <i class="bx bx-plus-circle me-1"></i>
                                        નવો સપ્લાયર ઉમેરો
                                    </button>

                                </div>
                            </div>

                            <!-- Search -->
                            <div class="card-body border-bottom">

                                <div class="row g-3">

                                    <div class="col-lg-5">
                                        <div class="input-group">
                                            <span class="input-group-text bg-white">
                                                <i class="bx bx-search"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="સપ્લાયર શોધો...">
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <select class="form-select">
                                            <option>બધી સ્થિતિ</option>
                                            <option>સક્રિય</option>
                                            <option>નિષ્ક્રિય</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-2">
                                        <button class="btn btn-outline-primary w-100">
                                            <i class="bx bx-filter-alt"></i>
                                            ફિલ્ટર
                                        </button>
                                    </div>

                                    <div class="col-lg-2">
                                        <button class="btn btn-outline-secondary w-100">
                                            <i class="bx bx-reset"></i>
                                            રીસેટ
                                        </button>
                                    </div>

                                </div>

                            </div>

                            <!-- Table -->
                            <div class="table-responsive">

                                <table class="table table-hover align-middle mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>ક્રમાંક</th>
                                            <th>સપ્લાયર</th>
                                            <th>મોબાઇલ નંબર</th>
                                            <th>શહેર</th>
                                            <th>કુલ બિલ</th>
                                            <th>કુલ ખરીદી</th>
                                            <th>બાકી રકમ</th>
                                            <th>છેલ્લી ખરીદી</th>
                                            <th>સ્થિતિ</th>
                                            <th class="text-center">ક્રિયા</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                        <tr>

                                            <td>1</td>

                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <img src="https://ui-avatars.com/api/?name=Patel+Traders"
                                                        class="rounded-circle me-3" width="45" height="45">

                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">
                                                            પટેલ ટ્રેડર્સ
                                                        </h6>

                                                        <small class="text-muted">
                                                            Supplier ID : SUP001
                                                        </small>
                                                    </div>

                                                </div>
                                            </td>

                                            <td>9876543210</td>

                                            <td>નડિયાદ</td>

                                            <td>
                                                <span class="badge bg-primary">
                                                    42 બિલ
                                                </span>
                                            </td>

                                            <td class="fw-bold text-success">
                                                ₹1,85,400
                                            </td>

                                            <td class="fw-bold text-danger">
                                                ₹15,500
                                            </td>

                                            <td>
                                                20-07-2026
                                            </td>

                                            <td>
                                                <span class="badge bg-success">
                                                    સક્રિય
                                                </span>
                                            </td>

                                            <td class="text-center">

                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="bx bx-show"></i>
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
                                                <div class="d-flex align-items-center">

                                                    <img src="https://ui-avatars.com/api/?name=Shree+Enterprise"
                                                        class="rounded-circle me-3" width="45" height="45">

                                                    <div>
                                                        <h6 class="mb-0 fw-semibold">
                                                            શ્રી એન્ટરપ્રાઇઝ
                                                        </h6>

                                                        <small class="text-muted">
                                                            Supplier ID : SUP002
                                                        </small>
                                                    </div>

                                                </div>
                                            </td>

                                            <td>9876501234</td>

                                            <td>આણંદ</td>

                                            <td>
                                                <span class="badge bg-primary">
                                                    28 બિલ
                                                </span>
                                            </td>

                                            <td class="fw-bold text-success">
                                                ₹96,250
                                            </td>

                                            <td class="fw-bold text-danger">
                                                ₹0
                                            </td>

                                            <td>
                                                18-07-2026
                                            </td>

                                            <td>
                                                <span class="badge bg-success">
                                                    સક્રિય
                                                </span>
                                            </td>

                                            <td class="text-center">

                                                <button class="btn btn-sm btn-outline-primary">
                                                    <i class="bx bx-show"></i>
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

                            <!-- Footer -->
                            <div class="card-footer bg-white">

                                <div class="d-flex flex-wrap justify-content-between align-items-center">

                                    <small class="text-muted">
                                        45 સપ્લાયરોમાંથી 1 થી 10 દર્શાવવામાં આવ્યા છે
                                    </small>

                                    <nav>

                                        <ul class="pagination pagination-sm mb-0">

                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">પાછળ</a>
                                            </li>

                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>

                                            <li class="page-item">
                                                <a class="page-link" href="#">2</a>
                                            </li>

                                            <li class="page-item">
                                                <a class="page-link" href="#">3</a>
                                            </li>

                                            <li class="page-item">
                                                <a class="page-link" href="#">આગળ</a>
                                            </li>

                                        </ul>

                                    </nav>

                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- / Content -->

                    @include('layout.footer')

