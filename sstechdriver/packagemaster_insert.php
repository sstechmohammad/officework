	<?php if(isset($EditData)) {?>
	<div class="page-inner">
		<div class="page-title">
			<h3 class="breadcrumb-header">Update Package </h3>
		</div> 
		<div class="page-content-wrap">
			<form id="packageform" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>packagemaster/update">
			<input type="hidden" name="UpdateId" value="<?php echo $EditData[0]->id; ?>">
				<div class="panel panel-default">
					<div class="form-group">
						<label class="col-md-2 control-label">Package Name<span style="color: red;">*</span></label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="packagename" id="packagename" placeholder="Package Name" value="<?php echo $EditData[0]->packagename; ?>" >
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Length<span style="color: red;">*</span></label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="length" id="length" placeholder="Weight In kg" value="<?php echo $EditData[0]->length; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Width<span style="color: red;">*</span></label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="width" id="width" placeholder="Width" value="<?php echo $EditData[0]->width; ?>">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 control-label">Height<span style="color: red;">*</span></label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="height" id="height" placeholder="Height" value="<?php echo $EditData[0]->height; ?>">
						</div>
					</div>
						<div class="form-group">
						<label class="col-md-2 control-label">Weight<span style="color: red;">*</span></label>
						<div class="col-md-5">
							<input type="text" class="form-control" name="weight" id="weight" placeholder="Weight" value="<?php echo $EditData[0]->weight; ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="Address" class="col-md-2 control-label">Package Description </label>
						<div class="col-md-4">
							<textarea class="form-control" id="description" name="description" placeholder="Description"><?php echo $EditData[0]->description; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-offset-2 col-sm-1">
							<button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Update</button>
						</div>
						<div class="col-md-offset-1 col-sm-1">
							<a href="<?php echo base_url().'packagemaster'; ?>" ><span  class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Back</span></a>
						</div>
					</div>
				</div>
			</form>
		</div>			
	</div>
	<?php } else { ?>
	<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
	<div class="page-inner">
		<div class="page-title">
			<h3 class="breadcrumb-header">Add Package</h3>
		</div>
		<form id="packageform" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>packagemaster/insert">
			<div class="panel panel-default">
				<div class="form-group">
					<label class="col-md-2 control-label">Package Name<span style="color: red;">*</span></label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="packagename" id="packagename" placeholder="Package Name">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Length <span style="color: red;">*</span></label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="length" id="length" placeholder="Length">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Width <span style="color: red;">*</span></label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="width" id="width" placeholder="Width">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">Height <span style="color: red;">*</span></label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="height" id="height" placeholder="Height">
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label">weight <span style="color: red;">*</span></label>
					<div class="col-md-5">
						<input type="text" class="form-control" name="weight" id="weight" placeholder="Size IN cm">
					</div>
				</div>
				<div class="form-group">
					<label for="Address" class="col-md-2 control-label">Package Description </label>
					<div class="col-md-4">
						<textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-offset-2 col-sm-1">
						<button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Submit</button>
					</div>
					<div class="col-md-offset-1 col-sm-1">
						<a href="<?php echo base_url().'packagemaster'; ?>" ><span  class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Back</span></a>
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php } ?>