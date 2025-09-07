<!-- Title -->
<title>@yield('title', "TantaSchool")</title>
<!-- Favicon -->
<link rel="apple-touch-icon" href="{{ asset('/') }}app-assets/images/ico/apple-icon-120.png">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('/') }}app-assets/images/ico/favicon.ico">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
<link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
<!-- BEGIN VENDOR CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css-rtl/vendors.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/vendors/css/ui/prism.min.css">
<!-- END VENDOR CSS-->
<!-- BEGIN MODERN CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css-rtl/app.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css-rtl/custom-rtl.css">
<!-- END MODERN CSS-->
<!-- BEGIN Page Level CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css-rtl/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css-rtl/core/colors/palette-gradient.css">
<!-- END Page Level CSS-->
<!-- BEGIN Custom CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}assets/css/style-rtl.css">
@yield('css')

<!-- BEGIN VENDOR JS-->
<script src="{{ asset('/') }}app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- END VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script type="text/javascript" src="{{ asset('/') }}app-assets/vendors/js/ui/prism.min.js"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{ asset('/') }}app-assets/js/core/app-menu.js" type="text/javascript"></script>
<script src="{{ asset('/') }}app-assets/js/core/app.js" type="text/javascript"></script>
<script src="{{ asset('/') }}app-assets/js/scripts/customizer.js" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<!-- BEGIN PAGE LEVEL JS-->
  <script src=" {{ asset('/') }}app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <!-- BEGIN VENDOR JS-->
  <!-- BEGIN PAGE VENDOR JS-->
  <script src=" {{ asset('/') }}app-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
  <script src=" {{ asset('/') }}app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js"
  type="text/javascript"></script>
  <script src=" {{ asset('/') }}app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
  <script src=" {{ asset('/') }}app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
  <script src=" {{ asset('/') }}app-assets/vendors/js/timeline/horizontal-timeline.js" type="text/javascript"></script>
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let btn = document.querySelector('.nav-link-expand');
        let icon = btn.querySelector('i');

        btn.addEventListener('click', function (e) {
            e.preventDefault();

            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen(); // Fullscreen
                icon.classList.remove('ft-maximize');
                icon.classList.add('ft-minimize');
            } else {
                document.exitFullscreen(); // Exit Fullscreen
                icon.classList.remove('ft-minimize');
                icon.classList.add('ft-maximize');
            }
        });
    });
</script>

<script>
    $(document).ready(function () {
        // التأكد من إن الـ dropdowns شغالة
        $('.dropdown-toggle').on('click', function (e) {
            e.preventDefault();
            var $dropdown = $(this).parent().find('.dropdown-menu');
            $('.dropdown-menu').not($dropdown).removeClass('show');
            $dropdown.toggleClass('show');
        });

        // إغلاق الـ dropdown لو ضغطت برا
        $(document).on('click', function (e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').removeClass('show');
            }
        });

        // تشغيل الـ modals لو فيه session messages
        @if (session()->has('success'))
            $('#successModal').modal('show');
            setTimeout(function () {
                $('#successModal').modal('hide');
            }, 5000);
        @endif

        @if (session()->has('Update'))
            $('#updateSuccessModal').modal('show');
            setTimeout(function () {
                $('#updateSuccessModal').modal('hide');
            }, 5000);
        @endif

        // وظيفة CheckAll لتحديد كل الـ checkboxes
        function CheckAll(className, elem) {
            var elements = document.getElementsByClassName(className);
            var l = elements.length;
            if (elem.checked) {
                for (var i = 0; i < l; i++) {
                    elements[i].checked = true;
                }
            } else {
                for (var i = 0; i < l; i++) {
                    elements[i].checked = false;
                }
            }
        }
    });
</script>
<script>



@yield('js')
