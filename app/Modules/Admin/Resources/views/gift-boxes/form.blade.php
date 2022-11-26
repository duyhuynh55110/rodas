@php
    $isUpdateForm = isset($giftBox) ?? false;

    $inputId = old('id', $giftBox->id ?? null);
    $inputName = old('name', $giftBox->name ?? null);
    $srcImage = $giftBox->full_path_image ?? null;
    $inputPrice = old('price',  $isUpdateForm ? floatval($giftBox->price) : null);

    // validate
    $requiredInputImage = !$isUpdateForm ? 'required' : ''; // required if create
@endphp

@extends('Admin::layouts.admin.master')

@section('title')
    @if ($isUpdateForm)
        Gift Box Detail
    @else
        New Gift Box
    @endif
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary">
                    <form id="giftBoxForm" class="form-horizontal" method="POST" action="{{ routeAdmin('gift-boxes.save') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $inputId }}">

                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="inputName">Name</label>
                                <div class="col-sm-10">
                                    <input required maxlength="100" name="name" autocomplete="off" class="form-control"
                                        id="inputName" placeholder="Enter name"
                                        value="{{ $inputName }}">
                                </div>
                            </div>
                            <!-- .name -->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="inputPrice">Price</label>
                                <div class="col-sm-10">
                                    <input required min="0" max="{{MAX_INTEGER_VALUE}}" type="number" name="price" autocomplete="off" class="form-control"
                                        id="inputPrice" placeholder="Enter price"
                                        value="{{ $inputPrice }}">
                                </div>
                            </div>
                            <!-- .price -->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="uploadImage"> Image </label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input id="uploadImage" name="image_file_upload" type="file"
                                            class="custom-file-input"
                                            filesize="{{ UPLOAD_MAX_SIZE }}"
                                            accept="image/jpeg, image/png"
                                            {{ $requiredInputImage }}>
                                        <label class="custom-file-label" for="uploadImage">Choose file</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Allow: JPG/JPEG/PNG
                                    </small>
                                </div>
                            </div>
                            <!--.upload-file  -->

                            @if($isUpdateForm)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">&nbsp;</label>
                                    <div class="col-sm-10">
                                        <img width="120" src="{{ $srcImage }}" alt="{{ $srcImage }}" class="rounded">
                                    </div>
                                </div>
                                <!--.review-image -->
                            @endif

                            <div class="form-group row">
                                <label id="label-products-list" class="col-sm-12 col-form-label"> Products </label>
                                <div class="col-sm-4 my-2">
                                    <a class="btn btn-info mb-2" data-toggle="modal" data-target="#modalSearchProducts" role="button" id="btn-search">
                                        Search
                                    </a>
                                </div>
                                <!-- /.search-button -->

                                <div class="col-sm-12">
                                    <table id="giftBoxProductsList" class="table table-bordered table-hover" data-options='@json($options['giftBoxProducts'])'></table>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal search products --}}
    @include('Admin::gift-boxes.components.modal_search_products', [
        'brands' => $brands,
        'countries' => $countries,
        'options' => $options['searchProducts'],
    ])
@endsection
