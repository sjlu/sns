<div class="container">
	<div id="buttons">
		<a class="btn btn-primary btn-large" href="<?= base_url('/login') ?>">Login</a>
		<a class="btn btn-large" href="<?= base_url('/register') ?>">Register</a>
	</div>
   <div class="hero-unit">
      <div class="row">
         <div class="span2">
            <img src="<?= base_url('assets/img/icon.png') ?>" alt="logo" />
         </div>
         <div class="span8">
            <h2>Simple Notification Service</h2>
            <p><u>Simple Notification Service</u> or <strong>SNS</strong> allows you to send any notification you want straight to your iOS devices. This service was built from the ground up with speed and scalability in mind. It's easy to use and has a full fledged API to interact with the service. The best part, it's completely free to use.</p>
      </div>
      </div>
   </div>
   <h2>API Documentation</h2>
   <div class="well">
   	<h4>POST /api/notification</h4>
   	<p>As easy as that, <strong>POST</strong> to that endpoint to send a message to a device.</p>

   	<h5>Inputs</h5>
   	<table class="table table-bordered table-hover">
   		<thead>
   			<tr>
   				<th>Input</th>
   				<th>Required</th>
   				<th width="60%">Description</th>
   			</tr>
   		</thead>
   		<tbody>
   			<tr>
   				<td>key</td>
   				<td><span class="label label-important">required</span></td>
   				<td>The API key to post the message to, this string is typically 32 characters long.</td>
   			</tr>
   			<tr>
   				<td>subject</td>
   				<td><span class="label label-important">required</span></td>
   				<td>Message subject string, can be anything you like at a maximum of 128 characters.</td>
   			</tr>
   			<tr>
   				<td>message</td>
   				<td><span class="label label-important">required</span></td>
   				<td>The actual message, can be anything, as long as you like.</td>
   			</tr>
   		</tbody>
   	</table>

   	<h5>Success Response</h5>
   	<code>{"success":"Notification added."}</code>

   	<h5>Error Responses</h5>
   	<table class="table table-bordered table-hover">
   		<thead>
   			<tr>
   				<th>Code</th>
   				<th width="80%">Description</th>
   			</tr>
   		</thead>
   		<tbody>
   			<tr>
   				<td>100</td>
   				<td>Inputs are missing.</td>
   			</tr>
   			<tr>
   				<td>300</td>
   				<td>API Key is not valid.</td>
   			</tr>
   		</tbody>
   	</table>
   </div>
   <p class="pull-right">A free service provided with <i class="icon-heart"></i> from <a href="http://burst-dev.com">Burst Development</a>, developed by <a href="http://stevenlu.com">Steven Lu</a></p>
</div>
