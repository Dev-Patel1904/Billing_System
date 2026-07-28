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
                                            <i class="bx bx-group text-primary me-2"></i>
                                            ગ્રાહકોની યાદી
                                        </h4>
                                        <small class="text-muted">
                                            તમામ બિલિંગ ગ્રાહકોનું સંચાલન કરો
                                        </small>
                                    </div>

                                    <button class="btn btn-primary">
                                        <i class="bx bx-user-plus me-1"></i>
                                        નવો ગ્રાહક ઉમેરો
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
                                            <input type="text" class="form-control" placeholder="ગ્રાહક શોધો...">
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

                                            <th>#</th>

                                            <th>ગ્રાહક</th>

                                            <th>મોબાઇલ નંબર</th>

                                            <th>શહેર</th>

                                            <th>કુલ બિલ</th>

                                            <th>કુલ ખરીદી</th>

                                            <th>બાકી રકમ</th>

                                            <th>છેલ્લું બિલ</th>

                                            <th>સ્થિતિ</th>

                                            <th class="text-center">ક્રિયા</th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        <tr>

                                            <td>1</td>

                                            <td>

                                                <div class="d-flex align-items-center">

                                                    <img src="https://ui-avatars.com/api/?name=Rahul"
                                                        class="rounded-circle me-3" width="45">

                                                    <div>

                                                        <h6 class="mb-0 fw-semibold">
                                                            Rahul Patel
                                                        </h6>

                                                        <small class="text-muted">
                                                            ગ્રાહક ID : CUS001
                                                        </small>

                                                    </div>

                                                </div>

                                            </td>

                                            <td>
                                                +91 9876543210
                                            </td>

                                            <td>
                                                Nadiad
                                            </td>

                                            <td>

                                                <span class="badge bg-primary">
                                                    28 Bills
                                                </span>

                                            </td>

                                            <td class="fw-bold text-success">
                                                ₹58,200
                                            </td>

                                            <td class="fw-bold text-danger">
                                                ₹2,300
                                            </td>

                                            <td>
                                                20 Jul 2026
                                            </td>

                                            <td>

                                                <span class="badge bg-success">
                                                    Active
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

                                                    <img src="https://ui-avatars.com/api/?name=Amit"
                                                        class="rounded-circle me-3" width="45">

                                                    <div>

                                                        <h6 class="mb-0 fw-semibold">
                                                            Amit Shah
                                                        </h6>

                                                        <small class="text-muted">
                                                            Customer ID : CUS002
                                                        </small>

                                                    </div>

                                                </div>

                                            </td>

                                            <td>
                                                +91 9988776655
                                            </td>

                                            <td>
                                                Anand
                                            </td>

                                            <td>

                                                <span class="badge bg-primary">
                                                    16 Bills
                                                </span>

                                            </td>

                                            <td class="fw-bold text-success">
                                                ₹31,400
                                            </td>

                                            <td class="fw-bold text-danger">
                                                ₹0
                                            </td>

                                            <td>
                                                18 Jul 2026
                                            </td>

                                            <td>

                                                <span class="badge bg-success">
                                                    Active
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
                                        250 ગ્રાહકોમાંથી 1 થી 10 દર્શાવવામાં આવ્યા છે
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

