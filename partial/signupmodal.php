
<!-- Modal -->
<div class="modal fade" id="signupmodal" tabindex="-1" aria-labelledby="signupmodalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="signupmodalLabel">Signup</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="partial/actionsignupmodal.php" method="POST">

					<div class="mb-3">
						<label for="exampleInputname" class="form-label">Name</label>
						<input type="text" class="form-control" id="name" name="name" required>
					</div>

					<div class="mb-3">
						<label for="exampleInputEmail1" class="form-label">Email address</label>
						<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
					</div>

					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" required>
					</div>

					<div class="mb-3">
						<label for="exampleInputPassword1" class="form-label">Confirm Password</label>
						<input type="password" class="form-control" id="cpassword" name="cpassword" required>
					</div>


					<button type="submit" class="btn btn-primary" name="submit">Submit</button>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
