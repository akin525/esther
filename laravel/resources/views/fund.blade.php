@include('layouts.sidebar')
<div class="hk-pg-wrapper">
    <div class="container mt-xl-50 mt-sm-30 mt-15">
        <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <!--                                        <h4 class="font-weight-bold mb-0">--><?php //echo $name; ?><!--</h4>-->
                </div>
            </div>
            <!--                    <div class="col-xl-9 col-md-8">-->
            <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                    <div class="card-body py-0 px-0 px-sm-3">

                    </div>
                </div>
            </div>
            <br>

            <br>
            <div class="card">
                <div class="card-body">
                    <br>
                    <br>
                    @foreach($data2 as $data)
                        <div class='alert alert-success'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <i class='fa fa-ban-circle'></i><strong>Notification: </br></strong><b class='align-content-center'>Note that ₦{{$data->charges}} will be charged On every Funding</b></div>

                        <div class='alert alert-success'>
                            <button type='button' class='close' data-dismiss='alert'>&times;</button>
                            <i class='fa fa-ban-circle'></i><strong>Notification: </br></strong><b class='align-content-center'>Note that ₦{{$data->len}}  is the Minimum Funding Amount</b></div>
                </div>
            </div>



            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title"><i class="mdi mdi-wallet"></i>Wallet Balance</h4>
                            <div class="wallet-details">
                                <!--                                <span>Wallet Balance</span>-->
                                <h3>NGN {{$user->wallet}}</h3>
                                <div class="d-flex justify-content-between my-4">
                                </div>
                                <div class="wallet-progress-chart">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Enter Amount Below</h4>
                            <!--                        --><?php
                            //                        if($_SERVER['REQUEST_METHOD'] == 'POST'){
                            //
                            //                            $amou=intval(mysqli_real_escape_string($con,$_POST['amount']));
                            //
                            //                            print "
                            //                    <script>
                            //                        window.location = 'fun.php?amount=$amou';
                            //                    </script>
                            //                    ";
                            //                        }
                            //                        ?>
                            <form  action="" method="post" id="paymentForm" >
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">

                                            <label class="form-control">NGN</label>
                                        </div>
                                        <input type="number" min="{{$data->len}}" maxlength="4" class="form-control" name="amount" id="amount" placeholder="00.00" required/>
                                    </div>
                                    @endforeach
                                </div>
                                <input type="hidden"  id="email-address" value="{{$user->email}}">
                        </div>
                    </div>
                    <button class="btn btn-outline-success btn-block withdraw-btn" type="submit" onclick="payWithPaystack()">Click Fund With Paystack</button>
                    <script src="https://js.paystack.co/v1/inline.js"> </script>
                    <br>
                    {{--                <a href="fun.php"><button  type="button" class=" btn-block withdraw-btn"  >Fund With Transfer</button></a>--}}

                    </form>
                    <!--                <button class="btn btn-success btn-block withdraw-btn" type="submit" onClick="makePayment()"> Fund With Flutterwave</button>-->
                    <!--                <script src="https://checkout.flutterwave.com/v3.js"> </script>-->

                </div>
            </div>


                    </div>
                </div>

        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Deposit History</h5>
        <div class="row">
            <div class="col-sm">
        <div class="table-wrap">
            <table id="datable_3" class="table table-hover w-100 display">
                <thead>
                            <th>Date</th>
                            <th>Username</th>
                            <th>Amount Fund</th>
                            <th>Payment_Ref</th>
                            </thead>
                            <tbody>
                            @foreach($fund as $po)
                                <tr>
                                    <td>{{$po->date}}</td>
                                    <td>{{$po->username}}</td>
                                    <td>{{$po->amount}}</td>
                                    <td>{{$po->payment_ref}}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
        </div>
</div>


        <script type="text/javascript">
            (function() {
                var options = {
                    whatsapp: "+2348103153004", // WhatsApp number
                    call_to_action: "Message us", // Call to action
                    position: "left", // Position may be 'right' or 'left'
                };
                var proto = document.location.protocol,
                    host = "whatshelp.io",
                    url = proto + "//static." + host;
                var s = document.createElement('script');
                s.type = 'text/javascript';
                s.async = true;
                s.src = url + '/widget-send-button/js/init.js';
                s.onload = function() {
                    WhWidgetSendButton.init(host, proto, options);
                };
                var x = document.getElementsByTagName('script')[0];
                x.parentNode.insertBefore(s, x);
            })();
        </script>

<script>
    const paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener("submit", payWithPaystack, false);
    function payWithPaystack(e) {
        e.preventDefault();
        let handler = PaystackPop.setup({
            key: 'pk_live_55360eafaea2a5e9a434166696d2865577c51722', // Replace with your public key
            email: document.getElementById("email-address").value,
            amount: document.getElementById("amount").value * 100,
            ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
// label: "Optional string that replaces customer email"
            onClose: function(){
                alert('Window closed.');
            },
            callback: function(response){
                let message = 'Payment complete! Reference: ' + response.reference;
                // alert(message);


                window.location = '{{ route('tran', '/') }}/'+response.reference;

            }
        });
        handler.openIframe();
    }
</script>


<!-- EChartJS JavaScript -->
<script src="{{asset('vendors4/echarts/dist/echarts-en.min.js')}}"></script>
<script src="{{asset('dist/js/barcharts-data.js')}}"></script>
