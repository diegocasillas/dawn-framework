<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="http://localhost/miniframework/node_modules/bootstrap/dist/css/bootstrap.css">
</head>

<body class="container">
    <h1>Admin panel</h1>
    <hr>

    <h2 class="mb-4">Routes <button class="btn btn-success">Save</button></h2>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="web-tab" data-toggle="tab" href="#web" role="tab" aria-controls="web" aria-selected="true">Web</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="api-tab" data-toggle="tab" href="#api" role="tab" aria-controls="api" aria-selected="false">API</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="false">Admin</a>
        </li>
    </ul>

    <div class="tab-content border border-top-0 p-3" id="myTabContent">
        <div class="tab-pane fade show active" id="web" role="tabpanel" aria-labelledby="web-tab">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-web-get-tab" data-toggle="pill" href="#pills-web-get" role="tab" aria-controls="pills-web-get" aria-selected="true">GET</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-web-post-tab" data-toggle="pill" href="#pills-web-post" role="tab" aria-controls="pills-web-post" aria-selected="false">POST</a>
                </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-web-get" role="tabpanel" aria-labelledby="pills-web-get-tab">
                    <form>
                        <div class="row mb-2">
                            <div class="col">
                                URI
                            </div>
                            <div class="col">
                                Controller
                            </div>
                            <div class="col">
                                Action
                            </div>
                            <div class="col">
                                Authentication
                            </div>
                        </div>

                        <?php foreach ($routes['WEB']['GET'] as $route) : ?>
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="text" class="form-control" value="<?php echo $route->getOriginalUri() ?>">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="<?php echo $route->getController() ?>">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="<?php echo $route->getAction() ?>">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="<?php echo $route->options()[0] ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </form>
                </div>

                <div class="tab-pane fade" id="pills-web-post" role="tabpanel" aria-labelledby="pills-web-post-tab">
                    <form>
                        <div class="row mb-2">
                            <div class="col">
                                URI
                            </div>
                            <div class="col">
                                Controller
                            </div>
                            <div class="col">
                                Action
                            </div>
                            <div class="col">
                                Authentication
                            </div>
                        </div>

                        <?php foreach ($routes['WEB']['POST'] as $route) : ?>
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="text" class="form-control" value="<?php echo $route->getOriginalUri() ?>">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="<?php echo $route->getController() ?>">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="<?php echo $route->getAction() ?>">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" value="<?php echo $route->options()[0] ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </form>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="api" role="tabpanel" aria-labelledby="api-tab">API</div>
        <div class="tab-pane fade" id="admin" role="tabpanel" aria-labelledby="admin-tab">ADMIN</div>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>