@extends('Admin::layouts.admin.master')

@section('title')
    Gift Box
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <a class="btn btn-primary" href="{{ routeAdmin('gift-boxs.create') }}" role="button"> New </a>
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
                            <!-- .gift-box-name.row -->

                            <div class="form-group row d-flex justify-content-end pr-2">
                                <button type="submit" id="btn-search" class="btn btn-info">Search</button>
                            </div>
                            <!-- .btn-submit.row -->
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
                        <table id="gift-boxs-list" data-options='@json($options)'
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
