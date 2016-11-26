<div id="anonymous_message" class="section row">
	<div class="col-md-3">
		<?php
		$roles = view::getRoles();
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
			<select id="anonyWho" class="form-control">
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
		</div>
	</form>
	<div class="col-md-12">
		<div class="alert alert-info col-md-12" role="alert">
			<strong>注意</strong>
			根據現行法律規定，網路發言不論具名、匿名，都需承擔法律責任，請注意發言用詞以免造成他人困擾！
		</div>
	</div>
</div>