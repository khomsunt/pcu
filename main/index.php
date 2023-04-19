<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <div id="root"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <script>
		$(function(){
			loadPage("../template/default.php","root");
			loadPage("../main/topbar.php","topbar");
			loadPage("../main/sidebar.php","sidebar");
			loadPage("../main/dashbord.php","display");
		})
    function loadPage(url, target) {
        $.ajax({
                method: "POST",
                url: url,
                data: {
                    name: "John",
                    location: "Boston"
                }
            })
            .done(function(msg) {
				$("#" + target).html(msg);
            });
    }
    </script>
</body>

</html>