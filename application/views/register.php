<div style="width: 420px; margin: 0 auto;">
   <h3>Login</h3>
   <? if (!empty($error)): ?>
      <div class="alert alert-error" style="margin-bottom: 5px;">
         <b>Error!</b> <?= $error ?>
      </div>
   <? elseif (!empty($info)): ?>
      <div class="alert alert-info" style="margin-bottom: 5px;">
         <b>Info.</b> <?= $info ?>
      </div>
   <? endif; ?>
   <form class="well" method="POST">
      <label>Email</label>
      <input type="text" name="email" style="width: 360px;" <? if (!empty($email)): ?> value="<?= $email ?>" <? endif; ?>>
      <label>Password</label>
      <input type="password" name="password" style="width: 360px;">
      <label>Confirm Password</label>
      <input type="password" name="confirm_password" style="width: 360px;">
      <button type="submit" class="btn btn-primary">Register</button>
   </form>
</div>
