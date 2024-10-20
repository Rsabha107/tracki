<script src="{{ asset ('assets/jquery/dist/jquery-3.7.0.js') }}"></script>
<script src="{{ asset ('assets/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset ('assets/jquery/dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ asset ('assets/datatables/bundle/js/datatables.min.js') }}"></script>

<script src="{{ asset ('assets/vendors/popper/popper.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/bootstrap-5.2.3-dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- Bootstrap-table -->
<script src="{{ asset ('assets/jquery/dist/tableExport.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/bootstrap-table-master/dist/bootstrap-table.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/bootstrap-table-master/dist/extensions/export/bootstrap-table-export.min.js') }}"></script>

<script src="{{ asset ('assets/vendors/choices/choices.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>

<script src="{{ asset ('assets/vendors/anchorjs/anchor.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/is/is.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/fontawesome/all.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/lodash/lodash.min.js') }}"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
<script src="{{ asset ('assets/vendors/list.js/list.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/dayjs/dayjs.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/echarts/echarts.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/dhtmlx-gantt/dhtmlxgantt.js') }}"></script>
<script src="{{ asset ('assets/vendors/glightbox/glightbox.min.js') }}"> </script>
<script src="{{ asset ('assets/vendors/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset ('assets/js/toastr.min.js') }}"></script>
<script src="{{ asset ('assets/jquery/dist/jquery.form.min.js') }}"></script>
<script src="{{ asset ('assets/vendors/select2/js/select2.full.js') }}"></script>

<script src="{{ asset ('assets/tracki/js/phoenix.js') }}"></script>
<script src="{{ asset ('assets/vendors/leaflet/leaflet.js') }}"></script>
<script src="{{ asset ('assets/vendors/leaflet.markercluster/leaflet.markercluster.js') }}"></script>
<script src="{{ asset ('assets/vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js') }}">
</script>
<!-- <script src="{{ asset ('assets/tracki/js/ecommerce-dashboard.js') }}"></script> -->

<!-- <script src="{{ asset ('assets/tracki/js/projectmanagement-dashboard.js') }}"></script> -->
<!-- <script src="{{ asset ('assets/tracki/js/echarts-example.js') }}"></script> -->
<!-- <script src="{{ asset ('assets/tracki/js/crm-dashboard.js') }}"></script> -->
<!-- <script src="{{ asset ('assets/tracki/js/crm-analytics.js') }}"></script> -->

<!-- sweetalert -->
<script src="{{ asset('assets/js/code/sweetalert2.js') }}"></script>
<script src="{{asset('assets/lightbox/lightbox.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
<script src="{{ asset ('assets/vendors/sortablejs/Sortable.min.js') }}"> </script>
<script src="{{ asset('assets/js/code/code.js') }}"></script>
<script src="{{ asset('assets/vendors/spin/spin.js') }}"></script>
<!-- <script src="{{asset('assets/js/pages/all_tasks.js')}}"></script> -->
<!-- <script type="module" src="node_modules/spin.js/spin.js"></script> -->
<!-- <script src="{{asset('assets/js/pages/tasks.js')}}"></script> -->


<!-- <script src="https://cdn.datatables.net/rowgroup/1.4.1/js/dataTables.rowGroup.min.js"></script> -->


<script>
    // showing the offcanvas for the task creation

    $(document).ready(function() {


        function iformat(icon) {
            var originalOption = icon.element;
            return $('<span><i class="far fa-calendar"></i> ' + icon.text + '</span>');
        }

        // showing the offcanvas for the task creation
        // console.log('before select2-with-image')
        $('#statusSelect104').select2({
            width: "100%",
            templateSelection: iformat,
            templateResult: iformat,
            allowHtml: true
        });

        // console.log(optionFormat)

        // console.log('after select2-with-image')
        // console.log('select2 ok')
        $('.select2-with-image').select2({
            templateResult: iformat
        });
        $('.js-example-templating').select2();
        // $('.select2-with-image').select2({
        //     placeholder: "Select coin",
        // });


    });

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

    @if(Session::has('message'))
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "400",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    var type = "{{ Session::get('alert-type','info') }}"
    switch (type) {
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>
