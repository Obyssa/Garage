<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Garage Des Trois Rivières</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet"/>
    <script src="script.js"></script>
  </head>
  <body>
    <?php include 'navbar2.php'?>
        <div class="container">
            <!--Section: Contact v.2-->
<section class="mb-4">

<!--Section heading-->
<h2 class="h1-responsive font-weight-bold text-center my-4">Nous Contacter</h2>
<!--Section description-->
<p class="text-center w-responsive mx-auto mb-5">Avez-vous la moindre question ? N'hésitez pas à nous contacter directement.
     Notre équipe reviendra vers vous.
    </p>

<div class="row">

    <!--Grid column-->
    <div class="col-md-9 mb-md-0 mb-5">
        <form id="contact-form" name="contact-form" action="mail.php" method="POST">

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="name" class="">Votre nom</label>
                        <input type="text" id="name" name="name" class="form-control">
                    </div>
                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6">
                    <div class="md-form mb-0">
                        <label for="email" class="">Votre email</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="md-form mb-0">
                        <label for="subject" class="">Sujet</label>
                        <input type="text" id="subject" name="subject" class="form-control">
                    </div>
                </div>
            </div>
            <!--Grid row-->

            <!--Grid row-->
            <div class="row">

                <!--Grid column-->
                <div class="col-md-12">

                    <div class="md-form">
                        <label for="message">Votre message</label>
                        <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                    </div>

                </div>
            </div>
            <!--Grid row-->

        </form>
        <br/>
        <div class="text-center text-md-left">
            <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit(matheo.lapena@gmail.com);">Envoyer</a>
            <?php
                if (isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    $subject = $_POST['subject'];
                    $mailFrom = $_POST['mail'];
                    $message = $_POST['message'];
                    
                    $mailTo = "matheo.lapena@gmail.com";
                    $headers = "De : ".$mailFrom;
                    $txt = "Vous avez reçu un e-mail de ".$name.".\n\n".$message;
                    
                    mail($mailTo, $subject, $txt, $headers);
                    header("Location: index.php?mailsent");
                }
            ?>
        </div>
        <div class="status"></div>
    </div>
    <!--Grid column-->
    <!--Grid column-->
    <div class="col-md-3 text-center">
        <ul class="list-unstyled mb-0">
            <li><i class="fas fa-map-marker-alt fa-2x"></i>
                <p>Route de Dijon 21120 IS-SUR-TILLE</p>
            </li>

            <li><i class="fas fa-phone mt-4 fa-2x"></i>
                <p>+33 03 80 95 05 87</p>
            </li>

            <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                <p>garagedes3rivieres@orange.fr</p>
            </li>
        </ul>
    </div>
    <!--Grid column-->

</div>

</section>
<!--Section: Contact v.2-->
            
        </div>
    <?php include 'footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>