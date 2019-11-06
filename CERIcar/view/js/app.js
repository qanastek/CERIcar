$( document ).ready(function() {

    var test84 = 0;

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
        $.getScript("CERIcar/view/js/app.js");
    });

    $(".searchButton").click(function(){
        $.get( "monApplicationAjax.php?action=searchResult&from=Paris&to=Lyon", function(data) {
            $( "#mainContent" ).html( data );
        });
    });

    $(".fieldSearchFrom").click(function(){
        $.get( "monApplicationAjax.php?action=searchVoyageFrom", function(data) {
            $( "#mainContent" ).html( data );
        });
    });

    $(".fieldSearchTo").click(function(){
        $.get( "monApplicationAjax.php?action=searchVoyageTo", function(data) {
            $( "#mainContent" ).html( data );
        });
    });

    $(".helloWorld").click(function(){
        $.ajax({
            url: "monApplicationAjax.php?action=helloWorld",
            type: "get",
            data: {},
            success: function(response) {
                $( "#mainContent" ).html(response);
            },
            error: function(xhr) {
                console.log("fail");
            }
        });
        $.getScript("CERIcar/view/js/app.js");
    });

    $(".searchVoyage").click(function(){
        $.get( "monApplicationAjax.php?action=searchVoyage", function(data) {
            $( "#mainContent" ).html( data );
        });
    });

    $(".superTest").click(function(){
        $.get( "monApplicationAjax.php?action=superTest&param1=yanis&param2=labrak", function(data) {
            $( "#mainContent" ).html( data );
        });
    });






    $(".fromSubmit").click(function(){
        alert("Hello! I am an alert box!!");
    });

});