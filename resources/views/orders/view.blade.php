@extends('layout.app')

@section('meta')
@endsection

@section('title')
    View Order
@endsection

@section('styles')
    <style>
        @media print{
            .hide{
                display: none;
            }
        }
    </style>
@endsection

@section('content')
    <div class="page-content fade-in-up">
        <div class="row" id="printableArea">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">View Order</div>
                    </div>
                    <div class="ibox-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $data->name ?? '' }}" placeholder="Plese enter name" disabled />
                                <span class="kt-form__help error name"></span>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="order_date">Order Date <span class="text-danger"></span></label>
                                <input type="date" name="order_date" id="order_date" class="form-control" value="{{ $data->order_date ?? '' }}" placeholder="Plese enter order date" disabled />
                                <span class="kt-form__help error order_date"></span>
                            </div>
                            <div class="row" id="customer_details"></div>
                        </div>
                        @if(isset($data->order_details) && $data->order_details->isNotEmpty())
                            <div class="row" id="table" style="display:block">
                        @else
                            <div class="row" id="table" style="display:none">
                        @endif
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width:10%">Sr. No</th>
                                            <th style="width:40%">Product</th>
                                            <th style="width:25%">Quantity</th>
                                            <th style="width:25%">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($data->order_details) && $data->order_details->isNotEmpty())
                                            @php $i=1; @endphp
                                            @foreach($data->order_details as $row)
                                                <tr class="clone" id="clone_{{ $i }}">
                                                    <th style="width:10%">{{ $i }}</th>
                                                    <th style="width:40%">{{ $row->product_name }}
                                                        <input type="hidden" name="product_id[]" id="product_{{ $i }}" value="{{ $row->product_id }}">
                                                    </th>
                                                    <th style="width:25%">
                                                        <input type="text" name="quantity[]" id="quantity_{{ $i }}" value="{{ $row->quantity }}" class="form-control digit" disabled>
                                                    </th>
                                                    <th style="width:25%">
                                                        <input type="text" name="price[]" id="price_{{ $i }}" value="{{ $row->price }}" class="form-control digit" disabled>
                                                    </th>
                                                </tr>
                                                @php $i++; @endphp
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        <div class="form-group">
                            <a href="{{ route('orders') }}" class="btn btn-default hide">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <input type="button" class="btn btn-primary" style="cursor:pointer" onclick="printDiv('printableArea')" value="Print" />
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        $(document).ready(function () {
            let exst_name = "{{ $data->name ?? '' }}";
            
            if(exst_name != '' || exst_name != null){
                $("#customer_details").html('');
                _customer_details(exst_name);
            }
        });

        function _customer_details(name){
            $.ajax({
                url : "{{ route('orders.customer.details') }}",
                type : 'post',
                data : { "_token": "{{ csrf_token() }}", "name": name},
                dataType: 'json',
                async: false,
                success : function(json){
                    $("#customer_details").append(
                        '<div class="form-group col-md-6"><span style="font-weight: bold; padding-left:16px;">Name: </span><span>'+json.data.party_name+'</span></div>'+
                        '<div class="form-group col-md-6"><span style="font-weight: bold; padding-left:16px;">Billing Name: </span><span>'+json.data.billing_name+'</span></div>'+
                        '<div class="form-group col-md-6"><span style="font-weight: bold; padding-left:16px;">Contact Person: </span><span>'+json.data.contact_person+'</span></div>'+
                        '<div class="form-group col-md-6"><span style="font-weight: bold; padding-left:16px;">Mobile Number: </span><span>'+json.data.mobile_number+'</span></div>'+
                        '<div class="form-group col-md-6"><span style="font-weight: bold; padding-left:16px;">Billing Address: </span><span>'+json.data.billing_address+'</span></div>'+
                        '<div class="form-group col-md-6"><span style="font-weight: bold; padding-left:16px;">Delivery Address: </span><span>'+json.data.delivery_address+'</span></div>'+
                        '<div class="form-group col-md-6"><span style="font-weight: bold; padding-left:16px;">Electrician: </span><span>'+json.data.electrician+'</span></div>'+
                        '<div class="form-group col-md-6"><span style="font-weight: bold; padding-left:16px;">Electrician Number: </span><span>'+json.data.electrician_number+'</span></div>');
                }
            });
        }
    </script>
@endsection

