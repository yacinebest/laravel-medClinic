<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDCn8TFXGg17HAUcNpkwtxxyT9Io9B_NcM" defer></script>
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slimscrollbar/jquery.slimscroll.min.js') }}"></script>
{{--  --}}<script src="{{ asset('assets/plugins/charts/Chart.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ladda/spin.min.js') }}"></script>
<script src="{{ asset('assets/plugins/ladda/ladda.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jquery-mask-input/jquery.mask.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
<script src="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
{{-- <script src="{{ asset('assets/js/chart.js') }}"></script> --}}
<script src="{{ asset('assets/js/date-range.js') }}"></script>
<script src="{{ asset('assets/js/map.js') }}"></script>
{{-- For Later --}}
{{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
{{-- For Alert And Confirmation Modal Check https://sweetalert.js.org/ --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
    $(function () {
        //to have only 6 item display at a time
        $('select').selectpicker({
            size: '6'
        });
    });
</script>

{{-- MedClinic Custom js --}}
<script src="{{ asset('js/custom/delete_entity.js') }}"></script>
@yield('scripts')
