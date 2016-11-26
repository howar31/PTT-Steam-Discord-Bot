<div id="login" class="section row">
	<form class="col-md-6 offset-md-3" role="form" action="./" method="POST">
		<div class="form-group">
			<h2>歡迎來到 PTT Steam - Discord</h2>
		</div>
		<div class="form-group">
			<label for="loginPW">通關密語請於 Discord 頻道內洽詢</label>
			<input type="password" id="loginPW" name="loginPW" class="form-control" placeholder="通關密語" required>
		</div>
		<?php
		if ($isLogin) {
		?>
		<div class="alert alert-danger col-md-12" role="alert">
			<strong>等登</strong>
			通關密語不正確！
		</div>
		<?php
		}
		?>
		<div class="form-group">
			<button class="btn btn-lg btn-primary btn-block" type="submit">芝麻開門</button>
		</div>
	</form>
</div>