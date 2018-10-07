<style>
	body{
		background-image:url('http://localhost/teste-backend/v2/cms/assets/img/background-login.jpg');
		background-size: cover;
	}
</style>

<div class='container'>
	<div class='login-form'>

		<div class='row'>
			<div class='col-md-12 text-center'>
				<h2><i>CMS - Mini Blog</i></h2>
			</div>
		</div>

		<div class='row' style="margin-top: 20px">
			<div class='col-md-12'>

				<div id="alert-login"></div>

				<form id='login' type='POST'>

					<div class='form-group'>
						<label for='usuario'>Usuário: <span>admin</span></label>
						<input type='text' name='usuario' id='usuario' class='form-control' required/>	
					</div>

					<div class='form-group'>
						<label for='senha'>Senha: <span>admin</span></label>
						<input type='password' name='senha' id='senha' class='form-control' required/>
					</div>

					<div class='form-group' style='margin-top: 40px'>						
						<button type='submit' class='btn btn-lg btn-primary' id='btn-entrar'>Entrar <i class="fas fa-sign-in-alt"></i></button>
					</div>

				</form>
			</div>
		</div>
		
	</div>	
</div>