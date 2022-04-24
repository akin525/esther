@include('layouts.sidebar')
<div class="hk-pg-wrapper">
    <div class="container mt-xl-50 mt-sm-30 mt-15">
        <div class="row">
            <!--    <div class="card">-->
            <div class="card-body">
                <div class="module-head">
                    <center><h3>
                            Buy Data</h3></center>
                </div>
                <center>
                    <div class="btn-controls">
                        <form action="{{ route('pre') }}" method="post">
                            @csrf
                            <label for="network" class=" requiredField">
                                Select Network from the Rectangular Box<span class="asteriskField">*</span>
                            </label>
                            <select  name="id" class="text-success form-control" required="">
                                {{--                        <option value="">MTN | GLO | 9Mobile | Airtel</option>--}}
                                @foreach($data as $datas)
                                    <option value="{{$datas->id}}">{{$datas->tittle}} || NGN{{$datas->amount}}

                                    </option>
                                @endforeach

                            </select>

                            <br>
                            <button type="submit" class=" btn" style="color: white;background-color: #ff0066">Click Next</button>
                        </form>
                </center>
                <br>



                <p>You can use the codes below to check your Data Balance!  </p>

                <h6>
                    <ul>
                        <li> MTN [SME] *461*4# or *556#</li>
                        <li>MTN [CG] *131*4# or *460*260#</li>
                        <li>9mobile [Gifting] *228#</li>
                        <li>Airtel *140#</li>
                        <li>Glo *127*0#</li>
                    </ul>
                </h6>



                <br>


                <br>
            </div>
        </div>
