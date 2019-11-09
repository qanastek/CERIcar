<div>

  <div class="form-group">
    <label for="identifier">Identifiant</label>
    <input type="text" class="form-control" id="identifier" placeholder="Entrer votre identifiant">
  </div>

  <div class="form-group">
    <label for="password">Mot de passe</label>
    <input type="password" class="form-control" id="password" placeholder="Mot de passe">
  </div>

  <button class="btn btn-primary submit">Submit</button>

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
</script>