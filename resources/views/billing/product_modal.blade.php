<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">
                    પ્રોડક્ટ ઉમેરો
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="product_name" class="form-label">
                        પ્રોડક્ટનું નામ
                    </label>

                    <div class="input-group">
                        <input type="text" class="form-control" id="product_name" name="product_name"
                            placeholder="પ્રોડક્ટનું નામ દાખલ કરો">
                        
                        <!-- Loader for English to Gujarati Conversion -->
                        <span class="input-group-text d-none" id="productNameLoader">
                            <span class="spinner-border spinner-border-sm text-primary" role="status" aria-hidden="true"></span>
                        </span>
                    </div>
                </div>

                <!-- Type -->
                <div class="mb-3">
                    <label for="product_type" class="form-label">
                        પ્રકાર
                    </label>

                    <select class="form-select" id="product_type" name="product_type">
                        <option value="">પ્રકાર પસંદ કરો</option>
                        @foreach ($type as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Quantity -->
                <div class="mb-3">
                    <label for="quantity" class="form-label">
                        નંગ / જથ્થો
                    </label>

                    <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                        placeholder="નંગ / જથ્થો દાખલ કરો">
                </div>

                <!-- Amount -->
                <div class="mb-3">
                    <label for="amount" class="form-label">
                        રકમ
                    </label>

                    <input type="number" class="form-control" id="amount" name="amount" min="0"
                        step="0.01" placeholder="રકમ દાખલ કરો">
                </div>

            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    બંધ કરો
                </button>

                <button type="button" class="btn btn-primary" id="saveNewProductBtn">
                    પ્રોડક્ટ ઉમેરો
                </button>
            </div>

        </div>
    </div>
</div>