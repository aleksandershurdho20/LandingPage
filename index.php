<?php
//index.php

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);
	return $string;
}

if(isset($_POST["submit"]))
{
	if(empty($_POST["name"]))
	{
		$error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
	}
	else
	{
		$name = clean_text($_POST["name"]);
		if(!preg_match("/^[a-zA-Z ]*$/",$name))
		{
			$error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
		}
	}
	if(empty($_POST["email"]))
	{
		$error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
	}
	else
	{
		$email = clean_text($_POST["email"]);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$error .= '<p><label class="text-danger">Invalid email format</label></p>';
		}
	}
	if(empty($_POST["subject"]))
	{
		$error .= '<p><label class="text-danger">Subject is required</label></p>';
	}
	else
	{
		$subject = clean_text($_POST["subject"]);
	}
	if(empty($_POST["message"]))
	{
		$error .= '<p><label class="text-danger">Message is required</label></p>';
	}
	else
	{
		$message = clean_text($_POST["message"]);
	}
	if($error == '')
	{
		require 'class/class.phpmailer.php';
		$mail = new PHPMailer;
		$mail->IsSMTP();								//Sets Mailer to send message using SMTP
		$mail->Host = 'smtp.mailtrap.io';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = '2525';								//Sets the default SMTP server port
		$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = '20bf21979e9cc9';					//Sets SMTP username
		$mail->Password = '18a47d18218419';					//Sets SMTP password
		$mail->SMTPSecure = '';							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From = $_POST["email"];					//Sets the From email address for the message
		$mail->FromName = $_POST["name"];				//Sets the From name of the message
		$mail->AddAddress($_POST["email"], $_POST["name"]);		//Adds a "To" address
		$mail->AddCC($_POST["email"], $_POST["name"]);	//Adds a "Cc" address
		$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
		$mail->IsHTML(true);							//Sets message type to HTML				
		$mail->Subject = $_POST["subject"];				//Sets the Subject of the message
		$mail->Body = $_POST["message"];				//An HTML or plain text message body
		if($mail->Send())								//Send an Email. Return true on success or false on error
		{
			$error = '<label class="text-success">Thank you for contacting us</label>';
		}
		else
		{
			$error = '<label class="text-danger">There is an Error</label>';
		}
		$name = '';
		$email = '';
		$subject = '';
		$message = '';
	}
}

?>





<!DOCTYPE html>
<head>
    <link rel ="stylesheet" href="main.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>E-coomerce</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css" integrity="sha384-Bfad6CLCknfcloXFOyFnlgtENryhrpZCe29RTifKEixXQZ38WheV+i/6YWSzkz3V" crossorigin="anonymous">


