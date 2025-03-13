<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
</body>
</html>

<script>
    Swal.fire({
        title: 'Payment Successful!',
        text: 'Thank you for your payment.',
        icon: 'success',
        confirmButtonText: 'Go to Dashboard'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "<?=base_url()?>"; // Replace with your desired URL
        }
    });
</script>