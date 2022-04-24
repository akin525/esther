@include('layouts.sidebar')
<!-- Main Content -->
<div class="hk-pg-wrapper">
    <!-- Container -->
    <div class="container mt-xl-50 mt-sm-30 mt-15">
        <!-- Title -->
        <div class="hk-pg-header align-items-top">
            <div>
                <h2 class="hk-pg-title font-weight-600 mb-10">Customer Management</h2>
                <p>Questions about onboarding lead data? <a href="#">Learn more.</a></p>
            </div>
            <div class="d-flex w-500p">
                <select class="form-control custom-select custom-select-sm mr-15">
                    <option selected="">Latest Products</option>
                    <option value="1">CRM</option>
                    <option value="2">Projects</option>
                    <option value="3">Statistics</option>
                </select>
                <select class="form-control custom-select custom-select-sm mr-15">
                    <option selected="">USA</option>
                    <option value="1">USA</option>
                    <option value="2">India</option>
                    <option value="3">Australia</option>
                </select>
                <select class="form-control custom-select custom-select-sm">
                    <option selected="">December</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="1">April</option>
                    <option value="2">May</option>
                    <option value="3">June</option>
                    <option value="1">July</option>
                    <option value="2">August</option>
                    <option value="3">September</option>
                    <option value="1">October</option>
                    <option value="2">November</option>
                    <option value="3">December</option>
                </select>
            </div>
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <x-jet-validation-errors class="alert-danger" />

        @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <div class="col-xl-12">
                <div class="hk-row">
                    <div class="col-sm-12">
                        <div class="card-group hk-dash-type-2">
                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-5">
                                        <div>
                                            <i class=" fa fa-money"></i>
                                            <h4 class="d-block font-15 text-dark font-weight-500">Wallet Balance</h4>
                                        </div>
                                        <div>
{{--                                            <span class="text-success font-14 font-weight-500">+10%</span>--}}
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="">NGN{{number_format(intval( $user->wallet *1),2)}}</h4>
{{--                                        <small class="d-block">172,458 Target Users</small>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-5">
                                        <div>
                                            <i class="fa fa-money"></i>
                                            <span class="d-block font-15 text-dark font-weight-500">Total Deposit</span>
                                        </div>
                                        <div>
{{--                                            <span class="text-success font-14 font-weight-500">+12.5%</span>--}}
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="">NGN{{number_format(intval( $totaldeposite *1), 2)}}</h4>
{{--                                        <small class="d-block">472,458 Targeted</small>--}}
                                    </div>
                                </div>
                            </div>

                            <div class="card card-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-5">
                                        <div>
                                            <i class="fa fa-money"></i>
                                            <span class="d-block font-15 text-dark font-weight-500">Total Bills</span>
                                        </div>
                                        <div>
{{--                                            <span class="text-warning font-14 font-weight-500">-2.8%</span>--}}
                                        </div>
                                    </div>
                                    <div>
                                        <h4>NGN{{number_format(intval( $bill *1), 2)}}</h4>
{{--                                        <small class="d-block">100 Targeted</small>--}}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper">
                            <h6 class="hk-sec-title">Bar Chart</h6>
                            <div class="row">
                                <div class="col-sm">
                                    <div id="e_chart_1" class="echart" style="height:294px;"></div>
                                </div>
                            </div>
                        </section>
                <script>
                    $(document).ready(function() {
                        $('#styleOptions').styleSwitcher();
                    });
                </script>

                <script>
                    $('.dropdown-toggle').dropdown()
                </script>
                <script>
                    $(function () {
                        "use strict";
                        // Bar chart
                        new Chart(document.getElementById("canv"), {
                            type: 'bar',
                            data: {
                                labels: ["Wallet balance", "Total Paid", "Total Bills"],
                                datasets: [
                                    {
                                        label: "Population (millions)",
                                        backgroundColor: ["#03a9f4", "#e861ff","#08ccce"],
                                        data: [2000,4000,800]
                                    }
                                ]
                            },
                            options: {
                                legend: { display: false },
                                title: {
                                    display: true,
                                    text: 'My Wallet/Payment Chart'
                                }
                            }
                        });


                        // line second
                    });
                </script>

                        <section class="hk-sec-wrapper">
                            <h5 class="hk-sec-title">Deposit History</h5>
{{--                            <p class="mb-40">Use buttons: <code>['copy', 'csv', 'excel', 'pdf', 'print']</code> to add export table options.</p>--}}
                            <div class="row">
                                <div class="col-sm">
                                    <div class="table-wrap">
                                        <table id="datable_3" class="table table-hover w-100 display">
                                            <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Transacion Id</th>
                                                <th>Amount Fund</th>
                                                <th>Amount Before</th>
                                                <th>Amount After</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($deposite as $da)

                                                <tr>
                                                   <td>{{$da->username}}</td>
                                                   <td>{{$da->payment_ref}}</td>
                                                   <td>{{$da->amount}}</td>
                                                   <td>{{$da->iwallet}}</td>
                                                   <td>{{$da->fwallet}}</td>
                                                   <td>{{$da->date}}</td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>



                                            <!-- EChartJS JavaScript -->
                        <script src="{{asset('vendors4/echarts/dist/echarts-en.min.js')}}"></script>
                        <script src="{{asset('dist/js/barcharts-data.js')}}"></script>
