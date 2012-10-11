<div id="login-container">
   <h3>Login</h3>
   <? if (!empty($error)): ?>
      <div class="alert alert-error">
         <i class="icon-info-sign"></i> <?= $error ?>
      </div>
   <? elseif (!empty($info)): ?>
      <div class="alert alert-info">
         <i class="icon-info-sign"></i> <?= $info ?>
      </div>
   <? endif; ?>
   <form class="well" method="POST">
      <label>Email</label>
      <?= form_input(array(
         'name' => 'email',
         'type' => 'text'
      )) ?>
      <label>Password</label>
      <?= form_input(array(
         'name' => 'password',
         'type' => 'password'
      )) ?>
      <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
      <a id="forgot-password" href="<?= site_url('admin/login/forgot_password') ?>">Forgot Password</a>
   </form>
</div>