	<div class="page-inner">
		<div class="page-title">
            <h3 class="breadcrumb-header">Package Details</h3>
		</div>
		<div class="panel panel-default">
			<?php if($this->session->flashdata('message')){ echo $this->session->flashdata('message'); } ?>
			<div class="col-xs-12" style="margin-bottom: 15px;">
				<div class="pull-left">
					<h3 class="panel-title">
						<a href="<?php echo base_url(); ?>packagemaster/addpackage_insert"><button class="btn btn-danger">Add Package Details </button></a>
					</h3>
				</div>
			</div>
			<div class="col-md-12">
				<div class="panel panel-white">				
					<div class="panel-body">
						<form class="form-horizontal" action="<?php echo base_url(); ?>packagemaster" method="post" name="filterPackagemaster">
							<div class="col-md-9">	
								<div class="form-group">
									<label class="col-sm-2 control-label" for="input-Default">Search</label>
									<div class="col-sm-10" style="padding-left: 5px;">
										<input type="text" id="search" name="search" placeholder="PackageName / length / Width / Height / KG" class="form-control" value="<?php if(isset($_POST['search'])){ echo $_POST['search']; } ?>">
									</div>	
								</div>
							</div>
							<div class="col-md-3">	
								<div class="form-group">
									<div class="col-md-11 col-sm-6 col-xs-12" >
										<button class="btn btn-primary col-md-12" style="margin:0 15px 15px 0;" onclick="reload_table('PackageMaster-grid')" type="button">
										<i class="fa fa-search" style="font-size:18px"></i>&nbsp;&nbsp;Search</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="panel-body">
				<div>
					<table id="PackageMaster-grid" class="display table" style="width: 100%; cellspacing: 0;">
						<thead>
							<tr>
								<th class="text-center" style="width:6%!important;">Details</th>
								<th class="text-center" style="width:16%!important;">Package Name</th>
								<th class="text-center" style="width:6%!important;">Length</th>
								<th class="text-center" style="width:6%!important;">Width</th>
								<th class="text-center" style="width:6%!important;">Height</th>
								<th class="text-center" style="width:6%!important;">Weight</th>
								<th class="text-center" style="width:30%!important;">Description</th>
								<th class="text-center" style="width:40%!important;">Action</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>		 
	</div>