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

               <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                  <i class="bx bx-user-plus me-1"></i>
                  નવો ગ્રાહક ઉમેરો
               </button>

            </div>
         </div>

         <!-- Search -->
         <div class="card-body border-bottom">

            <form method="GET" action="{{ route('customer_list') }}">

               <div class="row g-3">

                  <div class="col-lg-5">
                     <div class="input-group">
                        <span class="input-group-text bg-white">
                           <i class="bx bx-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control" placeholder="ગ્રાહક શોધો..." value="{{ $search }}">
                     </div>
                  </div>

                  <div class="col-lg-2">
                     <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bx bx-filter-alt"></i>
                        ફિલ્ટર
                     </button>
                  </div>

                  <div class="col-lg-2">
                     <a href="{{ route('customer_list') }}" class="btn btn-outline-secondary w-100">
                        <i class="bx bx-reset"></i>
                        રીસેટ
                     </a>
                  </div>

               </div>

            </form>

         </div>

         <!-- Table -->
         <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

               <thead class="table-light">

                  <tr>

                     <th>#</th>

                     <th>ગ્રાહક</th>

                     <th>મોબાઇલ નંબર</th>



                     <th>કુલ બિલ</th>

                     <th>કુલ ખરીદી</th>

                     <th>બાકી રકમ</th>

                     <th>છેલ્લું બિલ</th>



                     <th class="text-center">ક્રિયા</th>

                  </tr>

               </thead>

               <tbody>

                  @forelse ($customers as $index => $customer)

                  <tr data-row-id="{{ $customer->id }}">

                     <td>{{ $customers->firstItem() + $index }}</td>

                     <td>

                        <div class="d-flex align-items-center">

                           <img src="https://ui-avatars.com/api/?name={{ urlencode($customer->name) }}" class="rounded-circle me-3" width="45">

                           <div>

                              <h6 class="mb-0 fw-semibold">
                                 {{ $customer->name }}
                              </h6>

                              <small class="text-muted">
                                 ગ્રાહક ID : CUS{{ str_pad($customer->id, 3, '0', STR_PAD_LEFT) }}
                              </small>

                           </div>

                        </div>

                     </td>

                     <td>
                        +91 {{ $customer->mobile }}
                     </td>



                     <td>

                        <span class="badge bg-primary">
                           {{ $customer->bills_count }} Bills
                        </span>

                     </td>

                     <td class="fw-bold text-success">
                        ₹{{ $customer->bills_sum_total_amount ?? 0 }}
                     </td>

                     <td class="fw-bold text-danger">
                        ₹{{ $customer->balance_due }}
                     </td>

                     <td>
                        {{ optional($customer->bills->first())->created_at?->format('d M Y') ?? '-' }}
                     </td>



                     <td class="text-center">

                        <button class="btn btn-sm btn-outline-primary">
                           <i class="bx bx-show"></i>
                        </button>

                        <button class="btn btn-sm btn-outline-warning edit-customer-btn"
                           data-id="{{ $customer->id }}"
                           data-name="{{ $customer->name }}"
                           data-mobile="{{ $customer->mobile }}"
                           data-bs-toggle="modal"
                           data-bs-target="#editCustomerModal"
                        >
                           <i class="bx bx-edit"></i>
                        </button>



                     </td>

                  </tr>

                  @empty

                  <tr>
                     <td colspan="8" class="text-center">
                        હજુ સુધી કોઈ ગ્રાહક ઉમેરાયો નથી.
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
                  {{ $customers->total() }} ગ્રાહકોમાંથી {{ $customers->total() ? $customers->firstItem() : 0 }} થી {{ $customers->lastItem() ?? 0 }} દર્શાવવામાં આવ્યા છે
               </small>

               <nav>

                  <ul class="pagination pagination-sm mb-0">

                     <li class="page-item {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $customers->onFirstPage() ? '#' : $customers->previousPageUrl() }}">પાછળ</a>
                     </li>

                     @php
                        $current = $customers->currentPage();
                        $last = $customers->lastPage();
                        $window = 1;
                     @endphp

                     <li class="page-item {{ $current == 1 ? 'active' : '' }}">
                        <a class="page-link" href="{{ $customers->url(1) }}">1</a>
                     </li>

                     @if ($current - $window > 2)
                        <li class="page-item disabled">
                           <a class="page-link" href="#">...</a>
                        </li>
                     @endif

                     @for ($page = max(2, $current - $window); $page <= min($last - 1, $current + $window); $page++)

                        <li class="page-item {{ $current == $page ? 'active' : '' }}">
                           <a class="page-link" href="{{ $customers->url($page) }}">{{ $page }}</a>
                        </li>

                     @endfor

                     @if ($current + $window < $last - 1)
                        <li class="page-item disabled">
                           <a class="page-link" href="#">...</a>
                        </li>
                     @endif

                     @if ($last > 1)
                        <li class="page-item {{ $current == $last ? 'active' : '' }}">
                           <a class="page-link" href="{{ $customers->url($last) }}">{{ $last }}</a>
                        </li>
                     @endif

                     <li class="page-item {{ !$customers->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $customers->hasMorePages() ? $customers->nextPageUrl() : '#' }}">આગળ</a>
                     </li>

                  </ul>

               </nav>

            </div>

         </div>

      </div>
   </div>
   <!-- / Content -->

   <!-- Add Customer Modal -->
   <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">

      <div class="modal-dialog" role="document">

         <div class="modal-content">

            <div class="modal-header">

               <h5 class="modal-title">
                  નવો ગ્રાહક ઉમેરો
               </h5>

               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               </button>

            </div>

            <form id="customerForm">

               @csrf

               <div class="modal-body">

                  <div class="mb-3">

                     <label class="form-label">
                        ગ્રાહકનું નામ
                     </label>

                     <input type="text" class="form-control" id="customer_name" name="name" placeholder="ગ્રાહકનું નામ">

                  </div>

                  <div class="mb-3">

                     <label class="form-label">
                        મોબાઇલ નંબર
                     </label>

                     <input type="tel" class="form-control" id="customer_mobile" name="mobile" placeholder="9876543210" maxlength="10" inputmode="numeric">

                  </div>

               </div>


               <div class="modal-footer">

                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                     બંધ કરો
                  </button>

                  <button type="submit" class="btn btn-primary" id="saveCustomerBtn">

                     <span id="saveCustomerText">
                        સાચવો
                     </span>

                  </button>

               </div>

            </form>

         </div>

      </div>

   </div>
   <!-- / Add Customer Modal -->

   <!-- Edit Customer Modal -->
   <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-hidden="true">

      <div class="modal-dialog" role="document">

         <div class="modal-content">

            <div class="modal-header">

               <h5 class="modal-title">
                  ગ્રાહક એડિટ કરો
               </h5>

               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               </button>

            </div>

            <form id="editCustomerForm">

               <div class="modal-body">

                  <input type="hidden" id="edit_customer_id">

                  <div class="mb-3">

                     <label class="form-label">
                        ગ્રાહકનું નામ
                     </label>

                     <input type="text" class="form-control" id="edit_customer_name" placeholder="ગ્રાહકનું નામ">

                  </div>

                  <div class="mb-3">

                     <label class="form-label">
                        મોબાઇલ નંબર
                     </label>

                     <input type="tel" class="form-control" id="edit_customer_mobile" placeholder="9876543210" maxlength="10" inputmode="numeric">

                  </div>

               </div>


               <div class="modal-footer">

                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                     બંધ કરો
                  </button>

                  <button type="submit" class="btn btn-primary" id="updateCustomerBtn">

                     <span id="updateCustomerText">
                        અપડેટ કરો
                     </span>

                  </button>

               </div>

            </form>

         </div>

      </div>

   </div>
   <!-- / Edit Customer Modal -->

   {{-- ADD NEW CUSTOMER --}}
   <script>
      document.addEventListener('DOMContentLoaded', function () {

         const form = document.getElementById('customerForm');

         const name = document.getElementById('customer_name');

         const mobile = document.getElementById('customer_mobile');

         const saveBtn = document.getElementById('saveCustomerBtn');

         const saveText = document.getElementById('saveCustomerText');


         // MOBILE - ONLY NUMBERS + MAX 10 DIGITS
         mobile.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
         });


         form.addEventListener('submit', async function (e) {

            e.preventDefault();

            const nameValue = name.value.trim();
            const mobileValue = mobile.value.trim();

            if (nameValue === '') {
               GlassToast.warning('ચેતવણી', 'ગ્રાહકનું નામ દાખલ કરો.');
               name.focus();
               return;
            }

            if (mobileValue === '') {
               GlassToast.warning('ચેતવણી', 'મોબાઇલ નંબર દાખલ કરો.');
               mobile.focus();
               return;
            }

            if (mobileValue.length !== 10) {
               GlassToast.error('ભૂલ', 'મોબાઇલ નંબર 10 અંકનો હોવો જોઈએ.');
               mobile.focus();
               return;
            }

            saveBtn.disabled = true;
            saveText.innerText = 'સાચવી રહ્યું છે...';

            try {

               const response = await fetch("{{ route('customers.store') }}", {

                  method: 'POST',

                  headers: {
                     'X-CSRF-TOKEN': document.querySelector('#customerForm input[name="_token"]').value,
                     'Accept': 'application/json',
                     'X-Requested-With': 'XMLHttpRequest'
                  },

                  body: new FormData(form)

               });

               const data = await response.json();

               if (response.ok && data.status === true) {

                  GlassToast.success('સફળતા', data.message);

                  form.reset();

                  setTimeout(function () {
                     const modalElement = document.getElementById('addCustomerModal');
                     const modal = bootstrap.Modal.getInstance(modalElement);
                     if (modal) { modal.hide(); }
                  }, 500);

                  setTimeout(function () {
                     location.reload();
                  }, 1000);

               } else if (response.status === 422 && data.errors) {

                  const firstErrorKey = Object.keys(data.errors)[0];
                  GlassToast.error('ભૂલ', data.errors[firstErrorKey][0]);

               } else {

                  GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

               }

            } catch (error) {

               console.error('Customer AJAX Error:', error);
               GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

            } finally {

               saveBtn.disabled = false;
               saveText.innerText = 'સાચવો';

            }

         });

      });
   </script>

   {{-- EDIT CUSTOMER --}}
   <script>
      document.addEventListener('click', function (e) {

         const btn = e.target.closest('.edit-customer-btn');

         if (!btn) {
            return;
         }

         document.getElementById('edit_customer_id').value = btn.dataset.id;
         document.getElementById('edit_customer_name').value = btn.dataset.name;
         document.getElementById('edit_customer_mobile').value = btn.dataset.mobile;

      });

      document.getElementById('edit_customer_mobile').addEventListener('input', function () {
         this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
      });

      document.getElementById('editCustomerForm').addEventListener('submit', async function (e) {

         e.preventDefault();

         const id = document.getElementById('edit_customer_id').value;
         const name = document.getElementById('edit_customer_name').value.trim();
         const mobile = document.getElementById('edit_customer_mobile').value.trim();

         if (name === '') {
            GlassToast.warning('ચેતવણી', 'ગ્રાહકનું નામ દાખલ કરો.');
            return;
         }

         if (mobile.length !== 10) {
            GlassToast.error('ભૂલ', 'મોબાઇલ નંબર 10 અંકનો હોવો જોઈએ.');
            return;
         }

         const updateBtn = document.getElementById('updateCustomerBtn');
         const updateText = document.getElementById('updateCustomerText');

         updateBtn.disabled = true;
         updateText.innerText = 'અપડેટ થઈ રહ્યું છે...';

         try {

            const response = await fetch(`/customers/${id}`, {

               method: 'PUT',

               headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                  'Accept': 'application/json',
               },

               body: JSON.stringify({ name, mobile }),

            });

            const data = await response.json();

            if (response.ok && data.status === true) {

               GlassToast.success('સફળતા', data.message);

               setTimeout(function () {
                  const modalElement = document.getElementById('editCustomerModal');
                  const modal = bootstrap.Modal.getInstance(modalElement);
                  if (modal) { modal.hide(); }
               }, 500);

               setTimeout(function () {
                  location.reload();
               }, 1000);

            } else if (response.status === 422 && data.errors) {

               const firstErrorKey = Object.keys(data.errors)[0];
               GlassToast.error('ભૂલ', data.errors[firstErrorKey][0]);

            } else {

               GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

            }

         } catch (error) {

            console.error('Update Customer Error:', error);
            GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

         } finally {

            updateBtn.disabled = false;
            updateText.innerText = 'અપડેટ કરો';

         }

      });
   </script>

   @include('layout.footer')
