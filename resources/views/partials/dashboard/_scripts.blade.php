<!-- Backend Bundle JavaScript -->
<script src="{{ asset('js/libs.min.js')}}"></script>
@if(in_array('data-table',$assets ?? []))
<script src="{{ asset('vendor/datatables/buttons.server-side.js')}}"></script>
@endif

<!-- mapchart JavaScript -->
<script src="{{asset('vendor/Leaflet/leaflet.js') }} "></script>


<!-- fslightbox JavaScript -->
<script src="{{asset('js/plugins/fslightbox.js')}}"></script>
<script src="{{asset('js/plugins/slider-tabs.js') }}"></script>
<script src="{{asset('js/plugins/form-wizard.js')}}"></script>

<script src="{{asset('vendor/vanillajs-datepicker/dist/js/datepicker-full.js')}}"></script>

@stack('scripts')

<!-- Custom JavaScript -->
<script src="{{asset('js/app.js') }}"></script>
<script src="{{asset('js/modelview.js')}}"></script>