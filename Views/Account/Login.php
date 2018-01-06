<?php
function AccountLoginView($model, $view)
{
    if ($model === null)
        echo "<script>history.pushState(null, 'Logowanie', '/Account/Index');</script>";
    $register = "active in";
    $login = "";
    $ErrorLogin = "";
    $Email = "";

    if ($view == 0) {
        $login = "active in";
        $register = "";
    }

    if ($model != null) {
        $ErrorLogin = $model->ErrorLogin;
        $Email = $model->UserPrivateMail;
    }

    echo "
    <div class='row'>
        <div class='form-group col-md-12'>


            <ul class='nav nav-tabs'>
                <li class='nav-item col-md-offset-4 ' style='font-size: 20px;'>
                    <a class='nav-link' data-toggle='tab' href='#home'>Logowanie</a>
                </li>
                <li class='nav-item col-md-offset-1' style='font-size: 20px;'>
                    <a class='nav-link' data-toggle='tab' href='#profile'>Rejestracja</a>
                </li>
            </ul>
            <div id='myTabContent' class='tab-content'>
                <br/>
                <div class='tab-pane fade $login' id='home'>
                    <form id='loginForm' method='post' action='/Account/LoginPost'>";
    if ($model !== null) {
        echo "<input type='hidden' name='emailToken' value='" . $model->EmailConfirmToken . "' />
              <input type='hidden' name='confirmedToken' value='" . $model->EmailConfirmed . "' />";
    }
    echo "
                        <fieldset>
                            <div class='row'>
                                <div class='form-group col-md-4 col-md-offset-4'>
                                    <label for='email'>Email address</label>
                                    <input type='email' class='form-control' id='email' value='$Email' name='Email' aria-describedby='emailHelp' placeholder='Enter email'>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='form-group col-md-4 col-md-offset-4'>
                                    <label for='password'>Password</label>
                                    <input type='password' class='form-control' id='password' name='Password' placeholder='Password'>
                                </div>
                            </div>

                            <div class='row text-right'>
                                <div class='form-group col-md-4 col-md-offset-4'>
                                        <a href='#########################################'>
                                            Nie pamiętam hasła
                                        </a>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='form-group col-md-4 col-md-offset-4'>
                                    <div class='form-check'>
                                        <label class='form-check-label'>
                                            <input class='form-check-input' type='checkbox' name='RememberMe'>
                                            Zapamiętaj mnie
                                        </label>
                                    </div>
                                    <p class=\"text-danger text-center\">$ErrorLogin</p>
                                    <button type='submit' class='btn btn-primary col-md-12'>Zaloguj</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class='tab-pane fade $register' id='profile'>
                    <form id='registerForm' method='post' action='/Account/RegisterPost'>
                        <fieldset>
                            <div class='row'>
                                <div class='form-group col-md-4 col-md-offset-4'>
                                    <label for='newEmail'>Email address</label>
                                    <input type='email' class='form-control' id='newEmail' name='Email' aria-describedby='emailHelp' placeholder='Enter email'>
                                </div>
                            </div>

                            <div class='row'>
                                <div class='form-group col-md-4 col-md-offset-4'>
                                    <label for='newPassword'>Password</label>
                                    <input type='password' class='form-control' id='newPassword' name='Password' placeholder='Password'>
                                </div>
                            </div>


                            <div class='row'>
                                <div class='checkbox form-group col-md-4 col-md-offset-4'>
                                    <div class='form-check'>
                                        <label class='form-check-label'>
                                            <input class='form-check-input' type='checkbox' name='Newsletter'>
                                            Chcę otrzymywać newsletter i korzystać ze specjalnych promocji.
                                        </label>
                                    </div>

                                    <div class='checkbox form-check'>
                                        <label class='form-check-label'>
                                            <input class='form-check-input' type='checkbox' name='Policies'>
                                            Akceptuje <a href='/Site/Policies'>regulamin</a> sklepu
                                        </label>
                                    </div>
                                    <p class=\"text-danger text-center\">$ErrorLogin</p>
                                    <button type='submit' class='btn btn-primary col-md-12'>Zarejestruj</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
";
}


