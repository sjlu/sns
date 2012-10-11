<div style="width: 420px; margin: 0 auto;">
   <h3>Login</h3>
   <? if (!empty($error)): ?>
      <div class="alert alert-error" style="margin-bottom: 5px;">
         <i class="icon-info-sign" style="margin-right: 5px;"></i> <?= $error ?>
      </div>
   <? elseif (!empty($info)): ?>
      <div class="alert alert-info" style="margin-bottom: 5px;">
         <i class="icon-info-sign" style="margin-right: 5px;"></i> <?= $info ?>
      </div>
   <? endif; ?>
   <form class="well" method="POST">
      <label>Email</label>
      <?= form_input(array(
         'name' => 'email',
         'style' => 'width: 360px;',
         'type' => 'text'
      )) ?>
      <label>Password</label>
      <?= form_input(array(
         'name' => 'password',
         'style' => 'width: 360px;',
         'type' => 'password'
      )) ?>
      <label>Confirm Password</label>
      <?= form_input(array(
         'name' => 'confirm_password',
         'style' => 'width: 360px;',
         'type' => 'password'
      )) ?>
      <button type="submit" name="submit" value="submit" class="btn btn-primary">Register</button>
   </form>
</div>
