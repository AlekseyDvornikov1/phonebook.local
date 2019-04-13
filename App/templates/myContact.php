
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/App/templates/main.css">
    <title>Phonebook</title>
</head>
<body>
<nav class="navbar navbar-light custom-navbar">
    <a class="navbar-brand text-white " href="#">
        <h2>
            Phonebook
        </h2>
    </a>
    <div><a href="/login">LOGOUT</a></div>
</nav>
<div class="container">
    <div class="buttons"> <a href="home" >Public Phonebook</a> <a href="#" class="active">My contact</a> </div>
    <div class="block mycontact ">
        <form class="mycontact_form" method="post" action="">
            <div class="wrap">
                <div class="column">
                    <div><h5>CONTACT</h5></div>
                    <div class="form-group">
                            <label for="first_name">First name*</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"  required value="<?php echo $user->first_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last name*</label>
                        <input type="text" class="form-control" id="last_name" name="last_name"  required value="<?php echo $user->last_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Address*</label>
                        <input type="text" class="form-control" id="address" name="address"  required value="<?php echo $address->address; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">ZIP/City*</label>
                            <input type="text" class="form-control" id="zip" name="zip_city" required value="<?php echo $address->zip_city; ?>">
                    </div>
                    <div>
                    <label class="mr-sm-2" for="country">Country*</label>
                    <select class="custom-select mr-sm-2" id="country" name="country_id" required>
                        <option selected>Select</option>
                        <?php foreach ($countries as $country): ?>
                        <option value="<?php echo $country->id;?>" <?php if($address->country->name == $country->name){ echo ' selected'; }?>><?php echo $country->name;?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
                <div class="column">
                    <div ><h5>PHONE NUMBERS</h5></div>
                    <div id="variants">
                        <?php foreach($numbers as $number):
                            if($number->user_id == $_SESSION['user_id']):
                            ?>
                        <div class="form-group" id="phone">
                            <div class="controls">
                                <select name="publish_number[]" id="pub">
                                    <option value="on" <?php if($number->publish == 'on'): echo 'selected'; endif;?> > on</option>
                                    <option value="off" <?php if($number->publish != 'on'): echo 'selected'; endif;?>>off</option>
                                </select> <label for="pub">Publish field</label>
                                <input type="text"  class="form-control"  name="numbers[]"  id="number"   value="<?php echo $number->number; ?>">
                            </div>
                        </div>
                        <?php
                        endif;
                        endforeach; ?>
                    </div>
                    <div><a id="add" href="javascript://">+Add</a></div>
                </div>
                <div class="column">
                    <div><h5>EMAILS</h5></div>
                    <div id="variants2">
                        <?php foreach($emails as $email):
                        if($email->user_id == $_SESSION['user_id']):
                        ?>
                        <div class="form-group" id="emails">
                            <div class="controls">
                                <select name="publish_email[]" id="pub">
                                    <option value="on" <?php if($email->publish == 'on'): echo 'selected'; endif;?>>on</option>
                                    <option value="off" <?php if($email->publish != 'on'): echo 'selected'; endif;?>>off</option>
                                </select> <label for="pub">Publish field</label>
                                <input type="email" class="form-control"   name="emails[]" value="<?php echo $email->email; ?>">
                            </div>
                        </div>
                        <?php
                        endif;
                        endforeach; ?>
                    </div>
                    <div><a href="javascript://" id="add2">+Add</a></div>
                </div>
            </div>
            <div class="wrapper">
                <div class="left">* Fields are mandatory</div>
                <div class="center"><input type="checkbox" id="publish" name="publish_contact" <?php if($user->publish_contact == 'on'): echo 'checked'; endif; ?>> <label for="publish"> Publish my contact</label></div>
                <div class="right"><button type="submit">Save</button></div>
            </div>
        </form>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="App/js/jquery-3.3.1.min.js"> </script>
<script>
    $(document).ready(function() {
        const variant = $('#phone');
        $('#add').click(function() {
            variant.clone(true)
                .appendTo('#variants')
                .fadeIn('slow')
                .find('input[type=text]')
                .val('')
                .focus();
        });
    });
    $(document).ready(function() {
        const variant2 = $('#emails');
        $('#add2').click(function() {
            variant2.clone(true)
                .appendTo('#variants2')
                .fadeIn('slow')
                .find('input[type=email]')
                .val('')
                .focus();
        });
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
