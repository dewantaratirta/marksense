<script type="module">
    $(document).ready(function() {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Ooops!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        @endif
    });
</script>
