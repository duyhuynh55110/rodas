@extends('Admin::layouts.admin.master')

@section('title')
    @if (isset($brand))
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
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="inputName">Name</label>
                                <div class="col-sm-10">
                                    <input required maxlength="100" name="name" autocomplete="off" class="form-control"
                                        id="inputName" placeholder="Enter name">
                                </div>
                            </div>
                            <!-- .name -->

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="selectCountry"> Country </label>
                                <div class="col-sm-10">
                                    <select required name="country_id" class="custom-select" id="selectCountry">
                                        <option value="">Select country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
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
                                            class="custom-file-input" required filesize="{{ UPLOAD_MAX_SIZE }}"
                                            accept="image/jpeg, image/png">
                                        <label class="custom-file-label" for="uploadLogo">Choose file</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Allow: JPG/JPEG/PNG
                                    </small>
                                </div>
                            </div>
                            <!--.upload-file  -->
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
