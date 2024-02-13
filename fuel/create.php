<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="create.css">
    <link rel="icon" type="image" href="../car2.png">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="d-flex justify-content-center">
            <div class="row">
                <div class="col-md-12">
                    <br><br>
                    <div class="login-box">
                        <h2 class="pull-left">Create New Entry
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        </h2>
                    </div>
                    <br>
                    <br>
                    <form action="insert.php" method="post">
                    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Km</label>
                <input name="km" class="form-control" value="KM">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="inputState">Fuel Type</label>
                <select id="inputState" name="fuel" class="form-control">
                    <option value="Gas" selected>Gas</option>
                    <option value="Petrol">Petrol</option>
                    <option value="Gas & Petrol">Gas & Petrol</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Fuel Price</label>
                <input name="price" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Liter</label>
                <input name="liter" class="form-control" value="">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Amount</label>
                <input name="amount" class="form-control">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="submit" class="btn btn-primary" value="Submit" name="submit">
            <a href="fuel.php" class="btn btn-secondary ml-2">Cancel</a>
        </div>
    </div>
</div>

                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>