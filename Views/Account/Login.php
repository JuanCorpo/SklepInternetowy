<?php
function AccountLoginView($model)
{
    ?>
    <div class="row">
        <div class="form-group col-md-12">


            <ul class="nav nav-tabs">
                <li class="nav-item col-md-offset-4" style="font-size: 20px;">
                    <a class="nav-link active" data-toggle="tab" href="#home">Logowanie</a>
                </li>
                <li class="nav-item col-md-offset-1" style="font-size: 20px;">
                    <a class="nav-link" data-toggle="tab" href="#profile">Rejestracja</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <br/>
                <div class="tab-pane fade active in" id="home">
                    <form id="loginForm" method="post" action="/Account/LoginPost">
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-4 col-md-offset-4">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4 col-md-offset-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-4 col-md-offset-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="remeberMe">
                                            Zapamiętaj mnie
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary col-md-6">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="tab-pane fade" id="profile">
                    <form id="registerForm" method="post" action="/Account/RegisterPost">
                        <fieldset>
                            <div class="row">
                                <div class="form-group col-md-4 col-md-offset-4">
                                    <label for="newEmail">Email address</label>
                                    <input type="email" class="form-control" id="newEmail" name="newEmail" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4 col-md-offset-4">
                                    <label for="newPassword">Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Password">
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-4 col-md-offset-4">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="News">
                                            Newsletter
                                        </label>
                                    </div>

                                    <div class="form-check disabled">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" name="Reg">
                                            Regulamin
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-primary col-md-4">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>


        </div>
    </div>





<?php
}
?>

