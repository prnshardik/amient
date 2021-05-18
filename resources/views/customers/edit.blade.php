@extends('layout.app')

@section('meta')
@endsection

@section('title')
    Edit Product
@endsection

@section('styles')
@endsection

@section('content')
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">Edit Product</div>
                    </div>
                    <div class="ibox-body">
                        <form name="form" action="{{ route('customers.update') }}" id="form" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <input type="hidden" name="id" value="{{ $data->id }}">
                            
                            <div class="row">
                            <div class="form-group col-sm-6">
                                    <label for="party_name">Party Name <span class="text-danger">*</span></label>
                                    <input type="text" name="party_name" id="party_name" class="form-control" value="{{ @old('party_name', $data->party_name) }}" placeholder="Plese enter party name" />
                                    <span class="kt-form__help error party_name"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="billing_name">Billing Name <span class="text-danger">*</span></label>
                                    <input type="text" name="billing_name" id="billing_name" class="form-control" value="{{ @old('billing_name', $data->billing_name) }}" placeholder="Plese enter billing name" />
                                    <span class="kt-form__help error billing_name"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="contact_person">Contact person <span class="text-danger">*</span></label>
                                    <input type="text" name="contact_person" id="contact_person" class="form-control" value="{{ @old('contact_person', $data->contact_person) }}" placeholder="Plese enter contact person" />
                                    <span class="kt-form__help error contact_person"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="mobile_number">Mobile number <span class="text-danger">*</span></label>
                                    <input type="text" name="mobile_number" id="mobile_number" class="form-control digits" value="{{ @old('mobile_number', $data->mobile_number) }}" placeholder="Plese enter mobile number" />
                                    <span class="kt-form__help error mobile_number"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="billing_address">Billing address <span class="text-danger">*</span></label>
                                    <textarea name="billing_address" id="billing_address" cols="3" rows="5" class="form-control" placeholder="Plese enter billing address">{{ @old('billing_address', $data->billing_address) }}</textarea>
                                    <span class="kt-form__help error billing_address"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="delivery_address">Delivery address <span class="text-danger">*</span></label>
                                    <textarea name="delivery_address" id="delivery_address" cols="3" rows="5" class="form-control" placeholder="Plese enter delivery address">{{ @old('delivery_address', $data->delivery_address) }}</textarea>
                                    <span class="kt-form__help error delivery_address"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="electrician">Electrician <span class="text-danger"></span></label>
                                    <input type="text" name="electrician" id="electrician" class="form-control" value="{{ @old('electrician', $data->electrician) }}" placeholder="Plese enter electrician" />
                                    <span class="kt-form__help error electrician"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="electrician_number">Electrician number <span class="text-danger"></span></label>
                                    <input type="text" name="electrician_number" id="electrician_number" class="form-control digits" value="{{ @old('electrician_number', $data->electrician_number) }}" placeholder="Plese enter electrician number" />
                                    <span class="kt-form__help error electrician_number"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="architect">Architect <span class="text-danger"></span></label>
                                    <input type="text" name="architect" id="architect" class="form-control" value="{{ @old('architect', $data->architect) }}" placeholder="Plese enter architect" />
                                    <span class="kt-form__help error architect"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="architect_number">Architect number <span class="text-danger"></span></label>
                                    <input type="text" name="architect_number" id="architect_number" class="form-control digits" value="{{ @old('architect_number', $data->architect_number) }}" placeholder="Plese enter architect number" />
                                    <span class="kt-form__help error architect_number"></span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="office_contact_person">Office contact person <span class="text-danger"></span></label>
                                    <input type="text" name="office_contact_person" id="office_contact_person" class="form-control" value="{{ @old('office_contact_person', $data->office_contact_person) }}" placeholder="Plese enter office contact person" />
                                    <span class="kt-form__help error office_contact_person"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ route('customers') }}" class="btn btn-default">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('.digits').keyup(function(e){
                if (/\D/g.test(this.value)){
                    this.value = this.value.replace(/\D/g, '');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            var form = $('#form');
            $('.kt-form__help').html('');
            form.submit(function(e) {
                $('.help-block').html('');
                $('.m-form__help').html('');
                $.ajax({
                    url : form.attr('action'),
                    type : form.attr('method'),
                    data : form.serialize(),
                    dataType: 'json',
                    async:false,
                    success : function(json){
                        return true;
                    },
                    error: function(json){
                        if(json.status === 422) {
                            e.preventDefault();
                            var errors_ = json.responseJSON;
                            $('.kt-form__help').html('');
                            $.each(errors_.errors, function (key, value) {
                                $('.'+key).html(value);
                            });
                        }
                    }
                });
            });
        });
    </script>
@endsection

