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

        body {
            margin: 0;
            padding: 30px;
            background: #f5f5f5;

            font-family:
                "Noto Sans Gujarati",
                "Nirmala UI",
                "Shruti",
                sans-serif;

            font-size: 16px;
            color: #000;
        }

        .no-print {
            text-align: center;
            margin-bottom: 25px;
        }

        .print-btn {
            padding: 12px 30px;
            border: none;
            border-radius: 6px;
            background: #198754;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .print-btn:hover {
            background: #157347;
        }

        .bill {
            width: 800px;
            max-width: 100%;
            margin: auto;
            padding: 30px;
            background: white;
            border: 1px solid #ddd;
        }

        .company-name {
            text-align: center;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .bill-title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .customer-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px 30px;
            margin-bottom: 20px;
        }

        .info-item {
            padding: 5px 0;
        }

        .label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 9px;
        }

        th {
            text-align: center;
            font-weight: bold;
            background: #f2f2f2;
        }

        td {
            vertical-align: middle;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .total-row td {
            font-weight: bold;
        }

        .payment-status {
            margin-top: 20px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }

        .footer {
            margin-top: 35px;
            text-align: center;
            font-size: 14px;
        }

        @media print {

            @page {
                size: A4;
                margin: 10mm;
            }

            body {
                padding: 0;
                background: white;
            }

            .no-print {
                display: none !important;
            }

            .bill {
                width: 100%;
                max-width: none;
                padding: 0;
                border: none;
            }

            table {
                page-break-inside: avoid;
            }

            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>

    {{-- PRINT BUTTON --}}
    <div class="no-print">

        <button type="button"
                class="print-btn"
                onclick="printBill()">

            PDF બનાવો

        </button>

    </div>


    {{-- BILL --}}
    <div class="bill">


        {{-- SHOP NAME --}}
        <div class="company-name">
            મારી દુકાન
        </div>

        <div class="bill-title">
            બિલ
        </div>


        {{-- CUSTOMER INFORMATION --}}
        <div class="customer-info">

            <div class="info-item">

                <span class="label">
                    ગ્રાહકનું નામ:
                </span>

                {{ $bill->customer->name }}

            </div>


            <div class="info-item">

                <span class="label">
                    મોબાઈલ નંબર:
                </span>

                {{ $bill->customer->mobile }}

            </div>


            <div class="info-item">

                <span class="label">
                    બિલ નંબર:
                </span>

                {{ $bill->bill_no }}

            </div>


            <div class="info-item">

                <span class="label">
                    તારીખ:
                </span>

                {{ $bill->created_at->format('d-m-Y') }}

            </div>

        </div>


        {{-- PRODUCT TABLE --}}
        <table>

            <thead>

                <tr>

                    <th style="width: 60px;">
                        ક્રમ
                    </th>

                    <th>
                        પ્રોડક્ટનું નામ
                    </th>

                    <th style="width: 100px;">
                        જથ્થો
                    </th>

                    <th style="width: 120px;">
                        દર
                    </th>

                    <th style="width: 130px;">
                        રકમ
                    </th>

                </tr>

            </thead>


            <tbody>

                @foreach($bill->items as $index => $item)

                    <tr>

                        <td class="center">
                            {{ $index + 1 }}
                        </td>

                        <td>
                            {{ $item->product_name }}
                        </td>

                        <td class="center">
                            {{ $item->qty }}
                        </td>

                        <td class="right">
                            ₹ {{ number_format($item->rate, 2) }}
                        </td>

                        <td class="right">
                            ₹ {{ number_format($item->amount, 2) }}
                        </td>

                    </tr>

                @endforeach

            </tbody>


            {{-- TOTAL --}}
            <tfoot>

                <tr class="total-row">

                    <td colspan="4" class="right">
                        કુલ જથ્થો
                    </td>

                    <td class="right">
                        {{ $bill->total_qty }}
                    </td>

                </tr>


                <tr class="total-row">

                    <td colspan="4" class="right">
                        કુલ રકમ
                    </td>

                    <td class="right">
                        ₹ {{ number_format($bill->total_amount, 2) }}
                    </td>

                </tr>


                @if($bill->previous_due > 0)

                    <tr>

                        <td colspan="4" class="right">
                            અગાઉની બાકી રકમ
                        </td>

                        <td class="right">
                            ₹ {{ number_format($bill->previous_due, 2) }}
                        </td>

                    </tr>

                @endif


                @if($bill->due_paid_now > 0)

                    <tr>

                        <td colspan="4" class="right">
                            બાકીમાંથી ચૂકવેલ
                        </td>

                        <td class="right">
                            ₹ {{ number_format($bill->due_paid_now, 2) }}
                        </td>

                    </tr>

                @endif


                <tr class="total-row">

                    <td colspan="4" class="right">
                        કુલ બિલ રકમ
                    </td>

                    <td class="right">
                        ₹ {{ number_format($bill->grand_total, 2) }}
                    </td>

                </tr>

            </tfoot>

        </table>


        {{-- PAYMENT STATUS --}}
        <div class="payment-status">

            @if($bill->payment_type === 'cash')

                રોકડ

            @else

                બાકી

            @endif

        </div>


        {{-- FOOTER --}}
        <div class="footer">

            આભાર, ફરીથી પધારજો.

        </div>

    </div>


    <script>

        function printBill() {
            window.print();
        }

    </script>

</body>

</html>