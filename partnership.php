<?php 
    		$rsp="";
    		if(isset($_POST['send_btn'])){
				include('./mail/PHPMailerAutoload.php');
                $organizationName = $_POST['organization_name'];
                $repName = $_POST['representative_name'];
                $phone = $_POST['phone_number'];
                $strength = $_POST['strength'];
                $focus = $_POST['focus'];
                $partnerArea = $_POST['partnership_area'];
                $contact = $_POST['contact_number'];
                $country = $_POST['country'];
                $state = $_POST['state'];
                $address = $_POST['address'];
                $email = $_POST['email'];
                $intention = $_POST['intention'];

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

				    $mail->Subject = $organizationName;
				    $email_message = '<h2>GayiAfrica Partnership form Submitted</h2>
                    <p><b>Organization Name:</b> '.$organizationName.'</p>
                    <p><b>Represenatative Name:</b> '.$repName.'</p>
                    <p><b>Phone Number:</b> '.$phone.'</p>
                    <p><b>Strength:</b> '.$strength.'</p>
                    <p><b>Focus:</b> '.$focus.'</p>
                    <p><b>Partnership Area:</b> '.$partnerArea.'</p>
                    <p><b>Contact Number:</b> '.$contact.'</p>
                    <p><b>Country:</b> '.$country.'</p>
                    <p><b>State:</b> '.$state.'</p>
                    <p><b>Address:</b> '.$address.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Intention:</b><br/>'.$intention.'</p>';
                    $email_message.="Please find the attachment";
                   

                    $mail->Body =    $email_message;

                     // Attach the PDF file
                     if (isset($_FILES['certificate'])) {
                        $pdfFile = $_FILES['certificate'];
                        $mail->addAttachment($pdfFile['tmp_name'], $pdfFile['name']);
                    }

                    // Attach the PNG file
                    if (isset($_FILES['certificate'])) {
                        $pngFile = $_FILES['certificate'];
                        $mail->addAttachment($pngFile['tmp_name'], $pngFile['name']);
                    }

                    // Attach the JPEG file
                    if (isset($_FILES['certificate'])) {
                        $jpegFile = $_FILES['certificate'];
                        $mail->addAttachment($jpegFile['tmp_name'], $jpegFile['name']);
                    }

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
   <title>PARTNERSHIP</title>
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
                  <button type="button" class="btn form-control" data-toggle="modal" data-target="#myModal" style="background-color:#33cc33; color: white; margin:auto;">Support</button>
               </li>
            </ul>
         </div>
   </nav>
   <!-- header section end -->

   <!-- banner section start -->
   <div class="container-fluid partnership_section">
      <div class="row">
         <div class="others">
            <h1 class="text-light banner-text other_taital">PARTNERSHIP</h1>
         </div>
      </div>
   </div>
   <!-- banner section end -->

   <!-- Application Form Start -->
   <div class="container">
      <div class="row">
         <div class="col-lg-6 apply-left">
            <img src="images/apply.jpg" alt="" class="apply-img">
         </div>
         <div class="col-lg-6 apply-right mb-5">
            <h1 class="mt-5 text-center">PARTNERSHIP FORM</h1>
            <h4 class="text-center">Partner with us, lets build a better Africa together.</h4>
            <div class="form-section">
            <form method="POST" id="mail-form" enctype="multipart/form-data">
                  <div class="slide" id="slide1">
                     <div class="form-group">
                        <input type="text" placeholder="Name of the organization" class="form-control"
                           name="organization_name">
                     </div>
                     <div class="form-group">
                        <input type="text" placeholder="Name of the representative" class="form-control"
                           name="representative_name">
                     </div>
                     <div class="form-group">
                        <input type="number" placeholder="Mobile number of representative" class="form-control"
                           name="phone_number">
                     </div>
                     <div class="form-group">
                        <input type="text" placeholder="Strength" class="form-control" name="strength">
                     </div>
                     <div class="form-group">
                        <input type="text" placeholder="Organization focus" class="form-control" name="focus">
                     </div>
                     <div class="form-group">
                        <input type="text" placeholder="Area of partnership" class="form-control"
                           name="partnership_area">
                     </div>
                     <div class="form-group">
                        <input type="number" placeholder="Contact Number" class="form-control" name="contact_number">
                     </div>
                     <div style="float: right;">
                        <button type="button" class="btn readmore_bt" onclick="nextSlide()">Next
                           Step</button>
                     </div>
                  </div>
                  <div class="slide" id="slide2">
                     <div class="form-group">
                        <input type="text" placeholder="Country" class="form-control" name="country">
                     </div>
                     <div class="form-group">
                        <input type="text" placeholder="State" class="form-control" name="state">
                     </div>
                     <div class="form-group">
                        <input type="text" placeholder="Address" class="form-control" name="address">
                     </div>
                     <div class="form-group">
                        <input type="email" placeholder="Email" class="form-control" name="email">
                     </div>
                     <div class="form-group">
                        <label for="certificate">Upload Documents (Certificate or Profile)</label>
                        <input type="file" class="form-control" name="certificate">
                     </div>
                     <div class="form-group">
                        <textarea rows="5" placeholder="Write a letter of intention" class="form-control"
                           name="intention"></textarea>
                     </div>
                     <div class="d-flex justify-content-between">
                        <button type="button" class="btn readmore_bt" onclick="prevSlide()">back</button>
                        <input name="send_btn" class="btn readmore_bt" type="submit" value="Submit"
                                id="submitBtn">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <!-- Application Form End -->

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

   <script>
      let currentSlide = 1;
      showSlide(currentSlide);

      function showSlide(n) {
         const slides = document.getElementsByClassName("slide");
         for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
         }
         slides[currentSlide - 1].style.display = "block";
      }

      function nextSlide() {
         if (currentSlide < 2) {
            currentSlide++;
            showSlide(currentSlide);
         }
      }

      function prevSlide() {
         if (currentSlide > 1) {
            currentSlide--;
            showSlide(currentSlide);
         }
      }

   </script>
</body>

</html>