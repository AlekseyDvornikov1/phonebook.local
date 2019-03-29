<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="App/templates/main.css">
    <title>Phonebook</title>
</head>
<body>
<nav class="navbar navbar-light custom-navbar">
    <a class="navbar-brand text-white " href="#">
        <h2>
            Phonebook
        </h2>
    </a>
</nav>
<div class="container">
    <div class="buttons"> <a href="#" class="active">Public Phonebook</a> <a href="/login" >Login</a> </div>
    <div class="block">
        <?php foreach ($users as $user):
            if($user->publish_contact == 'on'):
            ?>
        <div class="person">
            <?php echo $user->first_name . ' ' . $user->last_name?>
            <a onclick="$('#<?php echo $user->id?>').slideToggle('slow');this.innerHTML=='View details' ? this.innerHTML='Hide details' : this.innerHTML='View details';" href="javascript://">View details</a>
            <hr>
            <div class="container custom-container border border-secondary" id="<?php echo $user->id?>" style="display:none">
                <div class="row no-gutters text-warning">
                    <div class="col">
                        ADDRESS
                    </div>
                    <div class="col">
                        PHONE NUMBERS
                    </div>
                    <div class="col">
                        EMAILS
                    </div>
                </div>
                <div class="wrap">
                    <div class="column">
                        <?php
                        foreach ($addresses as $address):
                            if($address->id == $user->id):?>
                                <div><?php echo $address->address; ?></div>
                                <div><?php echo $address->zip_city; ?></div>
                                <div><?php echo $address->country->name; ?></div>
                            <?php
                            endif;
                        endforeach; ?>
                    </div>
                    <div class="column">
                        <?php
                        foreach ($numbers as $number):
                            if($number->user_id == $user->id && $number->publish == 'on' ):?>
                                <div><?php echo $number->number; ?></div>
                            <?php
                            endif;
                        endforeach; ?>
                    </div>
                    <div class="column">
                        <?php
                        foreach ($emails as $email):
                            if($email->user_id == $user->id && $email->publish == 'on'):?>
                                <div><?php echo $email->email; ?></div>
                            <?php
                            endif;
                        endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        endif;
        endforeach; ?>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="App/js/jquery-3.3.1.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>