</head>
<body>
    <!-- HERO -->
    <div class="header position-fixed">
        <span class="text-white font-weight-bold">Approfitta dell'offerta valida ancora</span>
        <span id="counter"></span>
        <button class="btn btn-primary header-btn font-weight-bold">Acquista</button>
    </div>
    <div class="hero" id="home">
        <div class="inner-text d-flex text-center justify-content-center text-white">
            <h3 class="text-rotator d-flex text-center mb-3">SNELLISCI CON I NUOVI SLIM JEGGINS</h3>
        </div>
        <div class="divider"></div>
        <h3 class="text-white text-center outer">Senza zip né bottoni: non stringono e non segnano!</h3>
        <div class="scroll">
            <a href="#contact">
                <i class="fas fa-arrow-down mt-2"></i>
            </a>
        </div>
    </div>

    <!-- PRODUCT Intro -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="image-wrapper"></div>
            </div>
            <div class="col-md-4">
                <div class="text-wrapper">
                    <h4>Provali Subito</h4>
                    <div class="title-seperator"></div>
                    <p class="product-description text-muted">I tuoi nuovi jeans snellenti e confortevoli</p>
                    <p>Comodissimi grazie alla banda in vita che appiattisce la pancia e snellisce i fianchi.</p>
                    <a href="#contact" class="cta-contact">Acquista</a>
                </div>
            </div>
        </div>
    </div>
    <!-- OTHER PRODUCT DETAILS -->
    <div class="container-fluid bg-dark">
        <div class="row">
            <div class="col-md-3">
                <h5 class="details-title mt-5 mb-5">Addio Inestetismi</h5>
                <p class="description text-white mb-5 pb-5">
                    Glutei sollevati, all’apparenza più sodi. Nessun rotolino né piega, silhouette tonificata nei punti critici.
                </p>
            </div>
            <div class="col-md-3">
                <h5 class="details-title mt-5 mb-5">Addio Inestetismi</h5>
                <p class="description text-white mb-5 pb-5">
                    Glutei sollevati, all’apparenza più sodi. Nessun rotolino né piega, silhouette tonificata nei punti critici.
                </p>
            </div>
            <div class="col-md-3">
                <h5 class="details-title mt-5 mb-5">Addio Inestetismi</h5>
                <p class="description text-white mb-5 pb-5">
                    Glutei sollevati, all’apparenza più sodi. Nessun rotolino né piega, silhouette tonificata nei punti critici.
                </p>
            </div>
            <div class="col-md-3">
                <h5 class="details-title mt-5 mb-5">Addio Inestetismi</h5>
                <p class="description text-white mb-5 pb-5">
                    Glutei sollevati, all’apparenza più sodi. Nessun rotolino né piega, silhouette tonificata nei punti critici.
                </p>
            </div>
        </div>
    </div>
    <!-- TEAM SECTION -->
    <div class="row">
        <div class="container">
            <div id="team" class="position-relative w-100 bg-white team-wrapper">
                <div class="innter-team">
                    <h1 class="text-center">Chi l'ha provata</h1>
                    <div class="team-seperator"></div>
                    <p class="text-center team-description-intro">
                        Regalati una silhouette perfetta con i nuovi Slim Jeggins, i rivoluzionari pantaloni elasticizzati studiati donare alla tua figura un effetto snellente, combinando stile e comodità. Legging push up tipo jeans, un
                        capo alla moda capace di modellare i tuoi punti critici, regalandoti una linea più slanciata.
                    </p>
                </div>
               
                <div id="teamCarosel" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="avatar-wrapper d-flex justify-content-center mt-4">
                                <img src="avatar.jpg" alt="avatar" class="avatar-photo"/>
                            </div>
                            <h5 class="text-center">Antonella, 34 Anni</h5>
                            <p class="text-center text-muted">Caselinga</p>
                            <p class="text-center team-description-intro">Gli Slim Jeggins sono davvero comodi, inoltre sono facilissimi da indossare. Li trovo sensazionali: mi fanno sembrare molto più magra e questo aumenta la mia autostima</p>
                        </div>
                        <div class="carousel-item">
                            <div class="avatar-wrapper d-flex justify-content-center mt-4">
                                <img src="avatar.jpg" alt="avatar" class="avatar-photo"/>
                            </div>
                            <h5 class="text-center">Giovanna, 34 Anni</h5>
                            <p class="text-center text-muted">Caselinga</p>
                            <p class="text-center team-description-intro">Gli Slim Jeggins sono davvero comodi, inoltre sono facilissimi da indossare. Li trovo sensazionali: mi fanno sembrare molto più magra e questo aumenta la mia autostima</p>
                        </div>
                        <div class="carousel-item">
                            <!-- <img src="avatar.jpg" class="avatar-photo" /> -->
                            <div class="avatar-wrapper d-flex justify-content-center mt-4">
                                <img src="avatar.jpg" alt="avatar" class="avatar-photo"/>
                            </div>
                            <h5 class="text-center">Isabella, 34 Anni</h5>
                            <p class="text-center text-muted">Caselinga</p>
                            <p class="text-center team-description-intro">Gli Slim Jeggins sono davvero comodi, inoltre sono facilissimi da indossare. Li trovo sensazionali: mi fanno sembrare molto più magra e questo aumenta la mia autostima</p>
                        </div>
                        <div class="carousel-item">
                            <!-- <img src="avatar.jpg" class="avatar-photo" /> -->
                            <div class="avatar-wrapper d-flex justify-content-center mt-4">
                                <img src="avatar.jpg" alt="avatar" class="avatar-photo"/>
                            </div>
                            <h5 class="text-center">Carolina, 34 Anni</h5>
                            <p class="text-center text-muted">Medico</p>
                            <p class="text-center team-description-intro">Gli Slim Jeggins sono davvero comodi, inoltre sono facilissimi da indossare. Li trovo sensazionali: mi fanno sembrare molto più magra e questo aumenta la mia autostima</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-3">
                <a href="#" data-target="#teamCarosel" data-slide-to="0" class="active">
                    <img src="avatar.jpg" class="avatars-photo" width="50px" height="50px" />
                </a>
            </div>
            <div class="col-md-3">
                <a data-target="#teamCarosel" data-slide-to="1">
                    <img src="avatar.jpg" class="avatars-photo" width="50px" height="50px" />
                </a>
            </div>
            <div class="col-md-3">
                <a data-target="#teamCarosel" data-slide-to="2">
                    <img src="avatar.jpg" class="avatars-photo" width="50px" height="50px" />
                </a>
            </div>
            <div class="col-md-3">
                <a data-target="#teamCarosel" data-slide-to="3">
                    <img src="avatar.jpg" class="avatars-photo" width="50px" height="50px" />
                </a>
            </div>
        </div>
        <div class="dashed-seperator"></div>
    </div>
    <div class="row">
        <div class="container">
            <div class="offer-section pt-5 mt-5">
                <h1 class="text-center">COSA INCLUDE IL SET</h1>
                <div class="offer-seperator"></div>
                <p class="text-center">Solo per oggi potrai beneficiare di uno sconto speciale. Acquista ora Slim Jeggins e non avrai uno, né due, ma ben 3 paia di Slim Jeggins. E' un offerta riservata ai clienti online. Subito a casa tua 3 paia di Slim Jeggins nei colori blu, grigio e nero. Acquistali subito al prezzo speciale di 59 euro. Hai capito bene, solo 59 euro per 3 paia di Slim Jeggins<br>
                    <b>Cosa aspetti? Provali subito!</b></p>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary font-weight-bold" href="#contact">Acquita</a>
                    </div>
                    <div class="spacer"></div>
                    <h1 class="text-center">SOLO PER OGGI IN OFFERTA </h1>
                    <div class="offer-seperator"></div>
                    <p class="text-center">Non lo trovi nei negozi, approfitta oggi dell'offerta esclusiva</p>
                    <div class="spacer"></div>
                  

            </div>
        </div>
    </div>
    <div class="row">
        <div class="container-fluid offer-container">
            <h6 class="text-center pt-5 mt-2 offer-title">COSA INCLUDE IL SET</h6>
            <!-- <div class="offer-seperator"></div> -->
            <span class="text-center d-flex justify-content-center offer-title offer-paragrap">L'offerta è limitata e disponibile solo online!</span>

        </div>
    </div>
    <div class="row">
        <div class="container">
            <h1 class="text-center mt-3 pt-3">ACQUISTA ORA </h1>
            <div class="offer-seperator"></div>
            <p class="text-center">Alza i glutei, appari più magra <b>Ora</b></p>
        </div>
    </div>
    <div class="container contact-form" id="contact">
        <form action ="index.php" method="post">
            <h3 class="text-center">COMPILA IL MODULO</h3>
            <div class="form-group">
                <label>Nome e Cognome</label>
                <input type="text" name="name" class="form-control" placeholder="Inserisci Nome e Cognome" required="required">  
            </div>
            <div class="form-group">
                <label>Telefono (Meglio Cellulare)</label>
                <input type="text" name="phone" class="form-control" placeholder=" telefono" required="required">
            </div>
            <div class="form-group">
                <label>Indirizzo e n. civico</label>
                <input type="text" name="address" class="form-control" placeholder="adress" required="required">
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                   <label>Città</label>
                   <input type="text" name="city" class="form-control" placeholder=" Milano" required="required">    
                </div>
                <div class="form-group col-md-4">
                   <label>CAP</label>
                   <input type="text" name="zipcode" class="form-control" placeholder="ES. 94112" required="required">    
                </div>
             </div>
             <div class="form-group">
                 <label>Email</label>
                 <input type="email" name="email" class="form-control" placeholder=" e-mail">

             </div>
             <div class="form-group col text-center">
                <span>Offerta attiva:</span>
                <h5>Tris di Jeggings 59 €</h5>
                <select name="quantity" class="d-none" required="required">
                   <option value="1" selected="selected">Tris di Jeggings 59 €</option>
                </select>
             </div>
             <div class="form-group">
                <label>Come preferisci pagare?</label> 
                <select name="payment_type" class="form-control">
                   <option value="C">In contanti al corriere</option>
                   <option value="P">Con carta di credito o paypal</option>
                </select>
             </div>
             <div class="form-group">
                <div class="text-center">
                   <span class="truct-ctc"> <i class="fa fa-truck "></i> La spedizione è gratis! </span>
                </div>
             </div>
             <div class="form-group">
                <label>Note per il corriere</label>
                <input type="text" name="message" class="form-control" rows="2" placeholder="note">
             </div>
             <div class="d-flex justify-content-center">
                <div id="info-privacy"><small>Cliccando "Completa l'acquisto" confermi di aver preso visione <a href="#">dell'informativa sulla privacy</a>.</small></div>
             </div>
             <button id="submit-button" class="btn btn-lg btn-warning mt-3" name="submit" type="submit">Completa l'acquisto</button>
             <div class="contact-seperator"></div>
        </form>
    </div>
    <div class="footer text-center">
        <a href="#">Contatti</a>
    </div>
</body>


</html>

<script>
    var countdown = 15*60*1000;
    var timerId = setInterval(function(){
      countdown -= 1000;
      var min = Math.floor(countdown / (60 * 1000));
      //var sec = Math.floor(countdown - (min * 60 * 1000));  
      var sec = Math.floor((countdown - (min * 60 * 1000)) / 1000); 
    
      if (countdown <= 0) {
        //  alert("offer finished!");
         clearInterval(timerId);
      } else {
         $("#counter").html(min + " : " + sec);
      }
      
    
    }, 1000); //1000ms.
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
