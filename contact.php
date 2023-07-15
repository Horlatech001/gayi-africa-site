<?php 
    		$rsp="";
    		if(isset($_POST['send_btn'])){
				include('./mail/PHPMailerAutoload.php');
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $phone = $_POST['phone_num'];
                $message = $_POST['message'];

                $uploadSuccess = true; // Flag to track if the file upload was successful

               extract($_POST);
               $splitReceivers = explode(",", "corporate@gayiafrica.org");

               $totalSent=0;
               $totalReceivers=count($splitReceivers);
               $failedEmails=[];

			   	foreach ($splitReceivers as $receiver) {
					# code...
					$mail = new PHPMailer;
					$mail->isSMTP();                                      
					$mail->Host = 'gayiafrica.org';
					$mail->SMTPAuth = true;                           
					$mail->Username = 'corporate@gayiafrica.org';               
					$mail->Password = '15593716bc@';                          
					$mail->SMTPSecure = 'ssl';                            
					$mail->Port = 465;
					$mail->setFrom($email, 'GayiAfrica');
				    $mail->FromName ='GayiAfrica';
				    $mail->addAddress($receiver , "Corporate");              

				    $mail->isHTML(true);                                 

				    $mail->Subject = $fullname;
				    $email_message = '<h2>GayiAfrica Membership form Submitted</h2>
                    <p><b>Fullname:</b> '.$fullname.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Phone Num:</b> '.$phone.'</p>
                    <p><b>Message:</b><br/>'.$message.'</p>';

                    $email_message.="Please find the attachment";
                   

                    $mail->Body =    $email_message;

                  //    // Attach the PDF file
                  //    if (isset($_FILES['certificate'])) {
                  //       $pdfFile = $_FILES['certificate'];
                  //       $mail->addAttachment($pdfFile['tmp_name'], $pdfFile['name']);
                  //   }

                  //   // Attach the PNG file
                  //   if (isset($_FILES['certificate'])) {
                  //       $pngFile = $_FILES['certificate'];
                  //       $mail->addAttachment($pngFile['tmp_name'], $pngFile['name']);
                  //   }

                  //   // Attach the JPEG file
                  //   if (isset($_FILES['certificate'])) {
                  //       $jpegFile = $_FILES['certificate'];
                  //       $mail->addAttachment($jpegFile['tmp_name'], $jpegFile['name']);
                  //   }


                     if($mail->send()) {
                     echo "<div class='alert alert-success alert-dismissible fade show position-fixed' style='top: 150px; right: 20px; z-index: 1050;' role='alert'>
                              <strong>Welldone!!!</strong> Application sent successfully.
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                              </div>";
                           $totalSent+=1;
                     }else{
                        array_push($failedEmails, $receiver);
                     }
                  }
                
				if($totalSent == $totalReceivers) {
			            echo "<div class='alert alert-success alert-dismissible fade show position-fixed' style='top: 150px; right: 20px; z-index: 1050;' role='alert'>
                        <strong>Welldone!!!</strong> Application sent successfully.
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
			    }else{
			    	if($totalSent == 0){

				    echo "<div class='alert alert-danger alert-dismissible fade show position-fixed' style='top: 150px; right: 20px; z-index: 1050;' role='alert'>
                    <strong>Error!!!</strong> Application failed to send.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
			    	}else{
			    	    echo "<div class='alert alert-danger alert-dismissible fade show position-fixed' style='top: 150px; right: 20px; z-index: 1050;' role='alert'>
                    Your email has been sent successfully. But could not send to the following emails: (". implode(",", $failedEmails).")
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";	
			    	}
			    }
            }
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- basic -->
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- mobile metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="viewport" content="initial-scale=1, maximum-scale=1">
   <!-- site metas -->
   <title>Contact</title>
   <meta name="keywords" content="">
   <meta name="description" content="">
   <meta name="author" content="">
   <!-- bootstrap css -->
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
   <!-- style css -->
   <link rel="stylesheet" type="text/css" href="css/style.css">
   <!-- Responsive-->
   <link rel="stylesheet" href="css/responsive.css">
   <!-- fevicon -->
   <link rel="icon" href="images/gayi-logo.png" type="image/gif" />
   <!-- Scrollbar Custom CSS -->
   <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
   <!-- Tweaks for older IEs-->
   <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
   <!-- fonts -->
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700&display=swap" rel="stylesheet">
   <!-- owl stylesheets -->
   <link rel="stylesheet" href="css/owl.carousel.min.css">
   <link rel="stylesheet" href="css/owl.theme.default.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css"
      media="screen">
</head>

