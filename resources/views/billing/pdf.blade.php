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
            border-bottom: 1px dashed #ccc;
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
    </style>
</head>

<body>
    <div class="bill">
        <div class="header">
            <h2>Billing System</h2>
            {{-- <p>તમારું સરનામું, ગુજરાત</p> --}}
        </div>

        <div class="info">
            <div><strong>બિલ નં. :</strong> {{ 'INV' . str_pad($bill->id, 6, '0', STR_PAD_LEFT) }}</div>
            <div><strong>તારીખ :</strong> {{ $bill->created_at->format('d-m-Y') }}</div>
            <div><strong>ગ્રાહક :</strong> {{ $bill->customer->name }}</div>
            <div><strong>મોબાઇલ :</strong> {{ $bill->customer->mobile }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>વસ્તુ</th>
                    <th class="right">જથ્થો</th>
                    <th class="right">રકમ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bill->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td class="right">{{ $item->qty }}</td>
                        <td class="right">₹{{ number_format($item->amount, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            <div>
                <span>કુલ જથ્થો :</span>
                <span>{{ $bill->total_qty }}</span>
            </div>
            <div>
                <span>કુલ રકમ :</span>
                <span>₹{{ number_format($bill->total_amount, 2) }}</span>
            </div>



            @if ($bill->due_paid_now > 0)
                <div>
                    <span>આજે ચૂકવેલ બાકી રકમ :</span>
                    <span>₹{{ number_format($bill->due_paid_now, 2) }}</span>
                </div>
            @endif

            <div class="grand">
                <span>ચૂકવવાની કુલ રકમ</span>
                <span>₹{{ number_format($bill->grand_total, 2) }}</span>
            </div>

            <div style="margin-top:8px; font-size:11px;">
                <span>પ્રકાર :</span>
                <span>{{ $bill->payment_type === 'due' ? 'બાકી' : 'રોકડ' }}</span>
            </div>
        </div>

        <div class="footer">
            <strong>🙏 આપનો ખૂબ ખૂબ આભાર 🙏</strong><br>
            ફરીથી જરૂર પધારશો.
        </div>
        <div style="margin-top:12px; font-size:12px; text-align:left;">
            <strong>કુલ બાકી :</strong>
            ₹{{ number_format($bill->customer->balance_due, 2) }}
        </div>

    </div>
</body>

</html>
