<div class="container pt-4 d-flex flex-column justify-content-center">
    <?php if (isset($_GET['sts'])) {
        if ($_GET['sts'] == 1) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5> Password Changed Successfully.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        } elseif ($_GET['sts'] == -1) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5>Password Changed Failed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        } elseif ($_GET['sts'] == 2) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5>Old Password Incorrect</h5>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
        } else {
            ?>
            <div class="Calert fail">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5>Password Mismatch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
            <?php
        }
    }
    ?>
    <div class="d-flex align-items-center align-content-center justify-content-center">
        <form action="chgpwd_query.php" method="post">
            <h2>Change Password</h2>

            <label for="new_password">Old Password:</label>
            <input type="password" name="old_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>

            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" required>

            <button type="submit">Change Password</button>
        </form>
    </div>
</div>