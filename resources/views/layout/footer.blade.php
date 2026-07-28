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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>

// Monthly Sales Chart

var monthlyOptions = {

series: [{
name: 'Sales',
data: [12000, 18000, 15000, 24000, 21000, 27000, 25000, 31000, 28000, 35000, 39000, 45000]
}],

chart: {
type: 'area',
height: 350,
toolbar: {
  show: false
}
},

dataLabels: {
enabled: false
},

stroke: {
curve: 'smooth',
width: 3
},

fill: {
type: 'gradient'
},

xaxis: {
categories: [
  'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
  'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
]
},

tooltip: {
y: {
  formatter: function (val) {
    return "₹ " + val;
  }
}
}

};

new ApexCharts(
document.querySelector("#monthlySalesChart"),
monthlyOptions
).render();




// Cash vs Due Chart

var pieOptions = {

series: [75, 25],

chart: {
type: 'donut',
height: 300
},

labels: [
'Cash',
'Due'
],

legend: {
position: 'bottom'
},

colors: [
'#28a745',
'#ffc107'
],

dataLabels: {
enabled: true
}

};

new ApexCharts(
document.querySelector("#billTypeChart"),
pieOptions
).render();

</script>



<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- Core JS -->

<script src="assets/vendor/libs/jquery/jquery.js"></script>

<script src="assets/vendor/libs/popper/popper.js"></script>
<script src="assets/vendor/js/bootstrap.js"></script>

<script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->

<script src="assets/js/main.js"></script>

<!-- Page JS -->
<script src="assets/js/dashboards-analytics.js"></script>

<!-- Place this tag before closing body tag for github widget button. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>


<!-- STEP 3: GlassToast JS -->
<script src="https://cdn.jsdelivr.net/gh/Vijayparmar03/GlassToast@main/vijay.js"></script>
</body>

</html>
