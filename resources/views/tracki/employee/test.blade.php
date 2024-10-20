<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Implementing Yajra Datatables in Laravel 10</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link rel='stylesheet' href="{{ asset ('assets/vendors/bootstrap-5.2.3-dist/css/bootstrap.min.css')}}">
    <link rel='stylesheet' href="{{ asset ('assets/datatables/DataTables-1.13.8/css/dataTables.bootstrap5.min.css')}}">
    <link rel='stylesheet' href="{{ asset ('assets/datatables/Responsive-2.5.0/css/responsive.bootstrap5.min.css')}}">
    <link rel='stylesheet' href="{{ asset ('assets/datatables/Buttons-2.4.2/css/buttons.bootstrap5.min.css')}}"> -->

    <!-- <script src="{{ asset('assets/jquery/dist/jquery-3.7.0.js') }}"></script>
    <script src="{{ asset('assets/jquery/validation/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/datatables/DataTables-1.13.8/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('assets/vendors/bootstrap-5.2.3-dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/datatables/DataTables-1.13.8/js/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/datatables/pdfmake-0.2.7/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/datatables/pdfmake-0.2.7/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/datatables/JSZip-3.10.1/jszip.min.js')}}"></script>
    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/buttons.colVis.min.js')}}"></script> -->

    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel='stylesheet' href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
    <link rel='stylesheet' href="https://cdn.datatables.net/buttons/3.1.1/css/buttons.bootstrap5.css">
    <!-- <link rel='stylesheet' href="{{ asset ('assets/css/custom/datatable_custom.css')}}"> -->
    <link rel='stylesheet' href="{{ asset ('assets/vendors/fontawesome/5.8.1/css/all.min.css')}}">
    <link href="{{ asset ('assets/tracki/css/theme.min.css') }}" type="text/css" rel="stylesheet" id="style-default">
    <link rel="stylesheet" href="{{asset('assets/lightbox/lightbox.min.css')}}" />
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="{{asset('assets/vendors/fonts/boxicons.css')}}" />

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.bootstrap5.js"></script>

    <script src="{{asset('assets/datatables/pdfmake-0.2.7/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/datatables/pdfmake-0.2.7/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/datatables/JSZip-3.10.1/jszip.min.js')}}"></script>
    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/datatables/Buttons-2.4.2/js/buttons.colVis.min.js')}}"></script>
    <script src="{{ asset ('assets/vendors/fontawesome/all.min.js') }}"></script>
    <script src="{{asset('assets/lightbox/lightbox.min.js')}}"></script>
    <script src="{{ asset ('assets/vendors/moment/min/moment.min.js') }}"></script>





    <!-- <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script> -->

</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb-2 mt-4">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1">
                            <li class="breadcrumb-item">
                                <a href="{{route('tracki.dashboard')}}"><?= get_label('home', 'Home') ?></a>
                            </li>
                            <li class="breadcrumb-item active">
                                <?= get_label('employees', 'Employees') ?>
                            </li>

                        </ol>
                    </nav>
                </div>
                <div class="d-flex justify-content-center">
                    <div id="cover-spin" style="display:none;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div>
                    <a href="#!" id="add_employee" data-action="store" data-source="manage" data-type="add" data-table="employee_table" data-id="0">
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title=" <?= get_label('create_employee', 'Create employee') ?>">
                            <i class="bx bx-plus"></i>
                        </button>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table data-table table-hover" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th></th>
                                <th>Reference</th>
                                <th>Receiver</th>
                                <th>Booking Date</th>
                                <th>Gender</th>
                                <th width="105px">Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(function() {
                gb_DataTable = $(".data-table").DataTable({
                    autoWidth: true,
                    order: [0, "ASC"],
                    pagingType: 'simple_numbers',
                    processing: true,
                    serverSide: true,
                    // searchDelay: 2000,
                    paging: true,
                    scrollX: true,
                    ajax: "{{ route('tracki.employee.test') }}",
                    // iDisplayLength: "25",
                    // dom: 'Bfrtip',
                    // buttons: [
                    //     'copy', 'csv', 'excel', 'pdf', 'colvis',
                    //     {
                    //         text: 'Reload',
                    //         action: function(e, dt, node, config) {
                    //             dt.ajax.reload();
                    //         }
                    //     }
                    // ],
                    // buttons: [
                    //     'pageLength',
                    //     {
                    //         extend: 'copy',
                    //         className: 'btn btn-primary btn-sm'
                    //     },
                    //     {
                    //         extend: 'excel',
                    //         className: 'btn btn-primary btn-sm'
                    //     },
                    //     {
                    //         text: 'Reload',
                    //         className: 'btn btn-primary btn-sm',
                    //         action: function(e, dt, node, config) {
                    //             dt.ajax.reload();
                    //         }
                    //     },
                    //     {
                    //         extend: 'colvis',
                    //         className: 'btn btn-primary btn-sm'
                    //     },
                    // ],
                    layout: {
                        topStart: {
                            buttons: [
                                'pageLength',
                                {
                                    extend: 'csv',
                                    split: ['pdf', 'excel', 'colvis', ]
                                },


                                {
                                    text: 'Reload',
                                    className: 'btn btn-primary btn-sm',
                                    action: function(e, dt, node, config) {
                                        dt.ajax.reload();
                                    }
                                },
                            ]
                        },
                        // topEnd: {
                        //     search: {
                        //         placeholder: 'Type search here'
                        //     }
                        // },
                        // bottomEnd: 'paging',
                    },
                    columnDefs: [{
                        target: 4,
                        render: DataTable.render.datetime('YYYY-m-D', 'DD-MM-YYYY', 'en'),
                    }],
                    columns: [{
                            visible: false,
                            data: 'id',
                            name: 'id'
                        },
                        {
                            // visible: false,
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'employee_number',
                            name: 'Employee Number',
                            className: "align-middle white-space-wrap fw-bold fs-9",
                        },
                        {
                            data: 'full_name',
                            name: 'full_name'
                        },
                        {
                            data: 'date_of_birth',
                            name: 'date_of_birth'
                        },
                        {
                            data: 'gender',
                            name: 'gender',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    lengthMenu: [5, 10, 25, 50, {
                        label: 'All',
                        value: -1
                    }],
                });
            });
        </script>
</body>

</html>
