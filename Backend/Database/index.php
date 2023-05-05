<!DOCTYPE html>
<html>

<head>
    <title>AJAX Example</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    function showPage(url) {
        $.ajax({
            url: url,
            success: function(result) {
                $("#content").html(result);
            }
        });
    }

    function showEditForm(id) {
        $.ajax({
            url: "edit_user.php?id=" + id,
            success: function(result) {
                $("#edit-form").html(result);
            }
        });
    }

    function submitEditForm() {
        $.ajax({
            url: "user.php",
            type: "POST",
            data: $("#edit-form form").serialize(),
            success: function(result) {
                $("#content").html(result);
            }
        });
    }
    </script>
</head>

<body>
    <button onclick="showPage('user.php')">Show Page 1</button>
    <button onclick="showPage('gallery.php')">Show Page 2</button>
    <div id="content"></div>
    <div id="edit-form"></div>
</body>

</html>