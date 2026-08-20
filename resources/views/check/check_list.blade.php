@include('layout.sidebar')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card border-0 shadow-sm">
        

<div class="card">

    {{-- હેડર --}}
    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            ચેકની યાદી
        </h5>

        <button class="btn btn-primary">
            <i class="bx bx-plus"></i>
            બાકી રકમ ચૂકવો
        </button>

    </div>


   {{-- ફિલ્ટર --}}

<div class="card-body border-bottom">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h6 class="mb-0 fw-semibold">
            ચેક શોધો
        </h6>

        {{-- <span class="text-muted small">
            ચેક નંબર, ઇન્વૉઇસ અથવા સપ્લાયર દ્વારા શોધો
        </span> --}}

    </div>

    <form>

        <div class="row g-3 align-items-end">

            {{-- તારીખ --}}
            <div class="col-md-3">

                <label class="form-label">
                    ચેકની તારીખ
                </label>

                <input type="date"
                       class="form-control"
                       name="date">

            </div>


            {{-- ચેક નંબર / ઇન્વૉઇસ નંબર --}}
            <div class="col-md-3">

                <label class="form-label">
                    ચેક નંબર / ઇન્વૉઇસ નંબર
                </label>

                <input type="text"
                       class="form-control"
                       name="check_number"
                       placeholder="ચેક નંબર / ઇન્વૉઇસ નંબર દાખલ કરો">

            </div>


            {{-- સપ્લાયર --}}
            <div class="col-md-3">

                <label class="form-label">
                    સપ્લાયરનું નામ
                </label>

                <select class="form-select"
                        name="supplier_id">

                    <option value="">
                        બધા સપ્લાયર
                    </option>

                    <option value="1">
                        ABC સપ્લાયર
                    </option>

                    <option value="2">
                        XYZ ટ્રેડર્સ
                    </option>

                    <option value="3">
                        પટેલ એન્ટરપ્રાઇઝ
                    </option>

                    <option value="4">
                        મહેતા ટ્રેડર્સ
                    </option>

                </select>

            </div>


            {{-- બટનો --}}
            <div class="col-md-3">

                <div class="d-flex gap-2">

                    {{-- શોધો --}}
                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bx bx-search"></i>
                        શોધો

                    </button>


                    {{-- સાફ કરો --}}
                    <a href="#"
                       class="btn btn-outline-secondary">

                        <i class="bx bx-reset"></i>
                        સાફ કરો

                    </a>

                </div>

            </div>

        </div>

    </form>

</div>


    {{-- ટેબલ --}}
    <div class="table-responsive text-nowrap">

        <table class="table table-hover align-middle">

            <thead class="table-light">

                <tr>

                    <th>ક્રમ</th>

                    <th>ચેક નંબર</th>

                    <th>ચેકની રકમ</th>

                    <th>ચેકની તારીખ</th>

                    <th>સપ્લાયરનું નામ</th>

                    <th>ઇન્વૉઇસ નંબર</th>

                    <th>સ્થિતિ</th>

                    <th class="text-center">
                        કાર્યવાહી
                    </th>

                </tr>

            </thead>


            <tbody>

                {{-- ચેક 1 --}}
                <tr>

                    <td>
                        ૧
                    </td>

                    <td>
                        <span class="fw-semibold">
                            001245
                        </span>
                    </td>

                    <td>
                        ₹25,000.00
                    </td>

                    <td>
                        20-08-2026
                    </td>

                    <td>
                        ABC સપ્લાયર
                    </td>

                    <td>
                        INV-1025
                    </td>

                    <td>

                        <span class="badge bg-warning">
                            બાકી
                        </span>

                    </td>

                    <td class="text-center">

                        <div class="d-flex justify-content-center gap-1">

                            {{-- ચેક બાઉન્સ --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    title="ચેક બાઉન્સ">

                                <i class="bx bx-x-circle"></i>
                                ચેક બાઉન્સ

                            </button>


                            {{-- ચેક પાસ --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-success"
                                    title="ચેક પાસ">

                                <i class="bx bx-check-circle"></i>
                                ચેક પાસ

                            </button>


                            {{-- રદ કરો --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-secondary"
                                    title="ચેક રદ કરો">

                                <i class="bx bx-block"></i>
                                રદ કરો

                            </button>

                        </div>

                    </td>

                </tr>


                {{-- ચેક 2 --}}
                <tr>

                    <td>
                        ૨
                    </td>

                    <td>
                        <span class="fw-semibold">
                            001246
                        </span>
                    </td>

                    <td>
                        ₹18,500.00
                    </td>

                    <td>
                        22-08-2026
                    </td>

                    <td>
                        XYZ ટ્રેડર્સ
                    </td>

                    <td>
                        INV-1026
                    </td>

                    <td>

                        <span class="badge bg-warning">
                            બાકી
                        </span>

                    </td>

                    <td class="text-center">

                        <div class="d-flex justify-content-center gap-1">

                            {{-- ચેક બાઉન્સ --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-danger"
                                    title="ચેક બાઉન્સ">

                                <i class="bx bx-x-circle"></i>
                                ચેક બાઉન્સ

                            </button>


                            {{-- ચેક પાસ --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-success"
                                    title="ચેક પાસ">

                                <i class="bx bx-check-circle"></i>
                                ચેક પાસ

                            </button>


                            {{-- રદ કરો --}}
                            <button type="button"
                                    class="btn btn-sm btn-outline-secondary"
                                    title="ચેક રદ કરો">

                                <i class="bx bx-block"></i>
                                રદ કરો

                            </button>

                        </div>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>
</div>
    </div>
</div>
@include('layout.footer')