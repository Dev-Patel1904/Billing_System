<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl">
      <div
        class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
          &#169;
          <script>
            document.write(new Date().getFullYear());
          </script>
          , made with ❤️ by
          <a href="https://themeselection.com" target="_blank" class="footer-link">ThemeSelection</a>
        </div>

      </div>
    </div>
</div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>

<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>

<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- Main JS -->

<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

<!-- Place this tag before closing body tag for github widget button. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- STEP 3: GlassToast JS -->
<script src="https://cdn.jsdelivr.net/gh/Vijayparmar03/GlassToast@main/vijay.js"></script>

{{-- LOGOUT CONFIRM --}}
<script>
    document.getElementById('logoutBtn').addEventListener('click', function (e) {

        e.preventDefault();

        const logoutUrl = this.href;

        GlassToast.confirm(
            'લોગ આઉટ કરો',
            'શું તમે ખરેખર લોગ આઉટ કરવા માંગો છો?',
            function () {
                window.location.href = logoutUrl;
            }
        );

    });
</script>


</body>

</html>
