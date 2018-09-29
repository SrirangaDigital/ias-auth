<script type="text/javascript"> $(document).ready(function() { $( "#loginForm" ).submit(submitLoginForm); }); </script>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-6">
			<div id="result" class="hide alert alert-danger">&nbsp;</div>
			<form id="loginForm" method="POST">
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input required type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input required type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password">
				</div>
				<button id="submit" type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
</div>