@php
    $isUpdateForm = isset($brand) ?? false;

    $inputId = old('id', $brand->id ?? null);
    $inputName = old('name', $brand->name ?? null);
    $selectCountryId = old('country_id', $brand->country_id ?? null);
    $srcLogo = $brand->full_path_logo ?? null;

    // validate
    $requiredInputLogo = !$isUpdateForm ? 'required' : ''; // required if create

@endphp

@extends('Admin::layouts.admin.master')

@section('title')
    @if ($isUpdateForm)
        Brand Detail
    @else
        New Brand
    @endif
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-primary">
                    <form id="brand-form" class="form-horizontal" method="POST" action="{{ routeAdmin('brands.save') }}" enctype="multipart/form-data">
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
                                <label class="col-sm-2 col-form-label" for="selectCountry"> Country </label>
                                <div class="col-sm-10">
                                    <select required name="country_id" class="custom-select" id="selectCountry">
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}" {{ $country->id == $selectCountryId ? 'selected' : '' }}>{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- .country -->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="uploadLogo"> Logo </label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input id="uploadLogo" name="logo_file_upload" type="file"
                                            class="custom-file-input"
                                            filesize="{{ UPLOAD_MAX_SIZE }}"
                                            accept="image/jpeg, image/png"
                                            {{ $requiredInputLogo }}>
                                        <label class="custom-file-label" for="uploadLogo">Choose file</label>
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
                                        <img width="120" src="{{ $srcLogo }}" alt="{{ $srcLogo }}" class="rounded">
                                    </div>
                                </div>
                                <!--.review-logo -->
                            @endif
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
