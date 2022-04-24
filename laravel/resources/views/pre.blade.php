@include('layouts.sidebar')
<div class="hk-pg-wrapper">
    <div class="container mt-xl-50 mt-sm-30 mt-15">
        <div class="span9">
            <div class="content">
                <div class="module">
                    <div class="module-head">
                        <h3>
                            Preview Data</h3>
                    </div>
                    <center>
                        <div class="card">
                            <div class="card-body">
                                <div class="row page-breadcrumbs">
                                    <div class="col-md-12 align-self-center">

                                        <h4 class="theme-cl">Product Detail</h4>
                                    </div>
                                </div>
                            </div>
                            @if(isset($mg))
                                <div class='alert alert-success'>
                                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                                    <i class='fa fa-ban-circle'></i><strong>Notification: </br></strong><b class='align-content-center'>{{$mg}}</b>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="card-body">
                                                <label for="network" class=" requiredField">
                                                    Product<span class="asteriskField">*</span>
                                                </label>
                                                @foreach($data as $data1)
                                                    <input type="text" class="form-control text-success" value="{{$data1->tittle}}" readonly/>


                                                    <input type="hidden" class="form-control text-success" value="" readonly/>


                                                    @if(!($data1->product_type=="airtime"))
                                                        <label for="network" class="text-primary requiredField">
                                                            Amount<span class="asteriskField">*</span>
                                                        </label>

                                                            <input type="text" class="form-control text-primary" value="NGN{{$data1->amount}}" readonly/>
                                                    @endif



                                                    <form action="{{ route('data') }}" method="post">
                                                        @csrf
                                                            <input type="hidden" name="amount" value="{{$data1->amount}}">
                                                        <input type="hidden" name="name" value="{{$data1->details}}">
                                                        <input type="hidden" name="productid" value="{{$data1->id}}">
                                                        <input type="hidden" name="refid" value="<?php echo rand(10000000, 999999999); ?>">



                                                        @if($data1->status==1)
                                                            <div class="form-group">
                                                                <label for="network" class="text-successrequiredField">
                                                                    Enter Phone No<span class="asteriskField">*</span>
                                                                </label>
                                                                <input class="form-control text-primary" type="tel" placeholder="Enter recipient number" maxlength="11" minlength="11" id="phone" name="number" value="" autocomplete="on" size="20" required="">
                                                            </div>

                                                            <button type="submit" class="btn btn-rounded btn-outline-info"> Continue </button>
                                                        @endif

                                                    </form>
                                                @endforeach
                                                <br>

                                                <h3 class="box-title mrg-top-30">Key Highlights</h3>

                                                <ul class="list-icons">
                                                    <li><i class="fa fa-check text-success"></i> Secure Payment Gateways</li>
                                                    <li><i class="fa fa-check text-success"></i> Instant Activation</li>
                                                    <li><i class="fa fa-check text-success"></i> Efficient Performance</li>
                                                </ul>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
            </div>
        </div>
        <!--        <div class="col-sm-4 ">-->
        <!--            <br>-->
        <!--            <center> <h4>Codes for Data Balance: </h4></center>-->
        <!--            <ul class="list-group">-->
        <!--                <li class="list-group-item list-group-item-secondary">MTN [SME]     *461*4#  </li>-->
        <!--                <li class="list-group-item list-group-item-primary">MTN [Gifting]     *131*4# or *460*260#  </li>-->
        <!--                <li class="list-group-item list-group-item-dark"> 9mobile [Gifting]   *228# </li>-->
        <!--                <li class="list-group-item list-group-item-action"> Airtel   *140# </li>-->
        <!--                <li class="list-group-item list-group-item-success"> Glo  *127*0#. </li>-->
        <!--            </ul>-->
        <!--            <br>-->
        <!--            <center> <h6>Codes for Airtime Balance: </h6></center>-->
        <!--            <ul class="list-group">-->
        <!--                <li class="list-group-item list-group-item-primary">MTN Airtime VTU    <span id="RightT"> *556#  </span></li>-->
        <!---->
        <!--                <li class="list-group-item list-group-item-success"> 9mobile Airtime VTU   *232# </li>-->
        <!--                <li class="list-group-item list-group-item-info"> Airtel Airtime VTU   *123# </li>-->
        <!--                <li class="list-group-item list-group-item-dark"> Glo Airtime VTU #124#. </li>-->
        <!--            </ul>-->
        <!--        </div>-->
        <!--    </div>-->

