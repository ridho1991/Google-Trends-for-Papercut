<div class="wrap bootstrap-wpadmin" >
	<div class="container-fluid">
		<h2 style="margin-bottom:10px">Google Trends for Papercut</h2>
		<div class="row">
		
			<div class="col-sm-12">
			<?php if($this->alert){
				echo $this->alert;
			} ?>
			<?php if($trends_count < 1){ ?>
			<div class="alert alert-warning">
				<input type="hidden" value="" name="run_gtp"/>
				<?php wp_nonce_field( "run_gtp" , "_run_gtp" ); ?>
				No Trends, please run this <button class="btn btn-default" data-toggle="modal" data-target="#run_gtp" ><span class="glyphicon glyphicon-play"></span>RUN</button></a>.
			</div>
			<?php } ?>
			
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9">
				<div class="panel panel-default panel-collapse collapse" id="gtp_setting" >
					<div class="panel-heading">
						<h3 class="panel-title">GTP Setting</h3>
					</div>
					<div class="panel-body">
						<form class="form-horizontal" method="post" role="form">
							<fieldset>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="gtp_setting[trends_schedule]">Trends Schedule</label>
									<div class="col-sm-7">
									<select name="gtp_setting[trends_schedule]" id="gtp_setting[trends_schedule]" class="form-control">
										<?php foreach( $schedules as $sched_name=>$sched_data ) { ?>
										<option <?php selected($gtp_settings->trends_schedule, $sched_name); ?> value="<?php echo $sched_name ?>"><?php echo $sched_data['display'] ?></option>
										<?php }?>
									</select>
									 <p class="help-block">How often the plugin fetch the hot trends</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="gtp_setting[trends_country]">Trends Country</label>
									<div class="col-sm-7">
									<select name="gtp_setting[trends_country]" id="gtp_setting[trends_country]" class="form-control">
										<?php
										foreach ($gtp_trends_country as $country):?>
										<option value="<?php echo $country->code; ?>" <?php if($gtp_settings->trends_country === $country->code): ?>selected="selected"<?php endif; ?>><?php echo $country->country; ?></option>
										<?php endforeach; ?>
									</select>
									 <p class="help-block">What country do you use to fetch the hot trends </p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="gtp_setting[keywords_domain]">Domain</label>
									<div class="col-sm-7">
									<select name="gtp_setting[keywords_domain]" id="gtp_setting[keywords_domain]" class="form-control">
										<?php
										foreach ($gtp_domains as $domains):?>
										<option value="<?php echo $domains->domain; ?>" <?php if($gtp_settings->keywords_domain === $domains->domain): ?>selected="selected"<?php endif; ?>><?php echo $domains->country; ?></option>
										<?php endforeach; ?>
									</select>
									 <p class="help-block">What Domain do you use to fetch the keywords</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="gtp_setting[keywords_language]">Language</label>
									<div class="col-sm-7">
									<select name="gtp_setting[keywords_language]" id="gtp_setting[keywords_language]" class="form-control">
										<?php
										foreach ($gtp_languages as $languages):?>
										<option value="<?php echo $languages->code; ?>" <?php if($gtp_settings->keywords_language === $languages->code): ?>selected="selected"<?php endif; ?>><?php echo $languages->country; ?></option>
										<?php endforeach; ?>
									</select>
									 <p class="help-block">What language do you use to fetch the keywords</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="gtp_setting[size]">Picture Size</label>
									<div class="col-sm-7">
										<select name="gtp_setting[campaign_size]" id="gtp_setting[campaign_size]" class="form-control">
											<option value="wallpaper" <?php if($gtp_settings->campaign_size === 'wallpaper'): ?>selected="selected"<?php endif; ?>>Wallpaper</option>
											<option value="small" <?php if($gtp_settings->campaign_size === 'small'): ?>selected="selected"<?php endif; ?>>Small</option>
											<option value="medium" <?php if($gtp_settings->campaign_size === 'medium'): ?>selected="selected"<?php endif; ?>>Medium</option>
											<option value="large" <?php if($gtp_settings->campaign_size === 'large'): ?>selected="selected"<?php endif; ?>>Large</option>
										</select>
										<p class="help-block">Picture size</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="gtp_setting[campaign_count]">Image Per Post</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="gtp_setting[campaign_count]" name="gtp_setting[campaign_count]" value="<?php echo $gtp_settings->campaign_count; ?>">
										<p class="help-block">How many image per post will be posted when campaign is run?</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="gtp_setting[campaign_schedule]">Post Schedule</label>
									<div class="col-sm-7">
										<select name="gtp_setting[campaign_schedule]" id="gtp_setting[campaign_schedule]" class="form-control">
											<?php foreach( $schedules as $sched_name=>$sched_data ) { ?>
															<option <?php selected($gtp_settings->campaign_schedule, $sched_name); ?> value="<?php echo $sched_name ?>"><?php echo $sched_data['display'] ?></option>
															<?php } ?>
											</select>
										<p class="help-block">Schedule your post</p>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label" for="gtp_setting[campaign_template]">Post Template</label>
									<div class="col-sm-7">
										<textarea name="gtp_setting[campaign_template]" id="gtp_setting[campaign_template]" class="form-control" rows="15" ><?php echo $gtp_settings->campaign_template; ?></textarea>
										<p class="help-block">PLEASE EDIT THE TEMPLATE. Make your content dynamic. Set your template here. Using <a href="https://github.com/speedmax/h2o-php">h2o template syntax</a>, Spintax and <a href="https://codex.wordpress.org/Shortcode">WordPress shortcode</a>. Available variables: title, images, campaign, tags. See all available variable using {% debug %}</p>
									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-7">
										<div class="checkbox" >
											<label>
												<input type="checkbox" id="active" value="1" checked="checked" name="gtp_setting[campaign_active]">
												Make all inserted campaign active
											</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-offset-3 col-sm-7">
										<?php wp_nonce_field( "gtp_setting" , "_gtp_setting" ); ?>
										<button type="submit" class="btn btn-primary" value="submit">Save</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Trends</h3>
					</div>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="col-sm-1">Trends</th>
								<th class="col-sm-1">Keywords</th>
								<th class="col-sm-1">Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($trends as $trend):?>
							<tr>
								<td class="col-sm-3"><?php echo $trend->trends; ?></td>
								<td class="col-sm-3"><?php echo $trend->keywords; ?></td>
								<td class="col-sm-3"><?php echo $trend->dates; ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				
				<div id="run_gtp" class="modal fade" style="z-index:9999" tabindex="-1" role="dialog" >
					<div class="row"  >
						<div class="col-sm-offset-4 col-sm-4" style="margin-top:100px" >
							<div class="modal-dialog modal-sm">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" >Run Google Trends</h4>
									</div>
									<form class="form-horizontal" method="post">
										<div class="modal-body">
											<fieldset>
												Please confirm you want to run Google Trends. This will create 20 trends once run.
												<input type="hidden" value="" name="run_gtp"/>
											</fieldset>
										</div>
										<div class="modal-footer">
											<?php wp_nonce_field( "run_gtp" , "_run_gtp" ); ?>
											<button type="submit" class="btn btn-info" value="submit">RUN</button>
											<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<div class="col-sm-3">
				<div class="well" >
					<button id="postnow" type="button" class="btn btn-success btn-block" data-toggle="collapse" data-target="#gtp_setting" >GTP Setting</button>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<p>Thank you for using Google Trends for Papercut from <a href="http://ridho.blogkita.co.id">Mutasim Ridlo, S.Kom</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
