<p id="test">
    Ceci est un super <?php echo $context->mavariable ?> ! dingue non ? 
</p>

<button class="searchRoot">
    go back to index
</button>

<button onclick="$('#test').css({'color':'red'});"></button>

<script>
$(".searchRoot").click(function(){
    $.ajax({
        url: "monApplicationAjax.php?action=index",
        type: "get",
        data: {},
        success: function(response) {
            $( "#mainContent" ).html(response);
        },
        error: function(xhr) {
            console.log("fail");
        }
    });
});
</script>