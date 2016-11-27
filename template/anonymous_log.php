<div id="anonymous_log" class="section row">
	<div class="col-md-12">
		<h2>匿名發言記錄</h2>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<?php
			$logFileList = view::getLogFileList();
			?>
			<select id="logFileSelect" class="form-control col-xl-6 col-md-7">
				<option value="" selected disabled>選擇記錄檔</option>
				<?php
				foreach ($logFileList as $logFileName) {
					?>
					<option value="<?=$logFileName;?>"><?=$logFileName;?></option>
					<?php
				}
				?>
			</select>
			<button id="logRefresh" type="button" class="btn btn-info col-xl-1 offset-xl-5 col-md-2 offset-md-3">重新整理</button>
		</div>
	</div>
	<div id="logTitle" class="col-md-12">
		<div class="row">
			<div class="col-xl-2 col-md-3">時間</div>
			<div class="col-xl-2 col-md-9">IP</div>
			<div class="col-xl-1 col-md-3">身份</div>
			<div class="col-xl-7 col-md-9">訊息</div>
		</div>
	</div>
	<div id="logContent" class="col-md-12"></div>
</div>
