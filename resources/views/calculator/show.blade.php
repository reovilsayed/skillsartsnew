@extends('layouts.app')
@section('title','Calculator')
@section('css')
<style>
    a:hover,
    a:focus {
        text-decoration: none;
        outline: none;
    }

    #accordion .panel {
        border: none;
        border-radius: 0;
        box-shadow: none;
        margin: 0 0 10px;
        overflow: hidden;
        position: relative;
    }

    #accordion .panel-heading {
        padding: 0;
        border: none;
        border-radius: 0;
        margin-bottom: 10px;
        z-index: 1;
        position: relative;
    }

    #accordion .panel-heading:before,
    #accordion .panel-heading:after {
        content: "";
        width: 50%;
        height: 20%;
        box-shadow: 0 15px 5px rgba(0, 0, 0, 0.4);
        position: absolute;
        bottom: 15px;
        left: 10px;
        transform: rotate(-3deg);
        z-index: -1;
    }

    #accordion .panel-heading:after {
        left: auto;
        right: 10px;
        transform: rotate(3deg);
    }

    #accordion .panel-title a {
        display: block;
        padding: 15px 70px 15px 70px;
        margin: 0;
        background: #fff;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 1px;
        color: #d11149;
        border-radius: 0;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1), 0 0 40px rgba(0, 0, 0, 0.1) inset;
        position: relative;
    }

    #accordion .panel-title a:before,
    #accordion .panel-title a.collapsed:before {
        content: "\f106";
        font-family: "FontAwesome";
        font-weight: 900;
        width: 55px;
        height: 100%;
        text-align: center;
        line-height: 50px;
        border-left: 2px solid #D11149;
        position: absolute;
        top: 0;
        right: 0;
    }

    #accordion .panel-title a.collapsed:before {
        content: "\f107";
    }

    #accordion .panel-title a .icon {
        display: inline-block;
        width: 55px;
        height: 100%;
        border-right: 2px solid #d11149;
        font-size: 20px;
        color: rgba(0, 0, 0, 0.7);
        line-height: 50px;
        text-align: center;
        position: absolute;
        top: 0;
        left: 0;
    }

    #accordion .panel-body {
        padding: 10px 20px;
        margin: 0 0 20px;
        border-bottom: 3px solid #d11149;
        border-top: none;
        background: #fff;
        font-size: 15px;
        color: #333;
        line-height: 27px;
    }

</style>
@endsection
@section('content')
<div class="bg-white pt-3 pb-3">
    <div class="container-fluid  mt-5">
        <h1 class="text-danger text-center">
            طلب عرض سعر خاص

        </h1>
        <hr style="width: 25%;text-align:center">
        <div class="row">
            <div class="col-md-12 mx-auto" >
                <form action="{{route('calculator.store')}}" method="post" id="form">
                    @csrf
                    <div style="width:60vw;" class="mx-auto">
                    <livewire:calculator />
                    </div>
                    <input type="hidden" value="" name="charge" id="charge">
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-dark" id="exampleModalLongTitle">أختر المبلغ الذي ستقوم بسداده</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row row-cols-2">
                                        <div class="col">
                                            <button type="button" id="pay-half"
                                                class="btn btn-outline-info btn-block">أدفع 50%</button>
                                        </div>
                                        <div class="col">
                                            <button type="button" id="pay-full"
                                                class="btn btn-outline-info btn-block">أدفع 100%</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="btn-group mx-auto" id="submit_button">
                        <button onclick="window.location.href = 'https://wa.me/966593031810';" id="contact" type="button" class="btn btn-outline-info" disabled="true" >تواصل معنا</button>
                         <button type="button" data-toggle="modal" data-target="#exampleModalCenter"
                                class="btn btn-outline-danger">أطلب الآن</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
@push('script')
 <script>
     
          $('#form').click((e)=>{
           
           var i = 0;
           for(el of document.getElementsByClassName('custom-control-input')){
            if(el.checked == true){
                i++
            }
            }
            if(i > 0){
                $('#contact').prop('disabled', false);
            }
            else{
                $('#contact').prop('disabled', true);
            }
              
                     
                
          })
   
    </script>
  
<script>
    document.getElementById('pay-half').addEventListener('click', function () {
        var total = parseInt(document.getElementById('total').innerText)
        document.getElementById('charge').value = total / 2;
        document.getElementById('form').submit();
    });

</script>
<script>
    document.getElementById('pay-full').addEventListener('click', function () {
        var total = parseInt(document.getElementById('total').innerText)
        document.getElementById('charge').value = total;
        document.getElementById('form').submit();
    });
</script>
@endpush
@endsection
