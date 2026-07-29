@include('layout.sidebar')


<!-- Content wrapper -->
<div class="content-wrapper">
   <!-- Content -->
   <div class="container-xxl flex-grow-1 container-p-y">
      <div class="card border-0 shadow-lg rounded-4 mt-4">

         <!-- Header -->
         <div class="card-header bg-primary text-white rounded-top-4 py-3">
            <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3">

               <div class="d-flex align-items-center">
                  <div class="rounded-circle bg-white text-primary d-flex align-items-center justify-content-center me-3" style="width:55px;height:55px;">
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
                     બિલ નં. #{{ $purchase->id }}
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
                           {{ $purchase->supplier->name ?? '-' }}
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
                           {{ $purchase->created_at->format('d-m-Y') }}
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
                           {{ $purchase->supplier->mobile ?? '-' }}
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
                           {{ $purchase->total_qty }}
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
                           ₹{{ $purchase->total_amount }}
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
                           બાકી ચૂકવવાની રકમ
                        </label>

                        <div class="input-group mb-3">
                           <span class="input-group-text">₹</span>

                           <input type="number" class="form-control" id="edit_paid_amount" value="{{ $purchase->balance_amount }}" min="0" max="{{ $purchase->balance_amount }}">
                        </div>

                        <button class="btn btn-info w-100" id="updatePaymentBtn" data-id="{{ $purchase->id }}" @if($purchase->balance_amount <= 0) disabled @endif>
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

                              <h2 class="fw-bold text-danger mb-0" id="display_balance_amount">
                                 ₹{{ $purchase->balance_amount }}
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
                              ₹{{ $purchase->total_amount }}
                           </strong>
                        </div>

                        <div class="d-flex justify-content-between mt-2">
                           <small class="text-muted">
                              ચૂકવેલ
                           </small>

                           <strong class="text-success" id="display_paid_amount">
                              ₹{{ $purchase->paid_amount }}
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
                        કુલ {{ $purchase->items->count() }} પ્રોડક્ટ
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

                        @foreach ($purchase->items as $index => $item)

                        <tr>
                           <td>{{ $index + 1 }}</td>
                           <td>
                              <strong>{{ $item->product_name }}</strong>
                           </td>
                           <td class="text-center">{{ $item->qty }}</td>
                           <td class="text-end">₹{{ $item->rate }}</td>
                           <td class="text-end fw-bold">₹{{ $item->total }}</td>
                        </tr>

                        @endforeach

                     </tbody>

                     <tfoot class="table-light">

                        <tr class="fw-bold">
                           <td colspan="2" class="text-end">
                              કુલ
                           </td>

                           <td class="text-center">
                              {{ $purchase->total_qty }}
                           </td>

                           <td></td>

                           <td class="text-end text-success">
                              ₹{{ $purchase->total_amount }}
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

   {{-- UPDATE PAYMENT --}}
   <script>
      document.getElementById('updatePaymentBtn').addEventListener('click', async function() {

         const btn = this;
         const purchaseId = btn.dataset.id;
         const amountInput = document.getElementById('edit_paid_amount');
         const amount = amountInput.value;

         btn.disabled = true;

         try {

            const response = await fetch(`/purchases/${purchaseId}/update-payment`, {

               method: 'PUT',

               headers: {
                  'Content-Type': 'application/json'
                  , 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                  , 'Accept': 'application/json'
               , },

               body: JSON.stringify({
                  amount: amount
               , }),

            });

            const data = await response.json();

            if (response.ok && data.status === true) {

               GlassToast.success('સફળતા', data.message);

               document.getElementById('display_balance_amount').innerText = '₹' + data.balance_amount;
               document.getElementById('display_paid_amount').innerText = '₹' + data.paid_amount;

               // Refresh the input + its max to show the NEW remaining balance
               amountInput.value = data.balance_amount;
               amountInput.max = data.balance_amount;

               if (Number(data.balance_amount) <= 0) {
                  btn.disabled = true;
               }

            } else if (response.status === 422 && data.errors) {

               const firstErrorKey = Object.keys(data.errors)[0];

               GlassToast.error('ભૂલ', data.errors[firstErrorKey][0]);

               btn.disabled = false;

            } else {

               GlassToast.error('ભૂલ', data.message || 'કંઈક ખોટું થયું.');

               btn.disabled = false;

            }

         } catch (error) {

            console.error('Update Payment Error:', error);

            GlassToast.error('ભૂલ', 'સર્વર સાથે કનેક્શન કરવામાં સમસ્યા આવી.');

            btn.disabled = false;

         }

      });

   </script>

   @include('layout.footer')
