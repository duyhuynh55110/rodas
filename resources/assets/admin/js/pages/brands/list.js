const BRANDS_LIST = 'table#brandsList';
const SEARCH_FORM = 'form#searchForm';

export default class ListData {
    // dataTable object
    brandsTable = null;

    // setting for datatables
    options = {};

    constructor () {
        this.options = $(BRANDS_LIST).data('options');

        this.initDataTable();
        this.initEvents();
    }

    // init brands table
    initDataTable() {
        let _this = this;
        this.brandsTable = $(BRANDS_LIST).DataTable({
            ajax: {
                url: _this.options.dataTableAjax,
                data: function (request) {
                    let form = $(SEARCH_FORM);
                    request.name = form.find('input[name=name]').val();
                    request.country_id = form.find('select[name=country_id]').val();
                }
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    title: 'ID',
                    render: $.fn.dataTable.render.text(), // block XSS
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Name',
                    render: $.fn.dataTable.render.text(),
                },
                {
                    data: 'country.name',
                    name: 'country_name',
                    title: 'Country',
                    render: $.fn.dataTable.render.text(),
                },
                {
                    data: 'full_path_logo',
                    name: 'full_path_logo',
                    title: 'Logo',
                    render: function (data) {
                        if(data == null) {
                            return data;
                        }

                        return `<img width='120' src='${data}' class='rounded' alt='${data}'/>`;
                    }
                },
                {
                    data: 'id',
                    name: 'control',
                    title: '',
                    render: function (data) {
                        let updateUrl = _this.options.updateUrl.replace('%s', data);
                        return `<a class="btn btn-info btn-sm" href="${updateUrl}"><i class="fas fa-info-circle"></i> Detail </a>`;
                    }
                },
            ]
        });
    }

    // init events
    initEvents() {
        this._onSubmitFormSearch();
    }

    // filter data in table
    _onSubmitFormSearch() {
        let _this = this;
        $(SEARCH_FORM).on('submit', function (e) {
            _this.brandsTable.draw();
            return false;
        });
    }
}
