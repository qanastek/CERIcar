<div class="row" style="height: 80vh; width: 100%;">
        <div class="col-md-6">

        <div style="padding-left: 3%; padding-right: 3%;">

            <div class="form-group">
            <label for="identifier" class="title-login">Identifiant</label>
            <input type="text" class="form-control" id="identifier" placeholder="Entrer votre identifiant">
            </div>

            <div class="form-group">
            <label for="password" class="title-login">Mot de passe</label>
            <input type="password" class="form-control" id="password" placeholder="Mot de passe">
            </div>

            <button class="btn btn-primary submit" style="background-color: #29aff5; border-color: #29aff5;">Login</button>
            <button class="btn btn-primary register" style="background-color: #29aff5; border-color: #29aff5;">Register</button>

        </div>
    </div>

    <div class="col-md-6" style="padding: 0px;">
        <img src="<?php echo $context->getImages($nameApp, 'login.jpg'); ?>" style="width: 100%; height: 100%; object-fit: cover; overflow: hidden;">
    </div>

</div>

<script>
$(".submit").click(function(){
    $.ajax({
        url: "monApplicationAjax.php?action=loginProcess",
        type: "post",
        data: {
            "identifier": $("#identifier").val(),
            "password": $("#password").val()
        },
        success: function(response) {
            $.get( "monApplicationAjax.php?action=header", function(header) {
                $( "#header" ).html(header);

                $.get( "monApplicationAjax.php?action=index", function(data) {
                    $( "#mainContent" ).html(data);
                });
            });
        },
        error: function(xhr) {
            $.get( "monApplicationAjax.php?action=banner", function(banner) {
                $( "#statusBar" ).html(banner);
            });
        }
    });
});

$(".register").click(function(){
    $.get( "monApplicationAjax.php?action=register", function(data) {
        $( "#mainContent" ).html( data );
    });

    $.get( "monApplicationAjax.php?action=banner", function(banner) {
        $( "#statusBar" ).html( banner );
    });
});
</script>