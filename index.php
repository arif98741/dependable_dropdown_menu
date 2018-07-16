<?php
if (file_exists('function.php')) {
    include_once 'function.php';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Dependable Dropdown Menu</title>
        <style>

            body{
                margin:0px auto;
                padding: 0px;
                max-width: 600px;
            }

            .main{
               
                margin: 50px auto;
                text-align: center;
            }
            #country,#city{
                width: 500px;
                height: 50px;
                font-size: 18px;
                margin: 0 auto;
            }

            select{
                width: 600px;
            }

        </style>

    </head>
    <body>
        <div class="main">
            <div class="dropdownmenu">
                <select name="" id="country" class="form-control">
                    <option value="">Select</option>
                    <?php
                    $con = connection();
                    $stmt = $con->query("select * from country order by name");
                    if ($stmt) {
                        ?>
                        <?php while ($r = $stmt->fetch_assoc()): ?>
                            <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
                        <?php endwhile; ?>
                    <?php } ?>
                </select>
                <br/>
                <br/>
                <select name="" id="city" class="form-control">
                    <option value="">Select</option>

                </select>
            </div>
        </div>

        <script src="assets/js/jquery.min.js"></script>   
        <script>
            $('#country').on('change', function () { //dropdown changing event
                var countryID = $(this).val(); //getting specific country id from database
                console.log(countryID);
                if (countryID !== '') {
                    $.ajax({
                        url: "fetch.php", //requesting to fetch.php for getting cities list as response
                        data: {// we are passing two values by get in the url
                            action: 'getcities',
                            countryid: countryID
                        },
                        method: 'get',
                        success: function (data) { //getting response from server
                            $('#city').html(data); //putting response to second dropdown
                            console.log(data);
                        }, error: function (e) { //this will show error if exist any
                            console.log(e); //for looking error message press ctrl+shift+i
                        }
                    });
                } else {
                    $('#city').html("<option>Select</option>");
                }
            });
        </script>

    </body>
</html>
