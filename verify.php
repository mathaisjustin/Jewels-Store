<?php

require('config.php');

session_start();

require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$price=$_SESSION['price'];
$user_id=$_SESSION['user_id'];
$name=$_SESSION['name'];
$razorpayOrderId=$_SESSION['razorpay_order_id'];

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );
        
        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $html = "<button id='generate-pdf-btn'>Print</button>
    <style>body {
        background-color: #f2f2f2; /* set the background color for the entire page */
        text-align: center;
      }
      
      .container {
        max-width: 600px; /* set the maximum width for the container */
        margin: 0 auto; /* center the container horizontally */
        padding: 20px; /* add some padding to the container */
        text-align: center; /* center the content within the container */
      }
      
      .success-message {
        background-color: #8bc34a; /* set the background color for the success message */
        color: white; /* set the text color for the success message */
        padding: 20px; /* add some padding to the success message */
        border-radius: 5px; /* round the corners of the success message */
      }
      
      .payment-id {
        margin-top: 20px; /* add some spacing between the success message and payment ID */
      }
      
      .link {
        display: inline-block; /* make the link a block element */
        margin-top: 20px; /* add some spacing between the payment ID and the link */
        padding: 10px 20px; /* add some padding to the link */
        background-color: #8bc34a; /* set the background color for the link */
        color: white; /* set the text color for the link */
        text-decoration: none; /* remove the default underline for links */
        border-radius: 5px; /* round the corners of the link */
      }</style><div id='ticket' class='container'>
      <div class='success-message'>
        <p>Your payment was successful</p>
      </div>
      <div class='payment-id'>
        <p>Payment ID: {$_POST['razorpay_payment_id']}</p>
      </div>
      <div class='payment-id'>
        <p>Order ID: {$_SESSION['razorpay_order_id']}</p>
      </div>
      <div class='payment-id'>
        <p>Name: {$name}</p>
      </div>
     
	  <div class='payment-id'>
        <p>Total Amount: {$price}</p>
      </div>
      </div>
      <a href='orders.php' class='link'>Take Me Back</a> 
    
    
    <script src='https://html2canvas.hertzen.com/dist/html2canvas.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js'></script>
    <script>
      const generatePdfBtn = document.getElementById('generate-pdf-btn');
      
      generatePdfBtn.addEventListener('click', () => {
        function printDiv() {
          const doc = new jsPDF();
          const element = document.getElementById('ticket');
    
          html2canvas(element).then((canvas) => {
            const imgData = canvas.toDataURL('image/png');
            const imgProps = doc.getImageProperties(imgData);
            const pdfWidth = doc.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
    
            doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            doc.save('Ticket.pdf');
          });
        }
    
        printDiv();
      });
    </script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js'></script>";
      $test=$_SESSION['razorpay_order_id'];
      
   // code to Update the payment data in the database
   mysqli_query($conn, "UPDATE `orders` SET payment_id = '$test', payment_status='Paid' WHERE user_id='$user_id' AND name='$name' AND total_price='$price'") or die('query failed');
   
}
else
{
    $html = "<p>Your payment failed</p>
             <p>{$error}</p>";
}

echo $html;
