<div class="row">
	<div class="col-md-3">
		<?php
		foreach ($roles as $roleName => $roleData) {
			?>
			<img class="anonyWhoPic" src="<?=$roleData[0]['avatar_url'];?>" data-name="<?=$roleName;?>">
			<?php
		}
		?>
	</div>
	<form class="col-md-9" role="form" action="./" method="POST">
		<div class="form-group">
			<label for="anonyWho">身份</label>
			<select id="anonyWho" class="form-control" id="exampleSelect1">
				<?php
				foreach ($roles as $roleName => $roleData) {
					?>
					<option value="<?=$roleName;?>"><?=$roleData[0]['display_name'];?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="content">訊息</label>
			<textarea id="anonyMessage" class="form-control" name="content" rows="1" placeholder="傳訊息到 #chat (上限兩千字元)" onkeyup="textAreaAdjust(this)" maxlength="2000"></textarea>
		</div>
		<div class="form-group">
			<button id="anonySubmit" type="button" class="btn btn-primary">匿名發言</button>
			<?php
			if ($isAdmin) {
				?>
				<button id="anonySubmit" type="button" class="btn btn-info">Log</button>
				<?php
			}
			?>
		</div>
	</form>
</div>