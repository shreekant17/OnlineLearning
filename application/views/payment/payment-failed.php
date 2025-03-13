<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>

<script>
    Swal.fire({
        title: 'Payment Failed!',
        text: 'Please try again or contact support.',
        icon: 'error',
        confirmButtonText: 'Return to Dashboard'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?=base_url()?>"; // Replace with your failure URL
        }
    });
</script>