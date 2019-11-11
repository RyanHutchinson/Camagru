<div class="container" style="padding-top: 50px">
    <div class="row">
        <?php if(!isset($_GET['token'])) : ?>
        <div class="col-lg-6 col-lg-offset-3">
            <p style="align-text: center">Please enter your email address. An email will be sent to you with further instructions.</p>
            <form method="POST" class="loginForm">
                <div>
                    <input type="email" placeholder="Email" name="email">
                </div>
                <button type="submit" name="reset" value="OK">Reset</button>
            </form>
            <?php if ($_POST['reset'] == 'OK') ForgotPassword::sendemail($_POST['email']);?>
        </div>
        <?php elseif(isset($_GET['token'])) : ?>
        <div class="col-lg-6 col-lg-offset-3">
            <p style="align-text: center">Please enter a new password</p>
            <form method="POST" class="loginForm">
                <div>
                    <input title="1 Uppercase, 1 Lowercase, 1 Number, 1 Special Character...i.e. (!@#$%^&*)" type="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" placeholder="New Password" name="newPassword">
                </div>
                <div>
                    <input title="1 Uppercase, 1 Lowercase, 1 Number, 1 Special Character...i.e. (!@#$%^&*)" type="password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" placeholder="Confirm Password" name="confirmPassword">
                </div>
                <button type="submit" name="reset" value="OK">Reset</button>
            </form>
            <?php if ($_POST['reset'] == 'OK') ForgotPassword::updatePassword($_POST['newPassword'], $_POST['confirmPassword'], $_GET['token']);?>
        </div>
        <?php endif;?>
    </div>
</div>