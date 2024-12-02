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
                #no-print-eye{
                    display: none;
                    color : #fff !important;
                    background: #fff;
                }
                #printDiv{margin-left:-250px;margin-top:80px !important;margin-bootom:0px !important;width:700px;}
                table{border:1 pax solid #ccc;}
                table tr{height: 25px;}
                table tr th,table tr td{height: 25px;font-size:12px;padding:5px !important;color:#000 !important;}
                .table-bordered > :not(caption) > * > * {
                border-width: 0 0px;
                    border-left-width: 0px;
                }
                .w60{width: 50%;}
                .w33{width: 32%;}
                .w0{width: 0%;float: none;}
                p,p span{font-size: 13px !important;margin-bottom: 10px !important;}
                #singing{margin-top: 50px !important;}
                @page {size: auto;   margin: 0mm auto;}
                h1{font-size: 32px !important;}
                h3{font-size: 16px !important;}

       }   
   </style>    
   <script>
       function printInvoice()
        {
            printDiv = "#printDiv"; // id of the div you want to print
            $("*").addClass("no-print");
            $(printDiv+" *").removeClass("no-print");
            $(printDiv).removeClass("no-print");
            //var gtotal = document.getElementById('gtotal').value;
            //const numberFormatter = Intl.NumberFormat('en-US');
            
            //gtotal = numberFormatter.format(gtotal);
            //document.getElementById('grandtotal').innerHTML = '¥'+gtotal;
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
<section id="app" class="section section-md bg-white">
  <div class="shell shell-wide wow fadeInUpSmall divsize" data-wow-offset="150" style="margin-left: 0px;margin-right:0px;">
  <div class="cat-items-grid">
  <section id="home" class="home-page-content page-content">
      <section class="products-section">
        <input type="button" onclick="printInvoice();" value="Print">
      <div class="container" id="printDiv" style="margin-top: 100px;margin-bottom: 100px;" >
        
        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-6 w60" style="display:block"> 
                文払書No.:&nbsp;{{$invoiceno}}
            </div>
            <div  class="col-md-6 w60" style="display:block;text-align:right;"> 
                  
                <?php echo $auctionYear.'年'. $auctionMonth.'月'. $auctionDay.'日'?>
            </div>
            
        </div>
        <div class="row" style="margin-bottom: 35px;"> 
            <!---======== Customer Invoice =========---->
            <div  class="col-md-12" style="display:block;text-align:center;"> 
                <h1 style="margin-bottom: 0px;text-decoration:underline;">WOODYオークション計算書</h1>
                <h3>(WOODYオークション  <?php echo $auctionYear.'年'. $auctionMonth.'月'. $auctionDay.'日 終了分'?>)</h3>
            </div>
            
        </div>

        <div class="row"> 
            <!---======== Customer Invoice =========---->
            <?php 
            $ownername ="";
            if($auctionproductownerinfo->name_jp !="")
            {
                $ownername = $auctionproductownerinfo->name_jp;
            }
            else if($auctionproductownerinfo->name_en !="")
            {
                $ownername = $auctionproductownerinfo->name_en;
            }
            ?>

            <?php 
            $companyname ="";
            if($auctionproductownerinfo->company_name_jp !="")
            {
                $companyname = $auctionproductownerinfo->company_name_jp;
            }
            else if($auctionproductownerinfo->company_name_en !="")
            {
                $companyname = $auctionproductownerinfo->company_name_en;
            }
            else if($auctionproductownerinfo->name_jp !="")
            {
                $companyname = $auctionproductownerinfo->name_jp;
            }
            else if($auctionproductownerinfo->name_en !="")
            {
                $companyname = $auctionproductownerinfo->name_en;
            }
            ?>
            <div  class="col-md-3 w33" style="display:block"> 
                
                <h3 style="margin-bottom: 0;text-decoration: underline;">{{$companyname}}</h3>
                
                
                <span style="padding-top: 10px;display:block;">出展社No. {{$auctionproductownerinfo->usercodeno}}</span>
                <br><br>
               &nbsp;
            </div>
            <div  class="col-md-1 w0" style="display:block">&nbsp;</div>

            <div  class="col-md-4 w33" style="display:block"> 
                FAX No. {{$auctionproductownerinfo->fax}}
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
                
                <div>
                    <div class="table-responsive" style="margin-bottom: 10px;">
                    <table  id="example2" class="table table-striped " style="margin-bottom: 0px;">
                        <thead>
                            <tr>
                                <th colspan="4">&nbsp;</th>
                                
                                <th colspan="4" style="text-align: center;border-left:1px solid #ccc;">請求金額 (2)</th>
                            </tr>
                            <tr >
                                <th>LOT NO.</th>
                                <th>MODEL-SERIAL</th>
                                <th>受渡場所</th>
                                <th>成約価格 (1)</th>
                                <th>売買手数料</th>
                                <th>出展料</th>
                                <th>点検費用</th>
                                <th>その他費用</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $total_auction_max_bid_amount = 0;    
                                $total_commission = 0;
                                $total_entry_fees = 0;
                                $total_inspection_fees = 0;
                                $total_others_fees = 0;  

                                $count = 0;
                            ?>
                        @foreach($products as $p)
                           <?php 
                            //total before tax calculation
                                $total_auction_max_bid_amount += (int)$p->auction_max_bid_amount !=""?(int)$p->auction_max_bid_amount:0;

                                if((int)$p->auction_max_bid_amount >= 400000 && (int)$p->auction_max_bid_amount <= 4000000)
                                {
                                    $commissionpercent = 5; //5 percent
                                    $total_commission += ((int)$p->auction_max_bid_amount*(int)$commissionpercent)/100;
                                }
                                else if((int)$p->auction_max_bid_amount > 4000000 && (int)$p->auction_max_bid_amount <= 10000000)
                                {
                                    $commissionpercent = 4; //4 percent
                                    $total_commission += ((int)$p->auction_max_bid_amount*(int)$commissionpercent)/100;
                                }
                                else if((int)$p->auction_max_bid_amount > 10000000)
                                {
                                    $commissionpercent = 3; //3 percent
                                    $total_commission += ((int)$p->auction_max_bid_amount*(int)$commissionpercent)/100;
                                }
                                else 
                                {
                                    $total_commission += 20000;
                                }
                                //$total_commission += $p->auction_max_bid_amount !=""?((int)$p->auction_max_bid_amount*$commissionpercent)/100:0;
                                $total_entry_fees += $p->entry_fee !=""?(int)$p->entry_fee:0;
                                $total_inspection_fees += $p->inspection_fee !=""?(int)$p->inspection_fee:0;
                                $total_others_fees += $p->other_fee !=""?(int)$p->other_fee:0 ;
                           ?>
                           <!----Product data show ---->
                            <tr <?php if($count == count($products)-1){?> style="border-bottom: 3px solid #000; width: 100%;"<?php }?> >
                                <td>{{ $p->product_no }}</td>
                                <td>
                                    {{ $p->model_no}} {{ $p->serial_no !=""?'-'.$p->serial_no:"" }}
                                    <a href="{{url('product/details_view/'.$p->id)}}" id="no-print-eye" target="_blank" style="float: right;">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </td>
                                <td>{{ $p->delivery_place }}</td>
                                <td style="text-align: right;border-left:1px solid #ccc;">¥{{ number_format((int)$p->auction_max_bid_amount) }}</td>
                                <td style="text-align: right">
                                    <?php 
                                    if((int)$p->auction_max_bid_amount !="" || (int)$p->auction_max_bid_amount !=0)
                                    {
                                        if((int)$p->auction_max_bid_amount >= 400000 && (int)$p->auction_max_bid_amount <= 4000000)
                                        {
                                            $commissionpercent = 5;
                                            echo '¥';
                                            echo ((int)$p->auction_max_bid_amount*$commissionpercent)/100;
                                        }
                                        else if((int)$p->auction_max_bid_amount > 4000000 && (int)$p->auction_max_bid_amount <= 10000000)
                                        {
                                            $commissionpercent = 4; //4 percent
                                            echo '¥';
                                            echo ((int)$p->auction_max_bid_amount*$commissionpercent)/100;
                                        }
                                        else if((int)$p->auction_max_bid_amount > 10000000)
                                        {
                                            $commissionpercent = 3; //3 percent
                                            echo '¥';
                                            echo ((int)$p->auction_max_bid_amount*$commissionpercent)/100;
                                        }
                                        else 
                                        {
                                            echo "¥20000";
                                        }
                                    }
                                    else {
                                        echo '¥0';
                                    }
                                    ?>
                                    
                                </td>
                                <td style="text-align: right">¥{{ number_format($p->entry_fee !=""?(int)$p->entry_fee:0) }}</td>
                                <td style="text-align: right">¥{{ number_format($p->inspection_fee !=""?(int)$p->inspection_fee:0) }}</td>
                                <td style="text-align: right">¥{{ number_format($p->other_fee !=""?(int)$p->other_fee:0) }}</td>
                                
                            </tr>
                            <?php $count++;?>
                        @endforeach

                        <!----Total before tax ---->
                        <tr style="border-bottom: 1px solid #000; width: 100%;">
                            <td colspan="3" style="text-align: right;">小計</td>
                            
                            <td style="text-align: right;border-left:1px solid #ccc;">¥{{number_format($total_auction_max_bid_amount)}}</td>
                            <td style="text-align: right">¥{{number_format($total_commission)}}</td>
                            <td style="text-align: right">¥{{number_format($total_entry_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($total_inspection_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($total_others_fees)}}</td>
                            
                        </tr>

                        <?php 
                                // tax calculation
                                $total_auction_max_bid_amount_tax = ($total_auction_max_bid_amount*10)/100;
                                $total_commission_tax = ($total_commission*10)/100;
                                $total_entry_fees_tax = ($total_entry_fees*10)/100;
                                $total_inspection_fees_tax = ($total_inspection_fees*10)/100;
                                $total_others_fees_tax = ($total_others_fees*10)/100;
                        ?>
                        <!----tax amount---->
                        <tr style="border-bottom: 3px solid #000; width: 100%;">
                            <td colspan="3" style="text-align: right;">消費税 (+)</td>
                            
                            <td style="text-align: right;border-left:1px solid #ccc;">¥{{number_format($total_auction_max_bid_amount_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_commission_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_entry_fees_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_inspection_fees_tax)}}</td>
                            <td style="text-align: right">¥{{number_format($total_others_fees_tax)}}</td>
                            
                        </tr>
                        <!----Total after tax---->
                        <?php 
                                //total after tax calculation
                                $grandtotal_auction_max_bid_amount = $total_auction_max_bid_amount + $total_auction_max_bid_amount_tax;

                                $grandtotal_commission_fees = $total_commission + $total_commission_tax;
                                $grandtotal_entry_fees = $total_entry_fees + $total_entry_fees_tax;
                                $grandtotal_inspection_fees = $total_inspection_fees + $total_inspection_fees_tax;
                                $grandtotal_others_fees = $total_others_fees + $total_others_fees_tax;

                                $grandTotalCharge = $grandtotal_commission_fees + $grandtotal_entry_fees + $grandtotal_inspection_fees + $grandtotal_others_fees; 
                                $totalOwnerAmountFromProductSale = $grandtotal_auction_max_bid_amount - $grandTotalCharge;
                           ?>
                        <tr>
                            <td colspan="3" style="text-align: right;">合計</td>
                            
                            <td style="text-align: right;border-left:1px solid #ccc;">¥{{number_format($grandtotal_auction_max_bid_amount)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_commission_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_entry_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_inspection_fees)}}</td>
                            <td style="text-align: right">¥{{number_format($grandtotal_others_fees)}}</td>
                            
                        </tr>
                            
                        </tbody>
                        
                    </table>
                    </div>

                    <input type="hidden" id="gtotal" value="{{$grandTotalPrice}}" onchange="setValue({{$grandTotalPrice}})">

                    <p>
                        ※書類（車検証・譲渡証・委任状等）のある機械については、弊社にて書類受領後の
                        お支払となります。
                    </p>
                    
                    <div style="width: 100%;text-align:center;margin-bttom:10px;">
                        <div style="float: left;">
                            <div style="float: right; width: 45px;text-align:center;height: 40px;">
                                <span style="font-size: 32px;margin-top: 10px;display:block;">-</span>
                            </div>
                            <div class="borderdiv" style="width: 180px;float: right;border-top:none !important;">
                                <div class="borderdiv" style="width: 100%;border-bottom: 1px solid #000;border-left:none !important;border-right:none !important;">成約価格計(1)</div>
                            
                                ¥{{number_format($grandtotal_auction_max_bid_amount)}}
                            </div>
                            
                        </div>		
                        <div style="float: left;">
                            <div class="borderdiv" style="width: 180px;float: left;border-top:none !important;">
                                <div class="borderdiv" style="width: 100%;border-bottom: 1px solid #000;border-left:none !important;border-right:none !important;">請求金額計(2)</div>
                                ¥{{number_format($grandTotalCharge)}}
                            </div>
                        </div>	

                        <div style="float: left;">
                            <div style="float: left; width: 25px;text-align:center;height: 40px;margin-right:10px;">
                                <span style="font-size: 32px;margin-top: 10px;display:block;">=</span>
                            </div>
                            <div class="borderdiv" style="width: 180px;float: left;border-top:none !important;">
                                <div class="borderdiv" style="width: 100%;border-bottom: 1px solid #000;border-left:none !important;border-right:none !important;">お支払金額</div>
                                ¥{{number_format($totalOwnerAmountFromProductSale)}}
                            </div>
                        </div>
                    </div>

                    <div class="borderdiv" style="width: 100%;border:1px solid #000;padding:10px;float: left;margin-top:15px;">
                    <p style="width: 100%;text-align:center;">
                        御社よりの「ご請求書」
                    </p>

                    <p>
                        *本計算書をもって、御社よりの「ご請求書」とさせていただいております。
                        <br>
                        上記機械につき、盗難品・遺失物でない事、及び第三者に対する残債務、譲渡担保・質権等の担保権の
                        設定がないことをご確認のうえ、下記に会社名、住所をご記入、捺印後ファックスにてご返送下さい。
                    </p>
                    <p>
                        ※落札機械の搬入についてお願い：必ず搬入前日までに弊社まで搬入予定をご連
                        絡下さい。
                    </p>
                    
                    <div style="width: 100%;float: left;">
                    <div class="borderdiv" style="width: 50%;height:150px;border:1px solid #000;float: left;">
                        <p>
                            <br>
                            &nbsp;&nbsp;御社名<br>
                                <span style="padding-left: 60px">WOODY NARITA YARD</span><br>
                            &nbsp;&nbsp;ご住所 <br>
                            <span style="padding-left: 60px">〒286-0212 千葉県富里市十倉40</span>
                            <br>
                        </p>
                    </div>
                    
                    <div class="borderdiv" style="width: 50%;height:150px;border:1px solid #000;float: right;border-left:none !important;">
                        <p>
                            <br>
                            &nbsp;&nbsp;☆<span style="padding-left: 10px">ご登録の取引口座へお支払致します。</span><br>
                            &nbsp;&nbsp;☆<span style="padding-left: 10px">未登録の場合にはお手数ですがご連絡下さい。</span><br>
                            <span style="padding-left: 20px">「取引口座登録用紙」をお送り致します。</span>
                            <br>
                        </p>
                    </div>
                    </div>


                    <div style="padding-top: 20px;width:100%;text-align:center;float: left;"> WOODYオークションに参加頂き有難うございます。次回のご参加をお待ちしてお
                        ります。
                    </div>
                    
                    </div>
                    
                    

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