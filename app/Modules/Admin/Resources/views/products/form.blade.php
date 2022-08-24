@php
    $isUpdateForm = isset($product) ?? false;

    $inputId = old('id', $product->id ?? null);
    $inputName = old('name', $product->name ?? null);
    $inputItemPrice = old('item_price', $product->item_price ?? null);
    $selectBrandId = old('brand_id', $product->brand_id ?? null);
    $txtDescription = old('description', $product->description ?? null);

    $srcImage = $product->full_path_image ?? null;
    $selectedCategories = old('category_ids', $product->categories->pluck('id')->all() ?? []);

    // validate
    $requiredInputImage = !$isUpdateForm ? 'required' : ''; // required if create
@endphp

@extends('Admin::layouts.admin.master')

@section('title')
    @if ($isUpdateForm)
        Product Detail
    @else
        New Product
    @endif
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary">
                    <form id="productForm" class="form-horizontal" method="POST" action="{{ routeAdmin('products.save') }}" enctype="multipart/form-data">
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
                                <label class="col-sm-2 col-form-label" for="inputItemPrice">Price</label>
                                <div class="col-sm-10">
                                    <input required min="0" max="{{MAX_INTEGER_VALUE}}" type="number" name="item_price" autocomplete="off" class="form-control"
                                        id="inputItemPrice" placeholder="Enter price"
                                        value="{{ $inputItemPrice }}">
                                </div>
                            </div>
                            <!-- .item-price -->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="selectBrand"> Brand </label>
                                <div class="col-sm-10">
                                    <select required name="brand_id" class="custom-select select2" id="selectBrand">
                                        <option value="">Select brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $selectBrandId ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- .brand -->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="selectCategories"> Categories </label>
                                <div class="col-sm-10">
                                    <select required name="category_ids[]" multiple="multiple" data-placeholder="Select categories" class="custom-select select2" id="selectCategories">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ in_array($category->id, $selectedCategories) ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- .categories(select multiple) -->

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
                                <label class="col-sm-2 col-form-label" for="txtDescription">Description</label>
                                <div class="col-sm-10">
                                    <textarea maxlength="5000" name="description" id="txtDescription" cols="30" rows="10" class="form-control" placeholder="Enter description">{{$txtDescription}}</textarea>
                                </div>
                            </div>
                            <!-- .description -->
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
