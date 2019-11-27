<div class="centeredSearch">

    <h1>Inscrivez-vous</h1>

    <div class="form-row">

        <div class="form-group col-md-6 mb-3">
            <label for="surname">Prénom</label>
            <input type="text" class="form-control" id="surname" placeholder="Prénom">
        </div>

        <div class="form-group col-md-6 mb-3">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" placeholder="Nom">
        </div>

    </div>
    
    <div class="form-group">
        <label for="username">Identifiant</label>
        <input type="text" class="form-control" id="username" placeholder="Username">
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" id=Inscrivez-vous"password" placeholder="Mot de passe">
    </div>

    <div class="form-group">
        <label for="passwordConfirm">Confirmation du mot de passe</label>
        <input type="password" class="form-control" id="passwordConfirm" placeholder="Confirmation du mot de passe">
    </div>

    <p for="image">Image de profile</p>

    <div class="custom-file">
        <input type="file" class="custom-file-input" id="image">
        <label class="custom-file-label" id="imageLabel" for="image">Choose file</label>
    </div>

  <button id="submit" class="btn btn-primary mt-3">Inscrire</button>

</div>

<script>
$("#submit").click(function(){

    var username = $("#username").val();
    var name = $("#name").val();
    var surname = $("#surname").val();
    var image = $("#image").val();

    if ($("#password").val() === $("#passwordConfirm").val()) {
        var password = $("#password").val();
    } else {
        alert("Passwords are differents !");
    }

    if (!username || !name || !surname || !image || !password) {
        alert("Somethings missed !");
    }
    else {
        $.ajax({
            url: "monApplicationAjax.php?action=registerProcess",
            type: "post",
            data: {
                "username": username,
                "name": name,
                "surname": surname,
                "image": image,
                "password": password
            },
            success: function(response) {
                $.get( "monApplicationAjax.php?action=login", function(data) {
                    $( "#mainContent" ).html( data );
                });
            },
            error: function(xhr) {
                console.log("fail");
            }
        });
    }
});
</script>