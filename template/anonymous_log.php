<div id="anonymous_log" class="section row">
	<div class="col-md-12">
		<h2>匿名發言記錄</h2>
	</div>
	<div class="col-md-6 form-group">
		<?php
		$logFileList = view::getLogFileList();
		?>
		<select id="logFileSelect" class="form-control">
			<option value="" selected disabled>選擇記錄檔</option>
			<?php
			foreach ($logFileList as $logFileName) {
				?>
				<option value="<?=$logFileName;?>"><?=$logFileName;?></option>
				<?php
			}
			?>
		</select>
	</div>
	<div id="logTitle" class="col-md-12">
		<div class="row">
			<div class=" col-md-2">時間</div>
			<div class=" col-md-2">IP</div>
			<div class=" col-md-1">身份</div>
			<div class=" col-md-7">訊息</div>
		</div>
	</div>
	<div id="logContent" class="col-md-12"></div>
</div>