<body>
   <!-- header section start -->
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand"><a href="index.php"><img src="images/glogo.png" width="120px" alt="logo"></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="about.php">About Us</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="project.php">Project & Impacts</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="partnership.php">Partnerships</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="membership.php">Membership</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact Us</a>
               </li>
               <li class="nav-item">
                  <button type="button" class="btn form-control" data-toggle="modal" data-target="#myModal" style="background-color:#33cc33; color: white;">Support</button>
               </li>
            </ul>
         </div>
   </nav>
   <!-- header section end -->

   <!-- banner section start -->
   <div class="container-fluid other_section">
      <div class="row">
         <div class="others">
            <h1 class="text-light banner-text other_taital">CONTACT</h1>
         </div>
      </div>
   </div>
   <!-- banner section end -->

   <!-- contact section start -->
   <div class="contact_section layout_padding">
      <div class="container">
         <div class="contact_section_2">
            <div class="row">
               <div class="col-md-6">
                  <div class="mail_section_1">
                     <h1 class="contact_taital">Contact Us</h1>
                     <form method="POST" id="mail-form" enctype="multipart/form-data">
                        <input type="text" class="mail_text_1" placeholder="Name" name="fullname">
                        <input type="text" class="mail_text_1" placeholder="Email" name="email">
                        <input type="text" class="mail_text_1" placeholder="Phone Number" name="phone_num">
                        <textarea class="massage-bt" placeholder="Leave us a Message" rows="5" id="comment"
                           name="message"></textarea>
                        <input name="send_btn" class="btn readmore_bt" type="submit" value="SEND"
                                id="submitBtn">
                     </form>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="map_main">
                     <div class="map-responsive">
                        <iframe
                           src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&amp;q=Asokoro+District,Abuja,Nigeria"
                           width="600" height="360" frameborder="0" style="border:0; width: 100%;"
                           allowfullscreen=""></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- contact section end -->

      <!-- Modal Start -->
      <div id="myModal" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h2 class="modal-title" style="color: #33cc33;"> SUPPORT OUR CAUSE</h2>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body">
               <form>
               <input type="email" id="emailInput" placeholder="Enter your email" class="form-control">
               <input type="number" id="amountInput" placeholder="Enter amount" class="form-control mt-4">
               <button type="button" id="payButton" id="start-payment-button" onclick="makePayment()" class="form-control btn mt-4" style="background-color:#33cc33; color: white;">Donate now</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Modal ends -->

   <!-- footer section start -->
   <div class="footer_section layout_padding">
      <div class="container">
         <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-3">
               <div class="footer_logo"><img src="images/glogo.png" width="150px"></div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
               <h4 class="footer_taital">NAVIGATION</h4>
               <div class="footer_menu_main">
                  <div class="footer_menu_left">
                     <div class="footer_menu">
                        <ul>
                           <li><a href="index.php">Home</a></li>
                           <li><a href="about.php">About Us</a></li>
                           <li><a href="project.php">Projects</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="footer_menu_right">
                     <div class="footer_menu">
                        <ul>
                           <li><a href="partnership.php">Partnerships</a></li>
                           <li><a href="membership.php">Membership</a></li>
                           <li><a href="contact.php">Contact US</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
               <h4 class="footer_taital">address</h4>
               <p class="footer_text">30, Eyadema Street, Asokoro District, Abuja</p>
               <p class="footer_text">+234(0)8104920484, +234(0)8132281832</p>
               <p class="footer_text">gayiafrica@gmail.com</p>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-3">
               <h4 class="footer_taital">Social Page</h4>
               <div class="social_icon">
                  <a href="https://www.facebook.com/GAYIAfrica" target="_blank"><img src="images/icon-facebook.svg"></a>
                  <a href="https://instagram.com/gayiafrica?igshid=ZDdkNTZiNTM=" target="_blank"><img src="images/icon-instagram.svg"></a>
                  <a href="https://twitter.com/GAYIAfrica?t=9LCllzyP7IlHlLFth0aW-w&s=09" target="_blank"><img src="images/icon-twitter.svg"></a>
                  <a href="https://www.linkedin.com/company/gayiafrica/" target="_blank"><img src="images/icon-linkedIn.svg"></a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- footer section end -->

   <!-- copyright section start -->
   <div class="copyright_section">
      <div class="container">
         <p class="copyright_text">copyright &COPY; GAYIAFRICA</a></p>
      </div>
   </div>
   <!-- copyright section end -->

   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <script src="js/plugin.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
   <!-- javascript -->
   <script src="js/owl.carousel.js"></script>
   <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   <script src="https://checkout.flutterwave.com/v3.js"></script>

   <script>
      const generateTransactionReference = () => {
         // Generate a unique transaction reference based on your system's logic
         const timestamp = Date.now().toString();
         const random = Math.floor(Math.random() * 100000).toString().padStart(5, '0');
         return `ORDER-${timestamp}-${random}`;
         };

      function makePayment() {
         // Generate a transaction reference
         const transactionRef = generateTransactionReference();
         const amountInput = document.getElementById('amountInput');
         const emailInput = document.getElementById('emailInput');
         const amt = parseFloat(amountInput.value);
         const mailInput = emailInput.value;

         FlutterwaveCheckout({
            public_key: "FLWPUBK-8f142644ebefd824ee83bf38469b2d2c-X",
            tx_ref: transactionRef,
            amount: amt,
            currency: "NGN",
            payment_options: "card, banktransfer, ussd",
            // redirect_url: "https://glaciers.titanic.com/handle-flutterwave-payment",
            // meta: {
            // consumer_id: 23,
            // consumer_mac: "92a3-912ba-1192a",
            // },
            customer: {
            email: mailInput,
            // phone_number: "08102909304",
            // name: "Rose DeWitt Bukater",
            },
            // customizations: {
            // title: "The Titanic Store",
            // description: "Payment for an awesome cruise",
            // logo: "https://www.logolynx.com/images/logolynx/22/2239ca38f5505fbfce7e55bbc0604386.jpeg",
            // },
         });
      }
   </script>
</body>

</html>