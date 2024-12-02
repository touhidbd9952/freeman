@extends('layouts.admin_master')

@section('content')
 




   <style>
       .table tr th, .table tr td,.borderdiv {border: black solid !important;}
       hr {
            margin: 0 0;
            color: inherit;
            background-color: currentColor;
            border: 0;
            opacity: 1;
            }
        .footer{display: none;} 
        @media print {
        #printDiv{color:#000 !important;}    
        .no-print{
                display : none !important;
                }
                #printDiv{margin-left:-250px;margin-top:80px !important;margin-bootom:0px !important;width:700px;}
                table{border:1 pax solid #ccc;}
                table tr{height: 25px;}
                table tr th,table tr td{height: 25px;font-size:12px;padding:5px !important;color:#000 !important;}
                .w60{width: 50%;}
                .w33{width: 32%;}
                .w0{width: 0%;float: none;}
                p,p span{font-size: 13px !important;margin-bottom: 10px !important;}
                #singing{margin-top: 50px !important;}
                @page {size: auto;   margin: 0mm auto;}
                h1{font-size: 42px !important;}
                h3{font-size: 18px !important;}

       }   
   </style>    
   <script>
       function printInvoice()
        {
            printDiv = "#printDiv"; // id of the div you want to print
            $("*").addClass("no-print");
            $(printDiv+" *").removeClass("no-print");
            $(printDiv).removeClass("no-print");
            var gtotal = document.getElementById('gtotal').value;
            const numberFormatter = Intl.NumberFormat('en-US');
            
            gtotal = numberFormatter.format(gtotal);
            document.getElementById('grandtotal').innerHTML = '¥'+gtotal;
            parent =  $(printDiv).parent();
            while($(parent).length)
            {
                $(parent).removeClass("no-print");
                parent =  $(parent).parent();
            }
            window.print();

        }
   </script>    

<?php 
$grandTotalPrice = 0;
?>
<section  class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
          
        <input type="button" onclick="printInvoice();" value="Print">
      <div class="container" id="printDiv" style="margin-top: 100px;margin-bottom: 100px;" >
        
        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-6 w60" style="display:block"> 
                請求書No:&nbsp;{{$invoiceno}}
            </div>
            <div  class="col-md-6 w60" style="display:block;text-align:right;"> 
                <?php echo $auctionYear.'年'. $auctionMonth.'月'. $auctionDay.'日'?>
            </div>
            
        </div>
        <div class="row" style="margin-bottom: 35px;"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-12" style="display:block;text-align:center;"> 
                <h1 style="margin-bottom: 0px;text-decoration:underline;">請求書</h1>
                <h3>(WOODYオークション  <?php  echo $auctionYear.'年'. $auctionMonth.'月'. $auctionDay.'日';?>)</h3>
            </div>
            
        </div>

        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-3 w33" style="display:block"> 
                <h3 class="borderdiv" style="margin-bottom: 0;border-top:none !important;border-left:none !important;border-right:none !important;">
                    {{$auctionmaxbidderinfo->company_name}}
                </h3>
                
                
                <span style="padding-top: 10px;display:block;">落札社No. {{$auctionmaxbidderinfo->usercodeno}}</span>
                <br><br>
                御請求金額 : <span id="grandtotal"></span>
            </div>
            <div  class="col-md-1 w0" style="display:block">&nbsp;</div>

            <div  class="col-md-4 w33" style="display:block"> 
                FAX No. {{$auctionmaxbidderinfo->fax}}
            </div>

            <div  class="col-md-4 w33" style="display:block"> 
                <div style="float: right;">
                <h3>ウッディー御中</h3>
                phone: +81(0)3-5700-4622<br>
                Fax: +81(0)3-5700-4625<br>
                email: info@woodyltd.com<br>
                </div>
            </div>
        </div>

        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-12" style="display:block"> 
                
                <div class="table-responsive">
                    <table border="1" id="example2" class="table table-striped ">
                        <thead>
                            <tr >
                                <th>LOT番号</th>
                                <th>MODEL-SERIAL</th>
                                <th>落札価格</th>
                                <th>落札料</th>
                                <th>出庫料</th>
                                <th>搬出作業料</th>
                                <th>回送料</th>
                                <th>受渡場所</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                                $total_auction_max_bid_amount = 0;    
                                $total_auction_charge = 0;
                                $total_yard_charge = 0;
                                $total_extra_charge = 0;
                                $total_releasing_charge = 0;  
                                $end_date ="";

                                $count = 0;
                            ?>
                        @foreach($products as $p)
                           <?php    
                            //total before tax calculation
                                $total_auction_max_bid_amount += $p->auction_max_bid_amount !=""?(int)$p->auction_max_bid_amount:0;
                                $total_auction_charge += $p->auction_charge !=""?(int)$p->auction_charge:0;
                                $total_yard_charge += $p->yard_charge !=""?(int)$p->yard_charge:0;
                                $total_extra_charge += $p->extra_charge !=""?(int)$p->extra_charge:0;
                                $total_releasing_charge += $p->releasing_charge !=""?(int)$p->releasing_charge:0 ;
                                $deliveryplace = "";
                                foreach($deliveryplaces as $d)
                                {
                                    if($d->id == $p->delivery_place_id)
                                    { 
                                        $deliveryplace = $d->name_jp !=""? $d->name_jp:$d->name_en;
                                    }
                                }
                                
                           ?>
                           <!----Product data show ---->
                            <tr <?php if($count == (count($products)-1)){?> style="border-bottom: 3px solid #000; width: 100%;"<?php }?> >
                                <td>{{ $p->product_no }}</td>
                                <td>{{ $p->model_no}} {{ $p->serial_no !=""?'-'.$p->serial_no:"" }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->auction_max_bid_amount) }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->auction_charge) }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->yard_charge) }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->extra_charge) }}</td>
                                <td style="text-align: right">¥{{ number_format((int)$p->releasing_charge) }}</td>
                                <td>{{ $deliveryplace}}</td>
                            </tr>
                            <?php $count++;?>
                        @endforeach

                        <!----Total before tax ---->
                        <tr style="border-bottom: 1px solid #000; width: 100%;">
                            <td colspan="2" style="text-align: right;">小計</td>
                            
                            <td style="text-align: right">¥{{number_format($total_auction_max_bid_amount)}}</td>
                            <td style="text-align: right">¥{{number_format($total_auction_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($total_yard_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($total_extra_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($total_releasing_charge)}}</td>
                            <td></td>
                        </tr>

                        <?php 
                                // tax 10% calculation
                                $total_auction_max_bid_amount_tax = ($total_auction_max_bid_amount*10)/100;
                                $total_auction_charge_tax = ($total_auction_charge*10)/100;
                                $total_yard_charge_tax = ($total_yard_charge*10)/100;
                                $total_extra_charge_tax = ($total_extra_charge*10)/100;
                                $total_releasing_charge_tax = ($total_releasing_charge*10)/100;
                        ?>
                        <!----tax amount---->
                        <tr style="border-bottom: 3px solid #000; width: 100%;">
                            <td colspan="2" style="text-align: right;">消費税 (+)</td>
                            
                            <td style="text-align: right">¥{{number_format($total_auction_max_bid_amount_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_auction_charge_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_yard_charge_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_extra_charge_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_releasing_charge_tax)}}</td>
                            <td></td>
                        </tr>
                        <!----Total after tax---->
                        <?php 
                                //total after tax calculation
                                $grandtotal_auction_max_bid_amount = $total_auction_max_bid_amount + $total_auction_max_bid_amount_tax;
                                $grandtotal_auction_charge = $total_auction_charge + $total_auction_charge_tax;
                                $grandtotal_yard_charge = $total_yard_charge + $total_yard_charge_tax;
                                $grandtotal_extra_charge = $total_extra_charge + $total_extra_charge_tax;
                                $grandtotal_releasing_charge = $total_releasing_charge + $total_releasing_charge_tax;

                                $grandTotalPrice = $grandtotal_auction_max_bid_amount + $grandtotal_auction_charge + $grandtotal_yard_charge + $grandtotal_extra_charge + $grandtotal_releasing_charge; 
                           
                           ?>
                        <tr>
                            <td colspan="2" style="text-align: right;">合計</td>
                            
                            <td style="text-align: right">¥{{number_format($grandtotal_auction_max_bid_amount)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_auction_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_yard_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_extra_charge)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_releasing_charge)}}</td>
                            <td ></td>
                        </tr>
                            
                        </tbody>
                        
                    </table>

                    <input type="hidden" id="gtotal" value="{{$grandTotalPrice}}" onchange="setValue({{$grandTotalPrice}})">

                    <p style="color:#206c6c">
                        振込先銀行：三井住友銀行～支店（普通）1234567
                        ユ）ウツデイー  
                    </p>
                    
                    <p style="color:#206c6c">
                        振込み手数料は貴社にてご負担ください  
                    </p>
                    
                    <p style="font-size:24px;"><</span>「振り込み詐欺」にご注意ください <span style="font-size:24px;">> </span> 
                    
                    <p style="color:#206c6c">
                        弊礼では「三井住銀行・～支店」のみを取引銀行口座に指定しております。
                    </p>
                    
                    <p>
                        お支払期限：<span class="borderdiv" style="font-size:18px;font-weight:bold;padding:5px 50px;">
                        <?php 
                        $mod_date = strtotime($enddate."+ 7 days");
                        $payment_year = date("Y",$mod_date);
                        $payment_month = date("m",$mod_date);
                        $payment_day = date("d",$mod_date);
                        echo $payment_year.'年'.$payment_month.'月'.$payment_day.'日（水）まで';
                        ?>
                        
                    </span>  
                    </p>
                    
                    <p>
                        注意： 『受渡場所』からの機械引取り  
                    </p>
                    <p>
                        ● 搬出の場合は必ず前日までに搬出日、回送業者を弊社にご連絡をください。
                          当日連絡は搬出不可もしくは10,000円の「追加料金」がかかります  
                    </p>
                    <p>
                        ● 引取り時、安全に問題があるトラック・ドレーラー等で行かれた場合、及び手配した運送会社が事業用自動車
（緑ナンバー）でない場合は現地での積み込み作業をお断りする場合があります。 
                    </p>
                    <p>
                        ●「未搬入」の場合、入庫状況を弊社までお問い合わせください。※遠隔地からの
                        場合、1〜2週間お時間をいただくことがあります。
                    </p>
                    <p>
                        ●「搬入済」「出展社ヤード」の場合、「支払期限」「支払後7営業日以内の引取り」を厳守してください。
*厳守されない場合は当社での機械の保全は保証できません。 
                    </p>
                    <p>
                    &nbsp;&nbsp;&nbsp; 尚、搬入後15日目から「保管料」がかかります。
                    </p>

                    <p>
                        次回WOODYオークションは10月21日（木）18:00終了です<br>
                        次回のご参加をお待ちしております 
                    <div id="singing" class="borderdiv" style="width: 230px;height:2px;float: right;border-top:none !important;border-left:none !important;border-right:none !important;">
                        &nbsp;
                    </div>
                    </p>                     
                    
                    
                    

                </div>


            </div>

            

        </div>
      </div>
      </section>
      </section>
  </div>
  </div>
</section>

<script>
    function setValue(gvalue)
    {
       // alert(gvalue);
        //document.getElementById('totalinvoicecharge').innerHTML = gvalue;
    }
</script> 
<script>
    //document.getElementById('gtotal').value;
    
    var myObject = new Vue({
      el: '#app',
      data: {totalinvoicecharge: '123'}
    })
    </script>   





  @endsection