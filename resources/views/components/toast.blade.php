<!-- Include Toastify CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

<!-- Include Toastify JS -->
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

@if (session()->has('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                gravity: 'top', // Display toast notifications at the top
                position: 'right', // Display toast notifications on the right
                backgroundColor: '#40930B' // Change background color to #40930B for error messages

            }).showToast();
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                gravity: 'top', // Display toast notifications at the top
                position: 'right', // Display toast notifications on the right
                backgroundColor: '#EB1C24' // Change background color to #40930B for error messages
            }).showToast();
        });
    </script>
@endif
