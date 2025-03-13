<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<center>
  <small>Please do not refresh this page...</small>
</center>
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <a class="btn btn-primary"  href="<?=base_url()?>">Go Back to Home</a>
</div>
<form action="<?=base_url('payment/payment_status')?>" method="POST" id="payment-form">
    <script
        src="https://checkout.razorpay.com/v1/checkout.js"
        data-key="<?=$key_id?>" // Enter the Test API Key ID generated from Dashboard → Settings → API Keys
        data-amount="<?=$order['amount']?>" // Amount is in currency subunits. Hence, 29935 refers to 29935 paise or ₹299.35.
        data-currency="INR" // You can accept international payments by changing the currency code. Contact our Support Team to enable International for your account
        data-order_id="<?=$order['id']?>" // Replace with the order_id generated by you in the backend.
        data-buttontext="Pay with Razorpay"
        data-name="Online Learning Platform"
        data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
        data-image="<?= base_url('assets/user/images/numerology_logo.png')?>"
        data-prefill.name="<?=$customer_data['firstname'].' '.$customer_data['lastname']?>"
        data-prefill.email="<?=$customer_data['email']?>"
        data-theme.color="#F37254"
    ></script>
    <input type="hidden" custom="Hidden Element" name="hidden"/>
    <input type="hidden" value="<?=$course_id?>" name="course_id"/>
    <input type="hidden" value="<?=$order['amount']?>" name="price"/>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $(".razorpay-payment-button").hide();
    $(".razorpay-payment-button").click();
})
  
</script>

