<!DOCTYPE html>
<html lang="en" >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
       <style>
        body { margin: 0; font-size: 18px; font-family: "Arrial Narrow";}
            /** Define the margins of your page **/
            @page {
                margin: 100px 55px;
            }

            header {
                position: fixed;
                top: -75px;
                left: 0px;
                right: 0px;
                height: 60px;
                /** Extra personal styles **/

                color: white;
                text-align: center;
                line-height: 65px;
            }

            footer {
                position: fixed;
                bottom: -75px;
                text-align: center;
            }

            table {
              width: 100%;
              border-collapse: collapse;
            }
            h1 {
              border-bottom-style: solid;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
          <div class="row justify-content-center">
            <div class="col-md-12">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr><td width="14%" valign="top" align="left"><img src="dist/img/jist_logo.jpeg"/></td>
                  <td valign="middle"><font size="6"><b><p>&nbsp;</b></font><br/>
                    <font size="4">House 5(1st Floor), Road 17/A, Sector:12, Uttara Model Town,
                    <br/>Dhaka-1230, Bangladesh, Phone: 0088 02 55086938 / 55086939<br/>
                    Phone : 01313-772676<br/>
                    Email: jistlifecare@gmail.com</font></p></td>
                  <td valign="middle" align="right"><font size="4"><b>Customer Statement <br/> Date:
                  {{date('d-m-Y',strtotime($fromdate))}} To {{date('d-m-Y',strtotime($todate))}}</b></font></td>
                </tr>
              </table>
            </div>
          </div>
        </header>
        <main>
        <p>
           <div class="row justify-content-center">
            <div class="col-md-12">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">{{__('Date')}}</th>
                        <th scope="col" class="text-center">{{__('Invoice')}}</th>
                        <th scope="col" class="text-center">{{__('Customer')}}</th>
                        <th scope="col" class="text-center">{{__('Subtotal')}}</th>
                        <th scope="col" class="text-center">{{__('Invoicer Discount')}}</th>
                        <th scope="col" class="text-center">{{__('Total')}}</th>
                        <th scope="col" class="text-center">{{__('Paid Amount')}}</th>
                        <th scope="col" class="text-center">{{__('Invoice Due')}}</th>
                    </tr>
                </thead>
                @php
                    $total=0;
                    $totalDiscount=0;
                    $payableTotal=0;
                    $paidTotal=0;
                    $dueTotal=0;    
                @endphp
                <tbody>
                    @foreach ($dataList as $key=>$data)
                    @php
                        $total = $data->grand_total;
                        $totalDiscount = $data->invoice_discount;
                        $payableTotal = $data->payable_total;
                        $paidTotal = $data->paid_amount;
                        $dueTotal = $data->due_amount;
                    @endphp
                    <tr>
                        <td>{{$key+1}}</td>
                        <td class="text-bold-500 text-center">{{$data->invoice_date}}</td>
                        <td class="text-center">{{$data->invoice_no}}</td>
                        <td class="text-center">{{$data?->customer->name}}</td>
                        <td class="text-center">{{number_format($data->grand_total,2)}}</td>
                        <td class="text-center">{{number_format($data->invoice_discount,2)}}</td>
                        <td class="text-center">{{number_format($data->payable_total,2)}}</td>
                        <td class="text-center">{{number_format($data->paid_amount,2)}}</td>
                        <td class="text-center">{{number_format($data->due_amount,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <th colspan="4"></th>
                    <th class="text-center">{{number_format($total,2)}}</th>
                    <th class="text-center">{{number_format($totalDiscount,2)}}</th>
                    <th class="text-center">{{number_format($payableTotal,2)}}</td>
                    <th class="text-center">{{number_format($paidTotal,2)}}</th>
                    <th class="text-center">{{number_format($dueTotal,2)}}</th>
                </tfoot>
            </div>
            </div>
        </p>
        </main>
    </body>
</html>
