@include('layouts.sidebar')
<!-- Main Content -->
<div class="hk-pg-wrapper">
    <!-- Container -->
    <div class="container mt-xl-50 mt-sm-30 mt-15">
        <section class="hk-sec-wrapper">
            <h5 class="hk-sec-title">Transaction History</h5>
            {{--                            <p class="mb-40">Use buttons: <code>['copy', 'csv', 'excel', 'pdf', 'print']</code> to add export table options.</p>--}}
            <div class="row">
                <div class="col-sm">
                    <div class="table-wrap">
                        <table id="datable_3" class="table table-hover w-100 display">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Transacion Id</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Numberr</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bil2 as $da)

                                <tr>
                                    <td>{{$da->username}}</td>
                                    <td>{{$da->refid}}</td>
                                    <td>{{$da->amount}}</td>
                                    <td>{{$da->plan}}</td>
                                    <td>{{$da->phone}}</td>
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
</div>
