@php
    $remainingPreviousDue = (float) $bill->previous_due;

    $currentBillDue = $bill->payment_type === 'due' ? (float) $bill->grand_total : 0;

    $finalOutstanding = $remainingPreviousDue + $currentBillDue;
@endphp

<!DOCTYPE html>
<html lang="gu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>બિલ - {{ $bill->bill_no }}</title>

    <style>
        * {
            box-sizing: border-box;
        }

        @page {
            size: A4;
            margin: 10mm;
        }

        body {
            margin: 0;
            padding: 30px;
            background: #eef1f5;
            color: #17202a;

            font-family:
                "Noto Sans Gujarati",
                "Nirmala UI",
                "Shruti",
                sans-serif;

            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================
           TOP ACTION BAR
        ========================= */

        .no-print {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 25px;
        }

        .print-btn {
            display: inline-block;
            padding: 10px 20px;
            border: 1px solid #000;
            border-radius: 6px;
            background: #fff;
            color: #000;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .print-btn:hover {
            background: #000;
            color: #fff;
        }

        @media (max-width: 500px) {

            .no-print {
                flex-direction: column;
                width: 100%;
            }

            .print-btn {
                width: 100%;
                text-align: center;
            }
        }

        @media print {

            .no-print {
                display: none !important;
            }
        }

        @media (max-width: 500px) {

            .no-print {
                flex-direction: column;
                width: 100%;
            }

            .print-btn {
                width: 100%;
            }
        }

        @media print {
            .no-print {
                display: none !important;
            }
        }

        /* =========================
           BILL PAPER
        ========================= */

        .bill {
            width: 850px;
            max-width: 100%;
            margin: auto;
            background: #fff;
            border-radius: 18px;
            overflow: hidden;

            box-shadow:
                0 20px 50px rgba(15, 23, 42, .12);

            border: 1px solid #e5e7eb;
        }

        /* =========================
           HEADER
        ========================= */

        .bill-header {
            padding: 28px 32px 24px;


            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .shop-section {
            flex: 1;
        }

        .shop-name {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: .2px;
        }

        .shop-subtitle {
            margin-top: 3px;
            font-size: 13px;
            color: #d1d5db;
        }

        .bill-heading {
            text-align: right;
        }

        .bill-heading .title {
            font-size: 25px;
            font-weight: 800;
            margin: 0;
        }

        .bill-heading .bill-number {
            margin-top: 3px;
            color: #d1d5db;
            font-size: 13px;
        }

        /* =========================
           CUSTOMER SECTION
        ========================= */

        .content {
            padding: 28px 32px 32px;
        }

        .section-title {
            font-size: 14px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 12px;
        }

        .customer-card {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 25px;
        }

        .info-box {
            border: 1px solid #e5e7eb;
            background: #f9fafb;
            border-radius: 12px;
            padding: 12px 15px;
        }

        .info-label {
            display: block;
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 2px;
        }

        .info-value {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
        }

        /* =========================
   PRODUCT TABLE
========================= */

        .table-wrapper {
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
            background: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .product-table thead {
            background: #f3f4f6;
        }

        th {
            padding: 12px 13px;
            color: #000;
            font-size: 13px;
            font-weight: 800;
            border-bottom: 1px solid #d1d5db;
        }

        td {
            padding: 12px 13px;
            border-bottom: 1px solid #edf0f2;
            color: #000;
            font-size: 14px;
        }

        .product-table tbody tr:last-child td {
            border-bottom: 0;
        }

        .product-table tbody tr:hover {
            background: #fafafa;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .product-name {
            font-weight: 600;
        }

        .amount {
            font-weight: 700;
        }


        /* =========================
   SUMMARY
========================= */
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }

        .summary-table td {
            width: 33.33%;
            padding: 14px 16px;
            border: 0.1px solid #e5e7eb;
            color: #000;
            text-align: center;
            background: #fff;
        }

        .summary-label {
            font-size: 13px;
            font-weight: 600;
            margin-right: 6px;
            color: #000;
        }

        .summary-value {
            font-size: 15px;
            font-weight: 800;
            color: #000;
        }


        /* =========================
   MOBILE
========================= */

        @media (max-width: 500px) {

            .summary-table td {
                padding: 11px 5px;
            }

            .summary-label {
                display: block;
                font-size: 11px;
                margin: 0 0 3px;
            }

            .summary-value {
                display: block;
                font-size: 13px;
            }
        }


        /* =========================
   PRINT / PDF
========================= */

        @media print {

            .summary-table {
                width: 100%;
            }

            .summary-table td {
                color: #000 !important;
                background: #fff !important;
                border-color: #000;
            }

            .summary-label,
            .summary-value {
                color: #000 !important;
            }
        }


        /* =========================
   MOBILE
========================= */

        @media (max-width: 650px) {

            .table-wrapper {
                overflow-x: auto;
            }

            .product-table {
                min-width: 600px;
            }

            .summary-table {
                min-width: 100%;
            }

            th {
                padding: 10px;
                font-size: 12px;
            }

            td {
                padding: 10px;
                font-size: 13px;
            }
        }


        /* =========================
   PRINT / PDF
========================= */

        @media print {

            .table-wrapper {
                border-radius: 0;
                overflow: visible;
            }

            th,
            td {
                color: #000 !important;
                background: #fff !important;
            }

            .product-table tbody tr:hover {
                background: #fff;
            }

            .summary-table {
                page-break-inside: avoid;
            }
        }

        /* =========================
           SUMMARY
        ========================= */

        .summary-area {
            display: flex;
            justify-content: flex-end;
            margin-top: 18px;
        }

        .summary {
            width: 390px;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            overflow: hidden;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;

            padding: 10px 15px;
            border-bottom: 1px solid #edf0f2;

            font-size: 14px;
        }

        .summary-row:last-child {
            border-bottom: 0;
        }

        .summary-label {
            color: #6b7280;
        }

        .summary-value {
            font-weight: 700;
            color: #111827;
            text-align: right;
        }

        .grand-total {

            padding: 15px;
        }

        .grand-total .summary-label,
        .grand-total .summary-value {
            color: #000000;
        }

        .grand-total .summary-label {
            font-weight: 700;
        }

        .grand-total .summary-value {
            font-size: 18px;
        }

        /* =========================
           PAYMENT STATUS
        ========================= */

        .status-section {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-top: 22px;
            padding: 16px 18px;

            border-radius: 14px;
            border: 1px solid #e5e7eb;
            background: #fafafa;
        }

        .status-label {
            color: #6b7280;
            font-size: 13px;
        }

        .status {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            padding: 6px 13px;
            border-radius: 50px;

            font-size: 14px;
            font-weight: 800;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-cash {
            color: #047857;
            background: #ecfdf5;
        }

        .status-cash .status-dot {
            background: #10b981;
        }

        .status-due {
            color: #b45309;
            background: #fffbeb;
        }

        .status-due .status-dot {
            background: #f59e0b;
        }

        /* =========================
           FOOTER
        ========================= */

        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px dashed #d1d5db;

            color: #6b7280;
            font-size: 13px;
        }

        .footer strong {
            color: #111827;
        }

        /* =========================
           RESPONSIVE
        ========================= */

        @media (max-width: 650px) {

            body {
                padding: 12px;
            }

            .bill-header {
                padding: 22px;
                flex-direction: column;
                align-items: flex-start;
            }

            .bill-heading {
                text-align: left;
            }

            .content {
                padding: 20px;
            }

            .customer-card {
                grid-template-columns: 1fr;
            }

            .summary-area {
                justify-content: stretch;
            }

            .summary {
                width: 100%;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            table {
                min-width: 650px;
            }

            .no-print {
                justify-content: center;
            }
        }

        /* =========================
           PRINT
        ========================= */

        @media print {

            html,
            body {
                margin: 0;
                padding: 0;
                background: #fff;
            }

            body {
                font-size: 12px;
            }

            .no-print {
                display: none !important;
            }

            .bill {
                width: 100%;
                max-width: none;
                margin: 0;
                border: 0;
                border-radius: 0;
                box-shadow: none;
            }

            .bill-header {
                border-radius: 0;
                padding: 18px 20px;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .content {
                padding: 18px 20px;
            }

            .customer-card {
                margin-bottom: 15px;
            }

            .info-box {
                padding: 8px 10px;
            }

            th {
                padding: 8px 10px;
            }

            td {
                padding: 8px 10px;
            }

            .table-wrapper {
                border-radius: 0;
            }

            .summary-area {
                margin-top: 12px;
            }

            .summary {
                width: 360px;
            }

            .grand-total {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status-section {
                margin-top: 15px;
                padding: 10px 13px;
            }

            .footer {
                margin-top: 20px;
                padding-top: 12px;
            }

            tr {
                page-break-inside: avoid;
            }

            table {
                page-break-inside: auto;
            }
        }

        /* =========================
   HEADER
========================= */

        .bill-header {
            padding: 28px 32px 24px;
            background: #fff;
            color: #000;

            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .shop-section {
            flex: 1;
        }

        .shop-name {
            margin: 0;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: .2px;
            color: #000;
        }

        .shop-subtitle {
            margin-top: 3px;
            font-size: 13px;
            color: #000;
        }

        .bill-heading {
            text-align: right;
        }

        .bill-heading .title {
            font-size: 25px;
            font-weight: 800;
            margin: 0;
            color: #000;
        }

        .bill-heading .bill-number {
            margin-top: 3px;
            color: #000;
            font-size: 13px;
        }


        /* =========================
   RESPONSIVE
========================= */

        @media (max-width: 650px) {

            .bill-header {
                padding: 22px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            .shop-section {
                width: 100%;
            }

            .shop-name {
                font-size: 24px;
            }

            .shop-subtitle {
                font-size: 12px;
            }

            .bill-heading {
                width: 100%;
                text-align: left;
            }

            .bill-heading .title {
                font-size: 22px;
            }

            .bill-heading .bill-number {
                font-size: 12px;
            }
        }


        /* =========================
   VERY SMALL DEVICES
========================= */

        @media (max-width: 400px) {

            .bill-header {
                padding: 18px;
                gap: 10px;
            }

            .shop-name {
                font-size: 21px;
            }

            .shop-subtitle {
                font-size: 11px;
            }

            .bill-heading .title {
                font-size: 20px;
            }

            .bill-heading .bill-number {
                font-size: 11px;
            }
        }


        /* =========================
   PRINT / PDF
========================= */

        @media print {

            @page {
                size: A4;
                margin: 10mm;
            }

            html,
            body {
                margin: 0;
                padding: 0;
                background: #fff !important;
                color: #000 !important;
            }

            .bill-header {
                width: 100%;
                padding: 18px 20px;
                background: #fff !important;
                color: #000 !important;

                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: center;

                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .shop-section {
                flex: 1;
            }

            .shop-name {
                font-size: 24px;
                color: #000 !important;
            }

            .shop-subtitle {
                font-size: 12px;
                color: #000 !important;
            }

            .bill-heading {
                text-align: right;
            }

            .bill-heading .title {
                font-size: 22px;
                color: #000 !important;
            }

            .bill-heading .bill-number {
                font-size: 12px;
                color: #000 !important;
            }
        }
    </style>
</head>

<body>

    {{-- =========================
         PRINT BUTTON
    ========================== --}}

    <div class="no-print">

        <a href="{{ route('dashboard') }}" class="print-btn">
            ← પાછા જાઓ
        </a>


        <button type="button" class="print-btn" onclick="printBill()">
            🖨️ બિલ બનાવો
        </button>

    </div>


    {{-- =========================
         BILL
    ========================== --}}

    <div class="bill">

        {{-- HEADER --}}

        <div class="bill-header">

            <div class="shop-section">

                <h1 class="shop-name">
                    ESTIMATE
                </h1>
            </div>

            <div class="bill-heading">

                <div class="title">
                    બિલ
                </div>

                <div class="bill-number">
                    # {{ $bill->bill_no }}
                </div>

            </div>

        </div>


        <div class="content">

            {{-- CUSTOMER --}}

            <div class="section-title">
                ગ્રાહકની માહિતી
            </div>

            <div class="customer-card">

                <div class="info-box">

                    <span class="info-label">
                        ગ્રાહકનું નામ
                    </span>

                    <span class="info-value">
                        {{ $bill->customer->name }}
                    </span>

                </div>


                <div class="info-box">

                    <span class="info-label">
                        મોબાઈલ નંબર
                    </span>

                    <span class="info-value">
                        {{ $bill->customer->mobile }}
                    </span>

                </div>


                <div class="info-box">

                    <span class="info-label">
                        બિલ નંબર
                    </span>

                    <span class="info-value">
                        {{ $bill->bill_no }}
                    </span>

                </div>


                <div class="info-box">

                    <span class="info-label">
                        તારીખ
                    </span>

                    <span class="info-value">
                        {{ $bill->created_at->format('d-m-Y') }}
                    </span>

                </div>

            </div>


            {{-- PRODUCTS --}}

            <div class="section-title">
                ખરીદીની વિગતો
            </div>

            <div class="table-wrapper">

                {{-- PRODUCT TABLE --}}
                <table class="product-table">

                    <thead>
                        <tr>
                            <th style="width: 55px;">
                                No
                            </th>

                            <th style="text-align: start">
                                Item
                            </th>

                            <th style="width: 90px;">
                                QTY
                            </th>

                            <th style="width: 120px;">
                                Rate
                            </th>

                            <th style="width: 130px;">
                                Amount
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($bill->items as $index => $item)
                            <tr>

                                <td class="center">
                                    {{ $index + 1 }}
                                </td>

                                <td class="product-name">
                                    {{ $item->product_name }}
                                </td>



                                <td class="center">
                                    {{ number_format($item->qty, 2) }}
                                    {{ $item->type->name ?? '' }}
                                </td>

                                <td class="center">
                                    ₹{{ number_format($item->rate, 2) }}
                                </td>

                                <td class="center">
                                    ₹{{ number_format($item->amount, 2) }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>


                {{-- SUMMARY TABLE --}}
                <table class="summary-table">
                    <tbody>
                        <tr>

                            <td>
                                <span class="summary-label">Items</span>
                                <span class="summary-value">
                                    {{ $bill->items->count() }}
                                </span>
                            </td>

                            <td>
                                <span class="summary-label">Qty</span>
                                <span class="summary-value">
                                    {{ $bill->total_qty }}
                                </span>
                            </td>

                            <td>
                                <span class="summary-label">Total</span>
                                <span class="summary-value">
                                    ₹{{ number_format($bill->total_amount, 2) }}
                                </span>
                            </td>

                        </tr>
                    </tbody>
                </table>

            </div>


            {{-- SUMMARY --}}

            <div class="summary-area">

                <div class="summary">


                    @if ($bill->due_paid_now > 0)
                    <div class="summary-row">

                        <span class="summary-label">
                            બાકીમાંથી ચૂકવેલ
                        </span>

                        <span class="summary-value">
                            ₹{{ number_format($bill->due_paid_now, 2) }}
                        </span>

                    </div>
                @endif

                    @if ($finalOutstanding > 0)
                        <div class="summary-row">

                            <span class="summary-label">
                                કુલ બાકી રકમ
                            </span>

                            <span class="summary-value">
                                ₹{{ number_format($finalOutstanding, 2) }}
                            </span>

                        </div>
                    @endif





                    {{-- <div class="summary-row grand-total">

                        <span class="summary-label">
                            કુલ બાકી રકમ
                        </span>

                        <span class="summary-value">
                            ₹{{ number_format($bill->grand_total, 2) }}
                        </span>

                    </div> --}}

                </div>

            </div>


            {{-- PAYMENT STATUS --}}

            <div class="status-section">

                <span class="status-label">
                    ચુકવણીની સ્થિતિ
                </span>


                @if ($bill->payment_type === 'cash')
                    <span class="status status-cash">

                        <span class="status-dot"></span>

                        રોકડ

                    </span>
                @else
                    <span class="status status-due">

                        <span class="status-dot"></span>

                        બાકી

                    </span>
                @endif

            </div>


            {{-- FOOTER --}}

            <div class="footer">

                <strong>
                    આભાર!
                </strong>

                ફરીથી પધારજો. 🙏

            </div>

        </div>

    </div>


    <script>
        function printBill() {
            window.print();
        }
    </script>

</body>

</html>
