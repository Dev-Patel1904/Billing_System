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

               <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
                  <i class="bx bx-plus-circle me-1"></i>
                  નવો સપ્લાયર ઉમેરો
               </button>

            </div>
         </div>

         <!-- Search -->
         <div class="card-body border-bottom">

            <form method="GET" action="{{ route('supplier_list') }}">

               <div class="row g-3">

                  <div class="col-lg-5">
                     <div class="input-group">
                        <span class="input-group-text bg-white">
                           <i class="bx bx-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control" placeholder="સપ્લાયર શોધો..." value="{{ $search }}">
                     </div>
                  </div>

                  <div class="col-lg-3">
                     <select name="status" class="form-select">
                        <option value="">બધી સ્થિતિ</option>
                        <option value="active" @selected($status==='active' )>સક્રિય</option>
                        <option value="inactive" @selected($status==='inactive' )>નિષ્ક્રિય</option>
                     </select>
                  </div>

                  <div class="col-lg-2">
                     <button type="submit" class="btn btn-outline-primary w-100">
                        <i class="bx bx-filter-alt"></i>
                        ફિલ્ટર
                     </button>
                  </div>

                  <div class="col-lg-2">
                     <a href="{{ route('supplier_list') }}" class="btn btn-outline-secondary w-100">
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
                     <th>ક્રમાંક</th>
                     <th>સપ્લાયર</th>
                     <th>સરનામૂ</th>
                     <th>કુલ બિલ</th>
                     <th>કુલ ખરીદી</th>
                     <th>બાકી રકમ</th>
                     <th>છેલ્લી ખરીદી</th>
                     <th>સ્થિતિ</th>
                     <th class="text-center">ક્રિયા</th>
                  </tr>
               </thead>

               <tbody id="supplierTableBody">

                  @forelse ($suppliers as $index => $supplier)

                  <tr data-row-id="{{ $supplier->id }}">

                     <td>{{ $suppliers->firstItem() + $index }}</td>

                     <td>
                        <div class="d-flex align-items-center">

                           <img src="https://ui-avatars.com/api/?name={{ urlencode($supplier->name) }}" class="rounded-circle me-3" width="45" height="45">

                           <div>
                              <h6 class="mb-0 fw-semibold">
                                 {{ $supplier->name }}
                              </h6>

                              <small class="text-muted">
                                 Supplier ID : SUP{{ str_pad($supplier->id, 3, '0', STR_PAD_LEFT) }}
                              </small>
                           </div>

                        </div>
                     </td>

                     <td>{{ $supplier->address }}</td>

                     <td>
                        <span class="badge bg-primary">
                           {{ $supplier->purchases_count }} બિલ
                        </span>
                     </td>

                     <td class="fw-bold text-success">
                        ₹{{ $supplier->purchases_sum_total_amount ?? 0 }}
                     </td>

                     <td class="fw-bold text-danger">
                        ₹{{ $supplier->purchases_sum_balance_amount ?? 0 }}
                     </td>

                     <td>
                        {{ optional($supplier->purchases->first())->created_at?->format('d-m-Y') ?? '-' }}
                     </td>

                     <td>
                        @if($supplier->status === 'active')
                        <span class="badge bg-success">
                           સક્રિય
                        </span>
                        @else
                        <span class="badge bg-secondary">
                           નિષ્ક્રિય
                        </span>
                        @endif
                     </td>

                     <td class="text-center">

                        <a href="{{ route('supplier.purchases', $supplier->id) }}" class="btn btn-sm btn-outline-primary" title="ખરીદીઓ જુઓ">
                           <i class="bx bx-show"></i>
                        </a>

                        <button class="btn btn-sm btn-outline-warning edit-supplier-btn" data-id="{{ $supplier->id }}" data-name="{{ $supplier->name }}" data-address="{{ $supplier->address }}" data-status="{{ $supplier->status }}" data-bs-toggle="modal" data-bs-target="#editSupplierModal" title="એડિટ કરો">
                           <i class="bx bx-edit"></i>
                        </button>

                        <button class="btn btn-sm btn-outline-danger delete-supplier-btn" data-id="{{ $supplier->id }}" data-balance="{{ $supplier->purchases_sum_balance_amount ?? 0 }}" title="કાઢી નાખો">
                           <i class="bx bx-trash"></i>
                        </button>

                     </td>

                  </tr>

                  @empty

                  <tr>
                     <td colspan="9" class="text-center">
                        હજુ સુધી કોઈ સપ્લાયર ઉમેરાયો નથી.
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
                  {{ $suppliers->total() }} સપ્લાયરોમાંથી {{ $suppliers->total() ? $suppliers->firstItem() : 0 }} થી {{ $suppliers->lastItem() ?? 0 }} દર્શાવવામાં આવ્યા છે
               </small>

               <nav>

                  <ul class="pagination pagination-sm mb-0">

                     <li class="page-item {{ $suppliers->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $suppliers->onFirstPage() ? '#' : $suppliers->previousPageUrl() }}">પાછળ</a>
                     </li>

                     @for ($page = 1; $page <= $suppliers->lastPage(); $page++)

                        <li class="page-item {{ $suppliers->currentPage() == $page ? 'active' : '' }}">
                           <a class="page-link" href="{{ $suppliers->url($page) }}">{{ $page }}</a>
                        </li>

                        @endfor

                        <li class="page-item {{ !$suppliers->hasMorePages() ? 'disabled' : '' }}">
                           <a class="page-link" href="{{ $suppliers->hasMorePages() ? $suppliers->nextPageUrl() : '#' }}">આગળ</a>
                        </li>

                  </ul>

               </nav>

            </div>

         </div>

      </div>
   </div>
   <!-- / Content -->

   <!-- Add Supplier Modal -->
   <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

         <div class="modal-content">

            <div class="modal-header">

               <h5 class="modal-title">
                  નવો સપ્લાયર ઉમેરો
               </h5>

               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               </button>

            </div>

            <form id="supplierForm">

               @csrf

               <div class="modal-body">

                  <div class="row">

                     <!-- Supplier Name -->
                     <div class="col-12">

                        <label class="form-label">
                           સપ્લાયરનું નામ
                        </label>

                        <input type="text" class="form-control" id="supplier_name" name="name" placeholder="સપ્લાયરનું નામ">

                     </div>





                     <!-- Address -->
                     <div class="col-12">

                        <label class="form-label">
                           સરનામું
                        </label>

                        <textarea class="form-control" id="new_supplier_address" name="address" rows="3" placeholder="સરનામું દાખલ કરો"></textarea>

                     </div>

                  </div>

               </div>


               <div class="modal-footer">

                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                     બંધ કરો
                  </button>

                  <button type="submit" class="btn btn-primary" id="saveSupplierBtn">

                     <span id="saveSupplierText">
                        સાચવો
                     </span>

                  </button>

               </div>

            </form>

         </div>

      </div>

   </div>
   <!-- / Add Supplier Modal -->

   <!-- Edit Supplier Modal -->
   <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-hidden="true">

      <div class="modal-dialog modal-lg" role="document">

         <div class="modal-content">

            <div class="modal-header">

               <h5 class="modal-title">
                  સપ્લાયર એડિટ કરો
               </h5>

               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
               </button>

            </div>

            <form id="editSupplierForm">

               <div class="modal-body">

                  <input type="hidden" id="edit_supplier_id">

                  <div class="row">

                     <!-- Supplier Name -->
                     <div class="col-12">

                        <label class="form-label">
                           સપ્લાયરનું નામ
                        </label>

                        <input type="text" class="form-control" id="edit_supplier_name" placeholder="સપ્લાયરનું નામ">

                     </div>

                     <!-- Address -->
                     <div class="col-md-8 mb-3">

                        <label class="form-label">
                           સરનામું
                        </label>

                        <textarea class="form-control" id="edit_supplier_address" rows="3" placeholder="સરનામું દાખલ કરો"></textarea>

                     </div>


                     <!-- Status -->
                     <div class="col-md-4 mb-3">

                        <label class="form-label">
                           સ્થિતિ
                        </label>

                        <select class="form-select" id="edit_supplier_status">
                           <option value="active">સક્રિય</option>
                           <option value="inactive">નિષ્ક્રિય</option>
                        </select>

                     </div>

                  </div>

               </div>


               <div class="modal-footer">

                  <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                     બંધ કરો
                  </button>

                  <button type="submit" class="btn btn-primary" id="updateSupplierBtn">

                     <span id="updateSupplierText">
                        અપડેટ કરો
                     </span>

                  </button>

               </div>

            </form>

         </div>

      </div>

   </div>
   <!-- / Edit Supplier Modal -->

   {{-- ENGLISH -> GUJARATI TRANSLITERATION (Enter key) --}}
   <script>
      (function () {

         function attachTransliteration(inputId) {

            const el = document.getElementById(inputId);

            if (!el) {
               return;
            }

            el.addEventListener('keydown', function (e) {

               // Transliterate only when ENTER is pressed
               if (e.key !== 'Enter') {
                  return;
               }

               const cursorPos = el.selectionStart;

               const textBeforeCursor =
                  el.value.substring(0, cursorPos);

               const match =
                  textBeforeCursor.match(/[a-zA-Z]+$/);

               if (!match) {
                  return;
               }

               const englishWord = match[0];

               const wordStart =
                  cursorPos - englishWord.length;

               const textAfterCursor =
                  el.value.substring(cursorPos);

               // Prevent form submit / newline on Enter
               e.preventDefault();

               fetch(
                  'https://inputtools.google.com/request?' +
                  'text=' +
                  encodeURIComponent(englishWord) +
                  '&itc=gu-t-i0-und' +
                  '&num=1'
               )
               .then(function (response) {
                  return response.json();
               })
               .then(function (data) {

                  if (
                     !data ||
                     data[0] !== 'SUCCESS' ||
                     !data[1] ||
                     !data[1][0] ||
                     !data[1][0][1] ||
                     !data[1][0][1][0]
                  ) {
                     return;
                  }

                  const gujaratiWord =
                     data[1][0][1][0];

                  const newValue =
                     el.value.substring(0, wordStart) +
                     gujaratiWord +
                     textAfterCursor;

                  el.value = newValue;

                  const newCursorPos =
                     wordStart + gujaratiWord.length;

                  el.setSelectionRange(
                     newCursorPos,
                     newCursorPos
                  );

               })
               .catch(function (error) {

                  console.error(
                     'Gujarati Transliteration Error:',
                     error
                  );

               });

            });

         }

         // Add modal
         attachTransliteration('supplier_name');
         attachTransliteration('new_supplier_address');

         // Edit modal
         attachTransliteration('edit_supplier_name');
         attachTransliteration('edit_supplier_address');

      })();
   </script>

   {{-- ADD NEW SUPPLIER --}}
   <script>
      document.addEventListener('DOMContentLoaded', function() {

         const form = document.getElementById('supplierForm');

         const name = document.getElementById('supplier_name');

         const address = document.getElementById('new_supplier_address');

         const saveBtn = document.getElementById('saveSupplierBtn');

         const saveText = document.getElementById('saveSupplierText');


         form.addEventListener('submit', async function(e) {

            e.preventDefault();

            const nameValue = name.value.trim();
            const addressValue = address.value.trim();

            if (nameValue === '') {
               GlassToast.warning('ચેતવણી', 'સપ્લાયરનું નામ દાખલ કરો.');
               name.focus();
               return;
            }

            if (addressValue === '') {
               GlassToast.warning('ચેતવણી', 'સરનામું દાખલ કરો.');
               address.focus();
               return;
            }

            saveBtn.disabled = true;
            saveText.innerText = 'સાચવી રહ્યું છે...';

            try {

               const response = await fetch("{{ route('suppliers.store') }}", {

                  method: 'POST',

                  headers: {
                     'X-CSRF-TOKEN': document.querySelector('#supplierForm input[name="_token"]').value
                     , 'Accept': 'application/json'
                     , 'X-Requested-With': 'XMLHttpRequest'
                  },

                  body: new FormData(form)

               });

               const data = await response.json();

               if (response.ok && data.status === true) {

                  GlassToast.success('સફળતા', data.message);

                  form.reset();

                  setTimeout(function() {
                     const modalElement = document.getElementById('addSupplierModal');
                     const modal = bootstrap.Modal.getInstance(modalElement);
                     if (modal) {
                        modal.hide();
                     }
                  }, 500);

                  setTimeout(function() {
                     location.reload();
                  }, 1000);

               } else if (response.status === 422 && data.errors) {

                  if (data.errors.name) {
                     GlassToast.error('સપ્લાયરનું નામ', data.errors.name[0]);
                  } else if (data.errors.address) {
                     GlassToast.error('સરનામું', data.errors.address[0]);
                  }

               } else {

                  GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

               }

            } catch (error) {

               console.error('Supplier AJAX Error:', error);
               GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

            } finally {

               saveBtn.disabled = false;
               saveText.innerText = 'સાચવો';

            }

         });

      });

   </script>

   {{-- EDIT SUPPLIER --}}
   <script>
      document.addEventListener('click', function(e) {

         const btn = e.target.closest('.edit-supplier-btn');

         if (!btn) {
            return;
         }

         document.getElementById('edit_supplier_id').value = btn.dataset.id;
         document.getElementById('edit_supplier_name').value = btn.dataset.name;
         document.getElementById('edit_supplier_address').value = btn.dataset.address;
         document.getElementById('edit_supplier_status').value = btn.dataset.status;

      });

      document.getElementById('editSupplierForm').addEventListener('submit', async function(e) {

         e.preventDefault();

         const id = document.getElementById('edit_supplier_id').value;
         const name = document.getElementById('edit_supplier_name').value.trim();
         const address = document.getElementById('edit_supplier_address').value.trim();
         const status = document.getElementById('edit_supplier_status').value;

         if (name === '') {
            GlassToast.warning('ચેતવણી', 'સપ્લાયરનું નામ દાખલ કરો.');
            return;
         }

         if (address === '') {
            GlassToast.warning('ચેતવણી', 'સરનામું દાખલ કરો.');
            return;
         }

         const updateBtn = document.getElementById('updateSupplierBtn');
         const updateText = document.getElementById('updateSupplierText');

         updateBtn.disabled = true;
         updateText.innerText = 'અપડેટ થઈ રહ્યું છે...';

         try {

            const response = await fetch(`/suppliers/${id}`, {

               method: 'PUT',

               headers: {
                  'Content-Type': 'application/json'
                  , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                  , 'Accept': 'application/json'
               , },

               body: JSON.stringify({
                  name
                  , address
                  , status
               }),

            });

            const data = await response.json();

            if (response.ok && data.status === true) {

               GlassToast.success('સફળતા', data.message);

               setTimeout(function() {
                  const modalElement = document.getElementById('editSupplierModal');
                  const modal = bootstrap.Modal.getInstance(modalElement);
                  if (modal) {
                     modal.hide();
                  }
               }, 500);

               setTimeout(function() {
                  location.reload();
               }, 1000);

            } else if (response.status === 422 && data.errors) {

               const firstErrorKey = Object.keys(data.errors)[0];
               GlassToast.error('ભૂલ', data.errors[firstErrorKey][0]);

            } else {

               GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

            }

         } catch (error) {

            console.error('Update Supplier Error:', error);
            GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

         } finally {

            updateBtn.disabled = false;
            updateText.innerText = 'અપડેટ કરો';

         }

      });

   </script>

   {{-- DELETE SUPPLIER --}}
   <script>
      document.addEventListener('click', function(e) {

         const btn = e.target.closest('.delete-supplier-btn');

         if (!btn) {
            return;
         }

         const balance = Number(btn.dataset.balance) || 0;

         const confirmMessage = balance > 0 ?
            `આ સપ્લાયરની ₹${balance} બાકી રકમ છે. શું તમે તો પણ કાઢી નાખવા માંગો છો?` :
            'શું તમે ખરેખર આ સપ્લાયર કાઢી નાખવા માંગો છો?';

         GlassToast.confirm(
            'સપ્લાયર કાઢી નાખો'
            , confirmMessage
            , async function() {

               const supplierId = btn.dataset.id;

               try {

                  const response = await fetch(`/suppliers/${supplierId}`, {

                     method: 'DELETE',

                     headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        , 'Accept': 'application/json'
                     , },

                  });

                  const data = await response.json();

                  if (response.ok && data.status === true) {

                     GlassToast.success('સફળતા', data.message);

                     btn.closest('tr').remove();

                  } else {

                     GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

                  }

               } catch (error) {

                  console.error('Delete Supplier Error:', error);
                  GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

               }

            }
         );

      });

   </script>

   {{-- SEARCH ENGLISH TO GUJRATI --}}
   <script>
    document.addEventListener('DOMContentLoaded', function () {

        const searchForm = document.querySelector(
            'form[action="{{ route('supplier_list') }}"]'
        );

        const searchInput = searchForm?.querySelector(
            'input[name="search"]'
        );

        if (!searchForm || !searchInput) {
            return;
        }

        searchInput.addEventListener('keydown', function (e) {

            // ENTER = transliterate only
            if (e.key !== 'Enter') {
                return;
            }

            // IMPORTANT:
            // Stop form submission when Enter is pressed.
            e.preventDefault();

            const cursorPos = searchInput.selectionStart;

            const textBeforeCursor =
                searchInput.value.slice(0, cursorPos);

            const textAfterCursor =
                searchInput.value.slice(cursorPos);

            // Get last English word
            const match =
                textBeforeCursor.match(/[a-zA-Z]+$/);

            if (!match) {
                return;
            }

            const englishWord = match[0];

            const wordStart =
                cursorPos - englishWord.length;

            fetch(
                'https://inputtools.google.com/request?' +
                'text=' + encodeURIComponent(englishWord) +
                '&itc=gu-t-i0-und&num=1'
            )
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {

                if (
                    !data ||
                    data[0] !== 'SUCCESS' ||
                    !data[1] ||
                    !data[1][0] ||
                    !data[1][0][1] ||
                    !data[1][0][1][0]
                ) {
                    return;
                }

                const gujaratiWord =
                    data[1][0][1][0];

                const newValue =
                    searchInput.value.slice(0, wordStart) +
                    gujaratiWord +
                    textAfterCursor;

                searchInput.value = newValue;

                const newCursorPos =
                    wordStart + gujaratiWord.length;

                searchInput.setSelectionRange(
                    newCursorPos,
                    newCursorPos
                );

            })
            .catch(function (error) {

                console.error(
                    'Gujarati Transliteration Error:',
                    error
                );

            });

        });

    });
    </script>

   @include('layout.footer')
