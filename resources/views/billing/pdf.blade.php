<!DOCTYPE html>
<html lang="gu">

<head>
    <meta charset="UTF-8">
    <title>બિલ</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f5f5f5;
            padding: 20px;
        }

        .bill {
            width: 300px;
            margin: auto;
            background: #fff;
            border: 1px solid #ddd;
            padding: 12px;
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #999;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }

        .header h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 12px;
            line-height: 18px;
        }

        .info {
            font-size: 12px;
            margin-bottom: 10px;
            line-height: 22px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th {
            border-bottom: 1px solid #000;
            padding: 5px 0;
            text-align: left;
        }

        td {
            padding: 5px 0;

        }

        .right {
            text-align: right;
        }

        .total {
            margin-top: 10px;
            border-top: 1px solid #000;
            padding-top: 8px;
            font-size: 13px;
        }

        .total div {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }

        .grand {
            font-weight: bold;
            font-size: 15px;
        }

        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 11px;
            border-top: 1px dashed #999;
            padding-top: 10px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .invoice-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .payment-badge {
            padding: 2px 10px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: bold;
        }

        .payment-badge.due {
            background: #FFD54F;
            color: #000;
        }

        .payment-badge.cash {
            background: #28A745;
            color: #fff;
        }

        .invoice-row {
            width: 100%;
            overflow: hidden;
            /* clearfix */
            margin-bottom: 8px;
            font-size: 12px;
        }

        .invoice-row span:first-child {
            float: left;
        }

        .invoice-row .badge {
            float: right;
            padding: 2px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }

        .badge.due {
            background: #ff382a;
            color: #000;
        }

        .badge.cash {
            background: #28A745;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="bill">
        <!-- ================= HEADER ================= -->
        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom: 14px;">

            <tr>
                <!-- Business Information -->
                <td
                    style="
            width: 65%;
            vertical-align: top;
            padding: 0 0 8px 0;
        ">

                    <div
                        style="
                font-size: 19px;
                font-weight: bold;
                color: #1f2937;
                margin-bottom: 4px;
            ">
                        Billing System
                    </div>

                    <div
                        style="
                font-size: 10px;
                color: #6b7280;
                line-height: 1.6;
            ">
                        નડિયાદ, ગુજરાત
                    </div>

                    <div style="
                font-size: 10px;
                color: #6b7280;
            ">
                        મો. : ૯૮૭૬૫૪૩૨૧૦
                    </div>

                </td>

                <!-- Invoice Information -->
                <td
                    style="
            width: 35%;
            text-align: right;
            vertical-align: top;
        ">

                    <div
                        style="
                font-size: 9px;
                color: #6b7280;
                margin-bottom: 2px;
            ">
                        બિલ નં.
                    </div>

                    <div
                        style="
                font-size: 13px;
                font-weight: bold;
                color: #111827;
            ">
                        {{ $bill->bill_no }}
                    </div>

                    <div
                        style="
                margin-top: 5px;
                padding: 4px 9px;
                font-size: 9px;
                font-weight: bold;
                color: {{ $bill->payment_type == 'due' ? '#9A6700' : '#166534' }};
                background-color: {{ $bill->payment_type == 'due' ? '#FFF7D6' : '#DCFCE7' }};
            ">
                        {{ $bill->payment_type == 'due' ? 'બાકી' : 'રોકડ' }}
                    </div>

                </td>
            </tr>

        </table>


        <!-- ================= CUSTOMER INFO ================= -->

        <table width="100%" cellpadding="0" cellspacing="0"
            style="
        border-collapse: collapse;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        margin-bottom: 15px;
    ">

            <tr>

                <!-- Date -->
                <td
                    style="
            width: 33.33%;
            padding: 9px 10px;
            border-right: 1px solid #e2e8f0;
            vertical-align: top;
        ">

                    <div
                        style="
                font-size: 9px;
                color: #64748b;
                margin-bottom: 3px;
            ">
                        તારીખ
                    </div>

                    <div
                        style="
                font-size: 10.5px;
                font-weight: bold;
                color: #1e293b;
            ">
                        {{ $bill->created_at->format('d-m-Y') }}
                    </div>

                </td>


                <!-- Customer Name -->
                <td
                    style="
            width: 33.33%;
            padding: 9px 10px;
            border-right: 1px solid #e2e8f0;
            vertical-align: top;
        ">

                    <div
                        style="
                font-size: 9px;
                color: #64748b;
                margin-bottom: 3px;
            ">
                        નામ
                    </div>

                    <div
                        style="
                font-size: 10.5px;
                font-weight: bold;
                color: #1e293b;
            ">
                        {{ $bill->customer->name }}
                    </div>

                </td>


                <!-- Mobile -->
                <td
                    style="
            width: 33.33%;
            padding: 9px 10px;
            vertical-align: top;
        ">

                    <div
                        style="
                font-size: 9px;
                color: #64748b;
                margin-bottom: 3px;
            ">
                        મોબાઇલ
                    </div>

                    <div
                        style="
                font-size: 10.5px;
                font-weight: bold;
                color: #1e293b;
            ">
                        {{ $bill->customer->mobile }}
                    </div>

                </td>

            </tr>

        </table>



        <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-top: 15px;">

            <thead>
                <tr>
                    <th
                        style="
                padding: 10px 8px;
                text-align: left;
                background-color: #f4f6f8;
                border-top: 1px solid #d9dee5;
                border-bottom: 1px solid #cfd5dc;
                font-size: 11px;
                color: #343a40;
            ">
                        વસ્તુ
                    </th>

                    <th
                        style="
                padding: 10px 8px;
                width: 70px;
                text-align: right;
                background-color: #f4f6f8;
                border-top: 1px solid #d9dee5;
                border-bottom: 1px solid #cfd5dc;
                font-size: 11px;
                color: #343a40;
            ">
                        નંગ
                    </th>

                    <th
                        style="
                padding: 10px 8px;
                width: 110px;
                text-align: right;
                background-color: #f4f6f8;
                border-top: 1px solid #d9dee5;
                border-bottom: 1px solid #cfd5dc;
                font-size: 11px;
                color: #343a40;
            ">
                        રકમ
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($bill->items as $item)
                    <tr>

                        {{-- Product --}}
                        <td
                            style="
                    padding: 9px 8px;
                    border-bottom: 1px dashed #d5d9de;
                    color: #252525;
                    font-size: 10.5px;
                ">
                            {{ $item->product_name }}
                        </td>

                        {{-- Quantity --}}
                        <td
                            style="
                    padding: 9px 8px;
                    text-align: right;
                    border-bottom: 1px dashed #d5d9de;
                    color: #333333;
                    font-size: 10.5px;
                ">
                            {{ $item->qty }}
                        </td>

                        {{-- Amount --}}
                        <td
                            style="
                    padding: 9px 8px;
                    text-align: right;
                    border-bottom: 1px dashed #d5d9de;
                    color: #222222;
                    font-size: 10.5px;
                    font-weight: bold;
                ">
                            ₹{{ number_format($item->amount, 2) }}
                        </td>

                    </tr>
                @endforeach
            </tbody>

        </table>

        <!-- Invoice Summary -->
        <table width="100%" cellpadding="0" cellspacing="0" style="margin-top: 18px; border-collapse: collapse;">

            <!-- Summary Header -->
            <tr>
                <td colspan="2"
                    style="
                        padding: 9px 12px;
                        background-color: #f5f7fa;
                        border-bottom: 1px solid #d9dee5;
                        font-size: 11px;
                        font-weight: bold;
                        color: #343a40;
                     ">
                    બિલનો સારાંશ
                </td>
            </tr>

            <!-- Total Quantity -->
            <tr>
                <td
                    style="
                           padding: 8px 12px;
                           border-bottom: 1px solid #eeeeee;
                           color: #666666;
                     ">
                    કુલ નંગ
                </td>

                <td
                    style="
                        padding: 8px 12px;
                        border-bottom: 1px solid #eeeeee;
                        text-align: right;
                        font-weight: bold;
                        color: #222222;
                  ">
                    {{ $bill->total_qty }}
                </td>
            </tr>

            <!-- Total Amount -->
            <tr>
                <td
                    style="
                           padding: 8px 12px;
                           border-bottom: 1px solid #eeeeee;
                           color: #666666;
                     ">
                    કુલ રકમ
                </td>

                <td
                    style="
                           padding: 8px 12px;
                           border-bottom: 1px solid #eeeeee;
                           text-align: right;
                           font-weight: bold;
                           color: #222222;
                     ">
                    ₹{{ number_format($bill->total_amount, 2) }}
                </td>
            </tr>

            <!-- Grand Total -->
            <tr>
                <td
                    style="
            padding: 11px 12px;
            background-color: #f0fdf4;
            color: #16803c;
            font-weight: bold;
            font-size: 12px;
            border-top: 1px solid #d6f0df;
            border-bottom: 1px solid #d6f0df;
        ">
                    ચૂકવવાની કુલ રકમ
                </td>

                <td
                    style="
            padding: 11px 12px;
            background-color: #f0fdf4;
            color: #139732;
            font-weight: bold;
            font-size: 13px;
            text-align: right;
            border-top: 1px solid #d6f0df;
            border-bottom: 1px solid #d6f0df;
        ">
                    ₹{{ number_format($bill->grand_total, 2) }}
                </td>
            </tr>

            @if ($bill->due_paid_now > 0)
                <!-- Paid Today -->
                <tr>
                    <td
                        style="
                padding: 9px 12px;
                color: #555555;
                border-bottom: 1px solid #eeeeee;
            ">
                        આજે ચૂકવેલ બાકી રકમ
                    </td>

                    <td
                        style="
                padding: 9px 12px;
                text-align: right;
                color: #333333;
                font-weight: bold;
                border-bottom: 1px solid #eeeeee;
            ">
                        ₹{{ number_format($bill->due_paid_now, 2) }}
                    </td>
                </tr>
            @endif

            <!-- Balance Due -->
            <tr>
                <td
                    style="
            padding: 11px 12px;
            background-color: #fff5f5;
            color: #d92d20;
            font-weight: bold;
            font-size: 12px;
        ">
                    કુલ બાકી
                </td>

                <td
                    style="
            padding: 11px 12px;
            background-color: #fff5f5;
            color: #ff1909;
            font-weight: bold;
            font-size: 13px;
            text-align: right;
        ">
                    ₹{{ number_format($bill->customer->balance_due, 2) }}
                </td>
            </tr>

        </table>

        <div class="footer">
            <strong>આપનો ખૂબ ખૂબ આભાર</strong><br>
            ફરીથી જરૂર પધારશો.
        </div>


    </div>
</body>

</html>
