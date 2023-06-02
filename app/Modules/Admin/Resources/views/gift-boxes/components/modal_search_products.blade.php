<div id="modalSearchProducts" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 80%">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> Search Products </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="searchProductsForm" onsubmit="return false;" class="form-horizontal">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input maxlength="100" type="text" autocomplete="off" class="form-control"
                                name="name" id="inputName" placeholder="Name">
                        </div>
                    </div>
                    <!-- .product-name.row -->

                    <div class="form-group row">
                        <label for="select-brand" class="col-sm-2 col-form-label"> Brand </label>
                        <div class="col-sm-10">
                            <div class="search-box">
                                <select name="brand_id" class="form-control custom-select select2" id="select-brand">
                                    <option value="{{ SELECT_OPTION_ALL }}"> All </option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}"> {{ $brand->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- .brand.row -->

                    <div class="form-group row">
                        <label for="select-country" class="col-sm-2 col-form-label"> Country </label>
                        <div class="col-sm-10">
                            <div class="search-box">
                                <select name="country_id" class="form-control custom-select select2" id="select-country">
                                    <option value="{{ SELECT_OPTION_ALL }}"> All </option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"> {{ $country->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- .country.row -->

                    <div class="form-group row d-flex justify-content-end pr-2">
                        <button type="submit" id="btn-search" class="btn btn-info">Search</button>
                    </div>
                    <!-- .btn-confirm-search.row -->
                </form>
                <!-- .search-products-form -->

                <table id="searchProductsList" data-options='@json($options)' class="table table-bordered table-hover"></table>
                <!-- .search-products-table -->
            </div>
            <div class="modal-footer">
                <div class="mx-auto">
                    <button id="btnSubmitSelectedProducts" type="button" class="btn btn-primary mr-2"> Confirm </button>
                </div>
            </div>
        </div>
    </div>
</div>
