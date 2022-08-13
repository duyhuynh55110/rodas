@extends('Admin::layouts.admin.master')

@section('title')
    Brand
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <a class="btn btn-primary" href="{{ routeAdmin('brands.create') }}" role="button"> New </a>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search</h3>
                    </div>

                    <form id="search-form" onsubmit="return false;" class="form-horizontal">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input maxlength="100" type="text" autocomplete="off" class="form-control"
                                        name="name" id="inputName" placeholder="Name">
                                </div>
                            </div>
                            <!-- .brand-name.row -->

                            <div class="form-group row">
                                <label for="select-country" class="col-sm-2 col-form-label"> Country </label>
                                <div class="col-sm-10">
                                    <div class="search-box">
                                        <select name="country" class="form-control custom-select" id="select-country">
                                            <option value="{{ SELECT_OPTIONS_ALL }}"> All </option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}"> {{ $country->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- .country.row -->

                            <div class="form-group row float-right">
                                <button type="submit" name="btn-search" id="btn-search"
                                    class="btn btn-info">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="brands-list" data-options='@json($options)'
                            class="table table-bordered table-hover">
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
@endsection
