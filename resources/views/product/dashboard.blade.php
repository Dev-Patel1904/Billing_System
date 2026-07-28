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
                  17 July 2026
                </span>
              </div>
            </div>


            <div class="row g-4">

              <!-- Today's Sales -->
              <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                      <div>
                        <small class="text-muted">
                          આજનું વેચાણ
                        </small>

                        <h3 class="fw-bold mt-2 mb-1">
                          ₹25,600
                        </h3>

                        <span class="badge bg-success">
                          +12%
                        </span>

                      </div>

                      <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bx bx-rupee text-primary fs-2"></i>
                      </div>

                    </div>

                  </div>
                </div>
              </div>

              <!-- Total Bills -->
              <div class="col-xl-3 col-md-6">
                <div class="card border-0 shadow-sm h-100">
                  <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                      <div>

                        <small class="text-muted">
                          આજના બિલ
                        </small>

                        <h3 class="fw-bold mt-2 mb-1">
                          42
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
                          ₹8,450
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
                          215
                        </h3>

                        <span class="badge bg-success">
                          સક્રિય
                        </span>

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
                        ચાલુ વર્ષના વેચાણનો સંક્ષિપ્ત અહેવાલ
                      </small>
                    </div>

                    <select class="form-select w-auto">
                      <option>2026</option>
                      <option>2025</option>
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
                      <strong class="text-success">₹18,500</strong>
                    </div>

                    <div class="progress mb-3" style="height:8px;">
                      <div class="progress-bar bg-success" style="width:75%"></div>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                      <span>બાકી બિલ</span>
                      <strong class="text-warning">₹6,250</strong>
                    </div>

                    <div class="progress mb-4" style="height:8px;">
                      <div class="progress-bar bg-warning" style="width:25%"></div>
                    </div>

                    <div class="row text-center">

                      <div class="col-6 border-end">

                        <h4 class="fw-bold text-primary">
                          ₹24,750
                        </h4>

                        <small class="text-muted">
                          આજનું વેચાણ
                        </small>

                      </div>

                      <div class="col-6">

                        <h4 class="fw-bold text-danger">
                          ₹8,450
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

                      <div class="mt-3 mt-lg-0">

                        <div class="input-group">

                          <span class="input-group-text bg-white">
                            <i class="bx bx-search"></i>
                          </span>

                          <input type="text" class="form-control" placeholder="Search bill...">

                        </div>

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

                        <tr>

                          <td>
                            <strong>#1001</strong>
                          </td>

                          <td>
                            Rahul Patel
                          </td>

                          <td>
                            9876543210
                          </td>

                          <td>
                            17-07-2026
                          </td>

                          <td>

                            <span class="badge bg-success">
                              રોકડ
                            </span>

                          </td>

                          <td>

                            <strong>
                              ₹2,450
                            </strong>

                          </td>

                          <td>

                            <span class="badge bg-primary">
                              ચૂકવેલ
                            </span>

                          </td>

                          <td class="text-center">

                            <button class="btn btn-sm btn-outline-primary me-1">
                              <i class="bx bx-show"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-success me-1">
                              <i class="bx bx-printer"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-warning">
                              <i class="bx bx-edit"></i>
                            </button>

                          </td>

                        </tr>

                        <tr>

                          <td><strong>#1002</strong></td>

                          <td>Amit Shah</td>

                          <td>9876500000</td>

                          <td>17-07-2026</td>

                          <td>

                            <span class="badge bg-warning text-dark">
                              બાકી
                            </span>

                          </td>

                          <td>

                            <strong>₹1,780</strong>

                          </td>

                          <td>

                            <span class="badge bg-danger">
                              બાકી
                            </span>

                          </td>

                          <td class="text-center">

                            <button class="btn btn-sm btn-outline-primary me-1">
                              <i class="bx bx-show"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-success me-1">
                              <i class="bx bx-printer"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-warning">
                              <i class="bx bx-edit"></i>
                            </button>

                          </td>

                        </tr>

                        <tr>

                          <td><strong>#1003</strong></td>

                          <td>Jay Parmar</td>

                          <td>9898989898</td>

                          <td>17-07-2026</td>

                          <td>

                            <span class="badge bg-success">
                              રોકડ
                            </span>

                          </td>

                          <td>

                            <strong>₹3,150</strong>

                          </td>

                          <td>

                            <span class="badge bg-primary">
                              ચૂકવેલ
                            </span>

                          </td>

                          <td class="text-center">

                            <button class="btn btn-sm btn-outline-primary me-1">
                              <i class="bx bx-show"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-success me-1">
                              <i class="bx bx-printer"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-warning">
                              <i class="bx bx-edit"></i>
                            </button>

                          </td>

                        </tr>

                        <tr>

                          <td><strong>#1004</strong></td>

                          <td>Mehul Patel</td>

                          <td>9999999999</td>

                          <td>17-07-2026</td>

                          <td>

                            <span class="badge bg-warning text-dark">
                              બાકી
                            </span>

                          </td>

                          <td>

                            <strong>₹980</strong>

                          </td>

                          <td>

                            <span class="badge bg-danger">
                              બાકી
                            </span>

                          </td>

                          <td class="text-center">

                            <button class="btn btn-sm btn-outline-primary me-1">
                              <i class="bx bx-show"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-success me-1">
                              <i class="bx bx-printer"></i>
                            </button>

                            <button class="btn btn-sm btn-outline-warning">
                              <i class="bx bx-edit"></i>
                            </button>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                  <!-- Footer -->

                  <div class="card-footer bg-white">

                    <div class="d-flex justify-content-between align-items-center">

                      <small class="text-muted">

                        કુલ 124 બિલમાંથી 4 બિલ દર્શાવવામાં આવ્યા છે

                      </small>

                      <button class="btn btn-primary">

                        <i class="bx bx-list-ul me-1"></i>

                        બધા બિલ જુઓ

                      </button>

                    </div>

                  </div>

                </div>

              </div>

            </div>
            <div class="row mt-4">

              <!-- Pending Due Customers -->
              <div class="col-xl-6 mb-4">

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

                    <button class="btn btn-sm btn-outline-warning">
                      બધા જુઓ
                    </button>

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

                        <tr>
                          <td>Rahul Patel</td>
                          <td>9876543210</td>
                          <td>
                            <span class="fw-bold text-danger">
                              ₹2,350
                            </span>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary">
                              <i class="bx bx-show"></i>
                            </button>
                          </td>
                        </tr>

                        <tr>
                          <td>Amit Shah</td>
                          <td>9898989898</td>
                          <td>
                            <span class="fw-bold text-danger">
                              ₹1,450
                            </span>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary">
                              <i class="bx bx-show"></i>
                            </button>
                          </td>
                        </tr>

                        <tr>
                          <td>Jay Parmar</td>
                          <td>9999999999</td>
                          <td>
                            <span class="fw-bold text-danger">
                              ₹980
                            </span>
                          </td>
                          <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary">
                              <i class="bx bx-show"></i>
                            </button>
                          </td>
                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

              <!-- Top Selling Products -->

              <div class="col-xl-6 mb-4">

                <div class="card border-0 shadow-sm h-100">

                  <div class="card-header bg-white d-flex justify-content-between align-items-center">

                    <div>

                      <h5 class="fw-bold mb-0">
                        <i class="bx bx-trophy text-success me-2"></i>
                        સૌથી વધુ વેચાતા ઉત્પાદનો
                      </h5>

                      <small class="text-muted">
                        શ્રેષ્ઠ વેચાણ ધરાવતા ઉત્પાદનો
                      </small>

                    </div>

                    <button class="btn btn-sm btn-outline-success">
                      અહેવાલ જુઓ
                    </button>

                  </div>

                  <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                      <thead class="table-light">
                        <tr>
                          <th>ઉત્પાદન</th>
                          <th>વેચાયેલ જથ્થો</th>
                          <th>આવક</th>
                        </tr>
                      </thead>

                      <tbody>

                        <tr>
                          <td>ચોખા</td>
                          <td>120</td>
                          <td class="fw-bold text-success">
                            ₹18,500
                          </td>
                        </tr>

                        <tr>
                          <td>ઘઉં</td>
                          <td>95</td>
                          <td class="fw-bold text-success">
                            ₹15,200
                          </td>
                        </tr>

                        <tr>
                          <td>તેલ</td>
                          <td>72</td>
                          <td class="fw-bold text-success">
                            ₹11,750
                          </td>
                        </tr>

                        <tr>
                          <td>ખાંડ</td>
                          <td>60</td>
                          <td class="fw-bold text-success">
                            ₹8,900
                          </td>
                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

            <!-- Low Stock -->

            <div class="row">

              <div class="col-12">

                <div class="card border-0 shadow-sm">

                  <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">
                      <i class="bx bx-error-circle text-danger me-2"></i>
                      ઓછા સ્ટોકની ચેતવણી
                    </h5>

                  </div>

                  <div class="card-body">

                    <div class="row g-3">

                      <div class="col-lg-3 col-md-6">

                        <div class="border rounded p-3">

                          <div class="d-flex justify-content-between">

                            <div>

                              <h6 class="mb-1">
                                ચોખા
                              </h6>

                              <small class="text-muted">
                                બાકી સ્ટોક
                              </small>

                            </div>

                            <span class="badge bg-danger">
                              5 કિ.ગ્રા.
                            </span>

                          </div>

                        </div>

                      </div>

                      <div class="col-lg-3 col-md-6">

                        <div class="border rounded p-3">

                          <div class="d-flex justify-content-between">

                            <div>

                              <h6 class="mb-1">
                                તેલ
                              </h6>

                              <small class="text-muted">
                                બાકી સ્ટોક
                              </small>

                            </div>

                            <span class="badge bg-warning text-dark">
                              3 બોટલ
                            </span>

                          </div>

                        </div>

                      </div>

                      <div class="col-lg-3 col-md-6">

                        <div class="border rounded p-3">

                          <div class="d-flex justify-content-between">

                            <div>

                              <h6 class="mb-1">
                                ખાંડ
                              </h6>

                              <small class="text-muted">
                                બાકી સ્ટોક
                              </small>

                            </div>

                            <span class="badge bg-danger">
                              8 કિ.ગ્રા.
                            </span>

                          </div>

                        </div>

                      </div>

                      <div class="col-lg-3 col-md-6">

                        <div class="border rounded p-3">

                          <div class="d-flex justify-content-between">

                            <div>

                              <h6 class="mb-1">
                                ચા
                              </h6>

                              <small class="text-muted">
                                બાકી સ્ટોક
                              </small>

                            </div>

                            <span class="badge bg-warning text-dark">
                              10 પેકેટ
                            </span>

                          </div>

                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>
            <div class="row mt-4">

              <!-- Quick Actions -->
              <div class="col-xl-4 mb-4">

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
                        <a href="#" class="btn btn-primary w-100 py-3">
                          <i class="bx bx-receipt fs-3 d-block mb-2"></i>
                          નવું બિલ
                        </a>
                      </div>

                      <div class="col-6">
                        <a href="#" class="btn btn-success w-100 py-3">
                          <i class="bx bx-user-plus fs-3 d-block mb-2"></i>
                          ગ્રાહક
                        </a>
                      </div>

                      <div class="col-6">
                        <a href="#" class="btn btn-warning w-100 py-3 text-dark">
                          <i class="bx bx-package fs-3 d-block mb-2"></i>
                          પ્રોડક્ટ્સ
                        </a>
                      </div>

                      <div class="col-6">
                        <a href="#" class="btn btn-info w-100 py-3 text-white">
                          <i class="bx bx-cart fs-3 d-block mb-2"></i>
                          ખરીદી
                        </a>
                      </div>

                      <div class="col-6">
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
                      </div>

                    </div>

                  </div>

                </div>

              </div>

              <!-- Today's Summary -->

              <div class="col-xl-4 mb-4">

                <div class="card border-0 shadow-sm h-100">

                  <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">
                      <i class="bx bx-pie-chart-alt text-success me-2"></i>
                      આજનો સારાંશ
                    </h5>

                  </div>

                  <div class="card-body">

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>કુલ વેચાણ</span>
                      <strong class="text-success">₹25,600</strong>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>રોકડ વેચાણ</span>
                      <strong class="text-primary">₹18,250</strong>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>બાકી વેચાણ</span>
                      <strong class="text-warning">₹7,350</strong>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>ખર્ચ</span>
                      <strong class="text-danger">₹2,450</strong>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>નફો</span>
                      <strong class="text-success fs-5">
                        ₹23,150
                      </strong>
                    </div>

                    <div class="d-flex justify-content-between pt-3">
                      <span>કુલ બિલ</span>
                      <strong>42 બિલ</strong>
                    </div>

                  </div>

                </div>

              </div>

              <!-- Recent Activity -->

              <div class="col-xl-4 mb-4">

                <div class="card border-0 shadow-sm h-100">

                  <div class="card-header bg-white">

                    <h5 class="fw-bold mb-0">
                      <i class="bx bx-pie-chart-alt text-success me-2"></i>
                      આજનો સારાંશ
                    </h5>

                  </div>

                  <div class="card-body">

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>કુલ વેચાણ</span>
                      <strong class="text-success">₹25,600</strong>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>રોકડ વેચાણ</span>
                      <strong class="text-primary">₹18,250</strong>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>બાકી વેચાણ</span>
                      <strong class="text-warning">₹7,350</strong>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>ખર્ચ</span>
                      <strong class="text-danger">₹2,450</strong>
                    </div>

                    <div class="d-flex justify-content-between py-2 border-bottom">
                      <span>નફો</span>
                      <strong class="text-success fs-5">
                        ₹23,150
                      </strong>
                    </div>

                    <div class="d-flex justify-content-between pt-3">
                      <span>કુલ બિલ</span>
                      <strong>42 બિલ</strong>
                    </div>

                  </div>

                </div>

              </div>

            </div>
          </div>

          <!-- / Content -->

@include('layout.footer')
