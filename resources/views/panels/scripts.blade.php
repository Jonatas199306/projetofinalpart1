
    <!-- BEGIN: Vendor JS-->
    <script>
      var assetBaseUrl = "{{ asset('') }}";
  </script>
    <script src="{{asset('vendors/js/vendors.min.js')}}"></script>
    <script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.tools.js')}}"></script>
    <script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.defaults.js')}}"></script>
    <script src="{{asset('fonts/LivIconsEvo/js/LivIconsEvo.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: toastr -->
    <script src="{{asset('vendors/js/extensions/toastr.min.js')}}"></script>
    <!-- END: toastr -->

    <!-- BEGIN: Sweet Alert 2 -->
    <script src="{{asset('js/recursos/sweetalert2.min.js')}}"></script>
    <!-- END: Sweet Alert 2 -->

    <!-- BEGIN: jQuery Masked Input -->
    <script src="{{ asset('js/recursos/jquery.maskedinput.min.js') }}"></script>
    <!-- END: jQuery Masked Input -->

    <!-- BEGIN: form.addmasks -->
    <script src="{{ asset('js/recursos/form.addmasks.js') }}"></script>
    <!-- END: form.addmasks -->

    <!-- BEGIN: Page Vendor JS-->
    @yield('vendor-scripts')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    @if($configData['mainLayoutType'] == 'vertical-menu')
    <script src="{{asset('js/scripts/configs/vertical-menu-light.js')}}"></script>
    @else
    <script src="{{asset('js/scripts/configs/horizontal-menu.js')}}"></script>
    @endif
    <script src="{{asset('js/core/app-menu.js')}}"></script>
    <script src="{{asset('js/core/app.js')}}"></script>
    <script src="{{asset('js/scripts/components.js')}}"></script>
    <script src="{{asset('js/scripts/footer.js')}}"></script>
    <script src="{{asset('js/scripts/customizer.js')}}"></script>
    <!-- END: Theme JS-->


    <!-- BEGIN: Page JS-->
    @yield('page-scripts')
    <!-- END: Page JS-->


