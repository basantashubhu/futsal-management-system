class MasterTable {
    tableOptions = {
        data: {
            type: 'remote',
            source: {
                read: {
                    url: '',
                    method: 'get'
                }
            },
            serverFiltering: true,
            serverSorting: true,
            serverPaging: true,
            saveState: false,
            pageSize: 50
        },
        pagination: true,
        sortable: true,
        search: {
            input: $('.search_field')
        },
        rows: {
            autoHide: false
        },
        layout: {
            footer: false,
            scroll: false
        },
        toolbar: {
            pagination: {
                pageSizeSelect: [10, 15, 30, 50, 100]
            }
        }
    };

    selector;

    constructor(selector) {
        this.selector = selector;
    }

    init(options) {
        for (let [method, value] of Object.entries(options)) {
            if (typeof this[method] !== 'function') {
                this.tableOptions[method] = value;
                continue;
            }
            this[method](value);
        }

        // console.log(this.selector, this.tableOptions);

        return $(this.selector).mDatatable(this.tableOptions);
    }

    url(url) {
        this.tableOptions.data.source.read.url = url;
    }

    method(method) {
        this.tableOptions.data.source.read.method = method;
    }

    query(data) {
        this.tableOptions.data.source.read.params = data;
    }

    searchfield(field) {
        this.tableOptions.search.input = field;
    }

    pageSize(limit) {
        this.tableOptions.data.pageSize = limit;
    }

    layout(layout) {
        Object.assign(this.tableOptions.layout, layout);
    }
}

function master_table(selector) {
    return new MasterTable(selector);
}
