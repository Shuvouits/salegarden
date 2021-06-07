<script src="{{ URL::asset('backend/js/jquery.js') }}"></script>
<script src="{{ asset('backend/js/bootstrapMin.js') }}"></script>
<script src="{{ asset('backend/js/datePicker.js') }}"></script>
<script src="{{ asset('backend/js/slimScrollMin.js') }}"></script>
<script src="{{ asset('backend/js/fastclickMin.js') }}"></script>
<script src="{{ asset('backend/js/appMin.js') }}"></script>
<script src="{{ asset('backend/js/jqueryDataTable.js') }}"></script>
<script src="{{ asset('backend/js/dataTable.js') }}"></script>
<script src="{{ asset('backend/js/bootstrapDataTableResponsive.js') }}"></script>
<script src="{{ asset('backend/js/inputMask.js') }}"></script>
<script src="{{ asset('backend/js/inputMaskDateExtension.js') }}"></script>
<script src="{{ asset('backend/js/inputMaskExtension.js') }}"></script>
<script src="{{ asset('backend/js/multipleSelectFullMin.js') }}"></script>
<script src="{{ asset('backend/js/bootstrapTimepickerMin.js') }}"></script>
<script src="{{ asset('backend/js/colorPicker.js') }}"></script>
<script src="{{ asset('backend/js/bootstrapTagsinput.js') }}"></script>
<script src="{{ asset('backend/js/editor.js') }}"></script>
<script src="{{ asset('backend/js/customScript.js') }}"></script>

<script>
$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $('.date').datepicker({
        format: 'yyyy-mm-dd'
    });
    $("[data-mask]").inputmask();
    $(".select2").select2();
    $(".timepicker").timepicker({
        showInputs: false
    });
    $(".colorpicker").colorpicker();
    $(function () {
        $(".textarea").wysihtml5();
    });
});
</script>