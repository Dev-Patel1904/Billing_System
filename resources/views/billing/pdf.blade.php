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
      <div class="header">
         <h2>Billing System</h2>

         <p>નડિયાદ, ગુજરાત</p>
         <p>મો. : ૯૮૭૬૫૪૩૨૧૦</p>

      </div>

      <div class="info">
         <table style="width:100%; border-collapse:collapse; margin-bottom:8px;">
            <tr>
               <td style="text-align:left; font-size:12px;">
                  <strong>બિલ નં. :</strong>
                  <div><strong>બિલ નં. :</strong> {{ $bill->bill_no }}</div>
               </td>
               <td style="text-align:right;">
                  <span style="

                      color:{{ $bill->payment_type == 'due' ? '#F4B400' : '#28A745' }};

                  ">
                      <strong>{{ $bill->payment_type == 'due' ? 'બાકી' : 'રોકડ' }}</strong>
                  </span>
              </td>
            </tr>
         </table>

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





         <div class="grand">
            <span>ચૂકવવાની કુલ રકમ</span>
            <span>₹{{ number_format($bill->grand_total, 2) }}</span>
         </div>

         <hr>
         @if ($bill->due_paid_now > 0)
         <div>
            <span>આજે ચૂકવેલ બાકી રકમ :</span>
            <span style="color: #139732">₹{{ number_format($bill->due_paid_now, 2) }}</span>
         </div>
         @endif


         <div style="margin-top:12px;">
            <span><strong>કુલ બાકી :</strong></span>
            <span style="color: #ff1909; font-weight:bold;">₹{{ number_format($bill->customer->balance_due, 2) }}</span>
         </div>
      </div>

      <div class="footer">
         <strong>આપનો ખૂબ ખૂબ આભાર</strong><br>
         ફરીથી જરૂર પધારશો.
      </div>


   </div>
</body>

</html>
