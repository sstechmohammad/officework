<style>
	.popover-title{
	text-align:center;

	}
	.popover.confirmation.fade.top.in{background:#eeeeee none repeat scroll 0 0 !important;}
	.step-controls{margin-bottom:20px !important;}
</style>

    
		<!---------------edit User form start-------------------------------->
<?php if($this->session->flashdata('message')){ echo  $this->session->flashdata('message');  } ?>

<?php if(isset($EditData)){  ?>
		
<div class="page-inner">
	<div class="page-title">
		<h3 class="breadcrumb-header">Update Job information</h3>
	</div>
	<form  name="JobhistoryForm" class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>jobhistory/update_job">
		<input type="hidden" name="UpdateId" value="<?php echo $EditData[0]->Id; ?>">
		<input type="hidden" name="CompanyId" value="<?php echo $EditData[0]->CompanyId; ?>">
		<input type="hidden" name="JobStatus" value="<?php echo $EditData[0]->JobStatus; ?>">
				
		<div class="panel panel-default">
			
			<div class="col-md-12 form-group">
				<div class="ms" style="display:none;"></div>
			</div>
			
			<div class="form-group input-box">
				<label class="col-md-2 control-label">Company <span style="color: red;">*</span></label>
				<div class="col-md-5">      
					<select class="form-control" name="CompanyId" id="CompanyId">
						<option value="">Select Company</option>
						<?php foreach($Companylist as $comp){ ?>
							<option value="<?php echo $comp->Id;?>"<?php if($EditData[0]->CompanyId == $comp->Id){echo 'selected'; } ?>><?php echo $comp->Name;?></option>
						<?php } ?>
						
					</select>
				</div>			
			</div>
			

			<div class="form-group">
				<label class="col-md-2 control-label">Order no</label>  
				<div class="col-md-5">
					<input type="text" class="form-control" id="Consignment"  name="Consignment" placeholder="Order Number" value="<?php echo $EditData[0]->Consignment; ?>" />
				</div>
			</div>
				
			<div class="form-group">
				<label class="col-md-2 control-label">Instruction</label>  
				<div class="col-md-5">
					<textarea class="form-control" id="Instruction"  name="Instruction" placeholder="Instruction" maxlength="150"><?php echo $EditData[0]->DeliveryInstruction; ?></textarea>
					<b>max. 150 character allowed</b>
				</div>
			</div>
				
			<div class="panel-heading clearfix">
				<h4 class="panel-title" style="color: #637282;padding: 14px;font-size: 15px;"><b>Pickup Details</b></h4>
			</div>
		
				<?php 
					$pkup_dtl = json_decode($EditData[0]->PickupDetail);
					$drp_dtl = json_decode($EditData[0]->DropoffDetail);
					$pkg_dtl = json_decode($EditData[0]->PackageDetail);
					//echo "<pre>";print_r($drp_dtl);exit();
				?>

<div class="row">
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Name <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="pickupname" name="pickupname" placeholder="Name" value="<?php echo $pkup_dtl->name;?>" onchange="autofill_addrDetails(this);">
				</div>
			</div>

			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Phone <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="pickupphone" name="pickupphone" placeholder="Phone" value="<?php echo $pkup_dtl->phone;?>" minlength="10" maxlength="12">
				</div>
			</div>
		</div>		
		<div class="row">
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Address 1 <span style="color: red;">*</span></label>
				<div class="col-md-8">
				<input type="text" class="form-control" id="pickupaddress" name="pickupaddress" value="<?php echo $pkup_dtl->address;?>" onchange="showsuggestion(this);">
				</div>
			</div>

			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Address 2 </label>
				<div class="col-md-8">
				<input type="text" class="form-control" id="picklocality" name="picklocality" value="<?php if(!empty($pkup_dtl->picklocality)){echo $pkup_dtl->picklocality;}else{echo '';}?>">
				</div>
			</div>		
		</div>
			
		<div class="row">
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Country <span style="color: red;">*</span></label>
				<div class="col-md-8 custom-country">
				<select name="pickcountry" id="pickcountry" class="form-control" >
					<option value="">Select Country</option>										
				</select>
				</div>
			</div>
			
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">State : <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<select name="pickstate" id="pickstate" class="form-control select" >
							<option>Select State</option>
							<?php foreach($pick_state as $row){//print_r($row);exit; ?>
							<option id="pickstate" value="<?php echo $row->State ; ?>" name="<?php echo $row->CountryStateId ; ?>" <?php if(isset($pkup_dtl->pickstate)) {  if($pkup_dtl->pickstate==$row->State) { echo 'selected'; } } ?>><?php echo $row->State ; ?></option>
						<?php } ?>
					</select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">City <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" name="pickSuburb" id="pickcity" placeholder="Search City/Suburb" value="<?php echo $pkup_dtl->pickSuburb;?>"  class="typeahead form-control" autocomplete="off"/>
				</div>
				<div id="suburb-div" class="" style="display:none;">
					<ul></ul>
				</div> 
			</div>
			
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Postcode <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="pickpostalcode" name="pickpostalcode" value="<?php echo $pkup_dtl->pickpostalcode;?>" placeholder="Postcode*">
				</div>
			</div>
		</div>

			

			
			<div class="panel-heading clearfix">
				<h4 class="panel-title" style="color: #637282;padding: 14px;font-size: 15px;"><b>DropOff Details</b></h4>
			</div>
			<div class="row">			
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Name <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="dropoffname" name="dropoffname" placeholder="Name" value="<?php echo $drp_dtl->name;?>" onchange="autofill_addrDetails(this);">
				</div>
			</div>
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Phone <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="dropoffphone" name="dropoffphone" placeholder="Phone" value="<?php echo $drp_dtl->phone;?>" minlength="10" maxlength="12">
				</div>
			</div>
			</div>
			<div class="row">
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Address 1 <span style="color: red;">*</span></label>
				<div class="col-md-8">
				<input type="text" class="form-control" id="dropoffaddress" name="dropoffaddress" value="<?php echo $drp_dtl->address;?>" onchange="showsuggestion(this);">
				</div>
			</div>

			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Address 2 </label>
				<div class="col-md-8">
				<input type="text" class="form-control" id="droplocality" name="droplocality" value="<?php if(!empty($drp_dtl->droplocality)){echo $drp_dtl->droplocality;}else{echo '';}?>">
				</div>
			</div>
			</div>
			
			<div class="row">
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Country <span style="color: red;">*</span></label>
				<div class="col-md-8 custom-country">
				<select name="dropcountry" id="dropcountry" class="form-control select" >
					<option value="">Select Country</option>										
				</select>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">State <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<select name="dropstate" id="dropstate" class="form-control select" >
						<option>Select State</option>
							<?php foreach($drop_state as $row){?>
						<option id="dropstate" value="<?php echo $row->State ; ?>" name="<?php echo $row->CountryStateId ; ?>"  <?php if(isset($drp_dtl->dropstate)) {  if($drp_dtl->dropstate==$row->State) { echo 'selected'; } } ?>><?php echo $row->State ; ?></option>
					<?php } ?>
					</select>
				</div>
			</div>
			</div>
			<div class="row">
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">City <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" name="dropcity" id="dropcity" placeholder="Search City/Suburb" value="<?php echo $drp_dtl->dropcity;?>" class="typeahead form-control" autocomplete="off"/>
				</div>
				<div id="suburb-div" class="" style="display:none;">
					<ul></ul>
				</div> 
			</div>
			
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Postcode <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="postalcode" name="droppostalcode" value="<?php echo $drp_dtl->droppostalcode;?>"  placeholder="Postcode*">
				</div>
			</div>
			</div>
		
					
						
		<div class="panel-heading clearfix">
			<h4 class="panel-title" style="color: #637282;padding: 14px;font-size: 15px;"><b>Package Details</b></h4>
		</div>
		<div class="row col-md-offset-1">
			<div class="form-group col-md-2">
				<label class="control-label pkg-font">Units <span style="color: red;">*</span></label>
				<div class="col-md-12">
					<input type="number" class="form-control" id="units" name="units" value="<?php if(!empty($pkg_dtl->units)){ echo $pkg_dtl->units;}else{echo '';}?>" min="1"  required>
				</div>
			</div>
			<div class="form-group col-md-2">
				<label class="control-label pkg-font">Length(cm)<span style="color: red;">*</span></label>
				<div class="col-md-12">
					<input type="number" class="form-control" id="length" name="length" value="<?php if(!empty($pkg_dtl->length)){echo $pkg_dtl->length;}else{echo '';} ?>" min="0.01"  required>
				</div>
			</div>
			<div class="form-group col-md-2">
				<label class="control-label pkg-font">Width(cm)<span style="color: red;">*</span></label>
				<div class="col-md-12">
					<input type="number" class="form-control" id="width" name="width" value="<?php if(!empty($pkg_dtl->width)){echo $pkg_dtl->width;}else{echo '';}?>" min="0.01"  required>
				</div>
			</div>
		<div class="form-group col-md-2">
			<label class="control-label pkg-font">Height(cm)<span style="color: red;">*</span></label>
			<div class="col-md-12">
				<input type="number" class="form-control" id="height" name="height" value="<?php if(!empty($pkg_dtl->height)){echo $pkg_dtl->height;}else{echo '';}?>" min="0.01"  required>
			</div>
		</div>
		<div class="form-group col-md-2">
			<label class="control-label pkg-font">KG(kg) <span style="color: red;">*</span></label>
			<div class="col-md-12">
				<input type="number" class="form-control" id="kg" name="kg" value="<?php if(!empty($pkg_dtl->kg)){echo $pkg_dtl->kg;}else{echo '';}?>" min="0.01"  required>
			</div>
		</div>			
		</div>
				
				<?php 
					if(isset($EditData[0]->ScheduleJobTime) && $EditData[0]->ScheduleJobTime !='')
					{
						$timestamp = $EditData[0]->ScheduleJobTime;
						$splitTimeStamp = explode(" ",$timestamp);
						$date = $splitTimeStamp[0];
						$time = $splitTimeStamp[1];
					}
				?>
			<!--<?php //if(isset($timestamp) && $timestamp!=null){ ?>	-->
			
			<?php if($EditData[0]->ScheduleJobTime !=0){ ?>	
			<div class="panel-heading clearfix">
				<div class='toggle_parent'>

					<div class='toggleHolder' style="color: #637282;padding: 14px;font-size: 15px;">
						<span class='toggler' style='display:none;'><img src="<?php echo base_url();?>/assets/images/details_open.png"/>   <b>Scheduled Times</b></span>
						<span class='toggler'><img src="<?php echo base_url();?>/assets/images/details_close.png"/> <b>Scheduled Times</b></span>
					</div>

					<div class='toggled_content'>
						<div class="form-group input-box">

							<label class="col-md-2 control-label">Pick Up Date</label>
							<div class="col-md-3">
								<div id="datetimepicker4" class="input-append">
									<input data-format="yyyy-MM-dd" type="text" class="form-control1" name="pickupdate" id="pickupdate" value="<?php echo $date; ?>" />
									<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
								</div>
							</div>

							<label class="col-md-2 control-label">Pick Up Time</label>
							<div class="col-md-3">
								<div id="datetimepicker3" class="input-append">
								<input data-format="hh:mm:ss" type="text" class="form-control1" name="pickuptime" value="<?php echo $time; ?>" />
								<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
								</div>
								<b style="color: #637282;">Pick up time in 24 hour format</b>
							</div>

						</div>
					</div>

				</div>
			</div>
			<?php } ?>

			<div class="form-group">
					<div class="col-md-offset-2 col-sm-1">
					<button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Update</button>
					</div>
					<div class="col-md-offset-1 col-sm-1">
					<a href="<?php echo base_url().'jobhistory'; ?>" ><span  class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Back</span></a>
					</div>
			</div>
		</div>
	</form>			
</div>	
	
<?php }else{ ?>
			
<div class="page-inner">
	<div class="page-title">
		<h3 class="breadcrumb-header">Create New Job</h3>
	</div>
	<form name="JobhistoryForm"  class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>jobhistory/add_new_job">
		<div class="panel panel-default">
					
			<div class="col-md-12 form-group ">
				<div class="ms" style="display:none;"></div>
			</div>
			
			<div class="form-group input-box">
				<label class="col-md-2 control-label">Company <span style="color: red;">*</span></label>
				<div class="col-md-5">      
					<select class="form-control" name="CompanyId" id="CompanyId" >
						<option value="">Select Company</option>

						<?php foreach($Companylist as $comp){	?>
							<option value="<?php echo $comp->Id;?>"><?php echo $comp->Name;?></option>
						<?php } ?>
					
					</select>
				</div>	
			</div>
					
			<div class="form-group">
				<label class="col-md-2 control-label">Customer Email <span style="color: red;">*</span></label>
				<div class="col-md-5">
					<input type="email" class="form-control" id="Email" name="Email" placeholder="Email" value="" onchange="autofill_addrDetails(this);">
				</div>
			</div>

			<div class="form-group">
				<label class="col-md-2 control-label">Order no</label>  
				<div class="col-md-5">
					<input type="text" class="form-control" id="Consignment"  name="Consignment" placeholder="Order Number" value="" />
				</div>
			</div>
			
			<div class="form-group">
				<label class="col-md-2 control-label">Instruction</label>  
				<div class="col-md-5">
					<textarea class="form-control" id="Instruction"  name="Instruction" placeholder="Enter Instruction here.." maxlength="150"/></textarea>
					<b>max. 150 character allowed</b>
				</div>
			</div>
			
			<div class="panel-heading clearfix"><h4 class="panel-title" style="color: #637282;padding: 14px;font-size: 15px;"><b>Pickup Details : </b></h4></div>
			

		<div class="row">	
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Name <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="pickupname" name="pickupname" placeholder="Name" value="" onchange="autofill_addrDetails(this);">
				</div>
			</div>
			
			<div class="form-group col-md-6">
				<label class="col-md-3 control-label">Phone <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="pickupphone" name="pickupphone" placeholder="Phone" minlength="10" maxlength="12" value="">
				</div>
			</div>

		</div>	
			
		<div class="row">

			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Address 1<span style="color: red;">*</span></label>
				<div class="col-md-8">
				<input type="text" class="form-control" id="pickupaddress" name="pickupaddress" value="" placeholder="445 Mount Eden Road" onchange="showsuggestion(this);">
				</div>
			</div>

			<div class="form-group col-md-6">
				<label class="col-md-3 control-label">Address 2<span style="color: red;">*</span></label>
				<div class="col-md-8">
				<input type="text" class="form-control" id="picklocality" name="picklocality" value="" placeholder="Mount Eden">
				</div>
			</div>
		</div>	
			
		<div class="row">

			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Country <span style="color: red;">*</span></label>
				<div class="col-md-8 custom-country">
				<select name="pickcountry" id="pickcountry" class="form-control select" >
					<option value="">Select Country</option>										
				</select>
				</div>
			</div>
			
			<div class="form-group col-md-6 ">
				<label class="col-md-3 control-label">State <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<select name="pickstate" id="pickstate" class="form-control select" >
						<option>Select State</option>
					</select>
				</div>
			</div>


		</div>	
			

		<div class="row">

			<div class="form-group col-md-6 ">
				<label class="col-md-4 control-label">City <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" name="pickSuburb" id="pickcity" class="typeahead form-control" autocomplete="off" placeholder="Search City/Suburb"/>
				</div>
				<div id="suburb-div" class="" style="display:none;">
					<ul></ul>
				</div> 
			</div>

			<div class="form-group col-md-6">
				<label class="col-md-3 control-label">Postcode <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="pickpostalcode" name="pickpostalcode"  placeholder="Postcode*">
				</div>
			</div>

		</div>		

			
			<div class="panel-heading clearfix">
					<h4 class="panel-title" style="color: #637282;padding: 14px;font-size: 15px;"><b>DropOff Details</b></h4>
			</div>

		<div class="row">
			
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Name <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="dropoffname" name="dropoffname" placeholder="Name" value="" onchange="autofill_addrDetails(this);">
				</div>
			</div>
			<div class="form-group col-md-6">
				<label class="col-md-3 control-label">Phone <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="dropoffphone" name="dropoffphone" placeholder="Phone" minlength="10" maxlength="12" value="">
				</div>
			</div>
		</div>	
			

		<div class="row">

			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Address 1<span style="color: red;">*</span></label>
				<div class="col-md-8">
				<input type="text" class="form-control" id="dropoffaddress" name="dropoffaddress"  value="" placeholder="445 Mount Eden Road" onchange="showsuggestion(this);">
				</div>
			</div>


			<div class="form-group col-md-6">
				<label class="col-md-3 control-label">Address 2<span style="color: red;">*</span></label>
				<div class="col-md-8">
				<input type="text" class="form-control" id="droplocality" name="droplocality"  value="" placeholder="Mount Eden">
				</div>
			</div>

			
		</div>	
		

		<div class="row">
	
			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">Country <span style="color: red;">*</span></label>
				<div class="col-md-8 custom-country">
				<select name="dropcountry" id="dropcountry" class="form-control select" >
					<option value="">Select Country</option>										
				</select>
				</div>
			</div>


			<div class="form-group col-md-6">
				<label class="col-md-3 control-label">State <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<select name="dropstate" id="dropstate" class="form-control select" >
						<option>Select State</option>
					</select>
				</div>
			</div>
			
			
		</div>	
			

		<div class="row">

			<div class="form-group col-md-6">
				<label class="col-md-4 control-label">City <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" name="dropcity" id="dropcity" class="typeahead form-control" autocomplete="off" placeholder="Search City/Suburb"/>
				</div>
				<div id="suburb-div" class="" style="display:none;">
					<ul></ul>
				</div> 
			</div>
		
		

			<div class="form-group col-md-6">
				<label class="col-md-3 control-label">Postcode <span style="color: red;">*</span></label>
				<div class="col-md-8">
					<input type="text" class="form-control" id="droppostalcode" name="droppostalcode"  placeholder="Postcode*">
				</div>
			</div>

		</div>

		<div class="panel-heading clearfix">
			<h4 class="panel-title" style="color: #637282;padding: 14px;font-size: 15px;"><b>Package Details</b></h4>
		</div>
		
		<div class="form-group input-box">
					<label class="col-md-2 control-label">Package <span style="color: red;">*</span></label>
					<div class="col-md-5 custom-country">
						<select name="packageid" id="packageid" class="form-control" >
						</select>
					</div>
		</div>	
		
		<div class="row col-md-offset-2">
			<div class="form-group col-md-2">
				<label class="pkg-font">Units <span style="color: red;">*</span></label>
				<div class="col-md-12">
					<input type="number" value="1" class="form-control" id="units" name="units" placeholder="Units" min="1"  required>
				</div>
			</div>
			<div class="form-group col-md-2">
				<label class="pkg-font">Length(cm)<span style="color: red;">*</span></label>
				<div class="col-md-12">
					<input type="number" value="0.1" class="form-control" id="length" name="length" placeholder="Length" min="0.01"  required>
				</div>
			</div>
			<div class="form-group col-md-2">
				<label class="pkg-font">Width(cm)<span style="color: red;">*</span></label>
				<div class="col-md-12">
					<input type="number" value="0.1" class="form-control" id="width" name="width" placeholder="Width" min="0.01"  required>
				</div>
			</div>
			<div class="form-group col-md-2">
				<label class="pkg-font">Height(cm)<span style="color: red;">*</span></label>
				<div class="col-md-12">
					<input type="number" value="0.1" class="form-control" id="height" name="height" placeholder="Height" min="0.01"  required>
				</div>
			</div>
			<div class="form-group col-md-2">
				<label class="pkg-font">KG(kg) <span style="color: red;">*</span></label>
				<div class="col-md-12">
					<input type="number" value="0.1" class="form-control" id="weight" name="weight" placeholder="weight" min="0.01"  required>
				</div>
			</div>
		</div>
		
		
			<div class="panel-heading clearfix">
				<div class='toggle_parent'>

					<div class='toggleHolder' style="color: #637282;padding: 14px;font-size: 15px;">
						<span class='toggler'><img src="<?php echo base_url();?>/assets/images/details_open.png" /> <b>Scheduled Times</b></span>
						<span class='toggler' style='display:none;'><img src="<?php echo base_url();?>/assets/images/details_close.png" /><b>Scheduled Times</b></span>
					</div>

					<div class='toggled_content' style='display:none;'>
						<div class="form-group">
							<label class="col-md-2 control-label">Pick Up Date</label>
							<div class="col-md-3">
								<div class="input-group bootstrap-datepicker datepicker">
								  <input id="pickupdate" type="text"  name="pickupdate" class="form-control input-small">
								  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
								</div>
							</div>

							<label class="col-md-2 control-label">Pick Up Time</label>
							<div class="col-md-3">
								<div class="input-group bootstrap-timepicker timepicker">
								  <input id="pickuptime" type="text"  name="pickuptime" class="form-control input-small">
								  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
								</div>
							</div>

						</div>	
					</div>

				</div>
			</div>
					
			<div class="form-group">
				<div class="form-group">
					<div class=" col-md-offset-2 col-sm-1">
						<button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Submit</button>
					</div>
					<div class="col-md-offset-1 col-sm-1">
						<button type="submit" class="btn btn-success" style="margin-top:10px;margin-bottom:-14px;">Submit</button>
					</div>
					
				</div>
			</div>

		</div>
	</form>
</div>		
			
<?php } ?>



<script type="text/javascript">
	
$('#pickupphone,#dropoffphone').keyup(function()
{A
	if (/\D/g.test(this.value))
	{
		this.value = this.value.replace(/\D/g, '');
	}
});
		
	/*** Update Form Validation Start **/
var UpdateJobHistory = $("form[name='UpdateJobHistory']").validate({
		//ignore: [],
		rules: {
			pickupname: {
				required: true,
			},
			pickupphone:"required",
			pickupaddress:{
					required:true,
					//minlength:8
			},
			
			dropoffname: {
					required: true,
			},
			dropoffphone: "required",
			
			dropoffaddress:{
					required:true,
					//minlength:8
			},
			
			Email: {
					required: true,
					email: true
			},
			Driver: {
					required: true,
					
			},
			
			status_reason: {
					divisible: true,
			}
		},

			messages:
			{
			  pickupname:"Pickup Name field is required.",
			  //pickupphone:"Pickup Phone field is required.",
			  pickupaddress:"Pickup Address is required.",
			  dropoffname:"Dropof Name is required.",
			  //dropoffphone:"Dropof Phone Number is required.",
			  dropoffaddress:"Dropof Address is required.",
			  Driver:"Driver is Required",
			  Email:"Email is Required",
			},
			submitHandler: function(form)
			{
				var data = $("#UpdateJobHistory").serialize();
				if(data)
				{
					// debugger;
					$('.loader').show();
					$.ajax({
							url:"<?php echo base_url(); ?>jobhistory/update_job",  
							type:'post',
							data:data,
							dataType: 'JSON',
							success:function(data)
							{
								if(data.success==false)
								{
									$('.loader').hide();
									swal("Error!", data.message, "warning");
								}
								else
								{
									$('.loader').hide();
									swal("Great Job Updated!", data.message, "success");
								}
							}
						});
						return false;
				}
				else
				{
					return false;
				}
				
				var myvar = null;
			    var currval = $(this).val();
				var status_rsn = $(".status_rsn").val();
				//alert(currval);
				if(currval==2 && status_rsn=='')
				{
				  $(".status_rsn").css('display','block');
				  $("#status_error").css('display','block');
				  return false;
				}
				else
				{
					return false;
				}
			}	
		});
	
	$(function()
	{ 
	    $('.toggler').click(function(e)
		{
			$(this).parent().children().toggle();  //swaps the display:none between the two spans
			$(this).parent().parent().find('.toggled_content').slideToggle();  //swap the display of the main content with slide action
		}); 
	});  
	
</script>

<script type="text/javascript">

$.ajax({
	url : '<?php echo base_url(); ?>general/country_list_option',
	success : function(data){ 
		$('#pickcountry,#dropcountry').html(data);
	},
	complete: function (data) {// alert(data);return false;
		<?php if(isset($EditData[0]->PickupDetail)){ ?>
			$("#pickcountry option[value='<?php echo $pkup_dtl->pickcountry; ?>']").prop("selected", "selected");
		<?php }?>	
				<?php if(isset($EditData[0]->DropoffDetail)){ ?>
			$("#dropcountry option[value='<?php echo $drp_dtl->dropcountry; ?>']").prop("selected", "selected");
		<?php }?>	
	}
}); 

	$.ajax
		({
			url : '<?php echo base_url(); ?>general/package_list_option',
			success : function(data)
			{
				$('#packageid').html(data);
			},
			complete: function (data) 
			{
				<?php if(isset($EditData[0]->packageid))
				{ ?>
					$("#packageid option[value='<?php echo $EditData[0]->packageid; ?>']").prop("selected", "selected");
				<?php }?>
			}
		});


$('#pickcountry').change(function(){
	//alert($(this).val()); return false;
		var country = $('option:selected', this).attr('name');
		
		if(country != '')
		{
			$.ajax({
				url: baseurl+"general/state_list",
				type:'post',
				data:{
					country:country
				},
				success:function(res){
					var data = jQuery.parseJSON(res);
					$('#pickstate').html(data);
				}
			});
		}
});

$('#dropcountry').change(function(){
	//alert($(this).val()); return false;
	var country = $('option:selected', this).attr('name');
	if(country != '')
	{
		$.ajax({
			url: baseurl+"general/state_list",
			type:'post',
			data:{
				country:country
			},
			success:function(res){
				var data = jQuery.parseJSON(res);
				$('#dropstate').html(data);
			}
		});
	}
});

$(function(){ 
$('#pickcity').typeahead({
			source: function (query, result) 
			{
				var state = $('#pickstate option:selected').attr('name');;
				$.ajax({
					url: baseurl+"general/key_city_list",
					data:{
					query:query,
					state:state
					},					
					dataType: "json",
					type: "POST",
					success: function (data){
						result($.map(data, function (item) {
							return item;
						}));	
					}
				});
			}
});
$('#dropcity').typeahead({
	source: function (query, result) 
	{
		var state = $('#dropstate option:selected').attr('name');;
		//alert(state);return false;
		$.ajax({
			url: baseurl+"general/key_city_list",
			data:{
			query:query,
			state:state
			},					
			dataType: "json",
			type: "POST",
			success: function (data) {
				result($.map(data, function (item) {
					return item;
				}));	
			}
		});
	}
});
});

/*** Function to load Autosuggest Address1 And Address2 ***/

	$(function()
	{ 
		$('#pickupaddress,#dropoffaddress').typeahead({ 
			
			source: function (query, result) 
			{
				$.ajax({
					url: baseurl+"jobhistory/Autofill_address",
					dataType: "json",
					data:
					{
						query:query
					},
					type: "POST",
					success: function (data) 
					{
						result($.map(data, function (item) {
							return item;
						}));
					}
				});
			}
		});
	});

	function showsuggestion()
	{
		
		$("#pickupaddress").bind("change", function() 
		{
			var Adr1 = $("#pickupaddress").val();
			//alert(Adr1);return false;
			$.ajax({
					url: baseurl+"jobhistory/Dynamic_addressSelected/",
					data:
					{
						Adr1:Adr1
					},
					type:'post',
					success: function(response) 
					{
						if(response)
						{
							var result = $.parseJSON(response);
							
							$("#picklocality").val(result.address2);
							//$("#pickcountry").html('<option value=' + result.country + '>' + result.country + '</option>');
							$('#pickcountry').append('<option name=' + result.SortName + ' selected value=' + result.country + '>' + result.country + '</option>');
							//$("#pickstate").html('<option value=' + result.state + '>' + result.state + '</option>');
							$('#pickstate').append('<option name=' + result.CountryStateId + ' selected value=' + result.state + '>' + result.state + '</option>');
							$("#pickcity").val(result.city);
							$("#pickpostalcode").val(result.postcode);
							
							
							var country = $('#pickcountry option:selected').attr('name');
							PickCountryStateList(country);
							
							var state = $('#pickstate option:selected').attr('name');
							CityList(state);
						}
					}
				});
		});
		
		
	
			
		
		$("#dropoffaddress").bind("change", function() 
		{
			var Adr1 = $("#dropoffaddress").val();
			
			$.ajax({
					url: baseurl+"jobhistory/Dynamic_addressSelected/",
					data:
					{
						Adr1:Adr1
					},
					type:'post',
					success: function(response) 
					{
						if(response)
						{
							var result = $.parseJSON(response);
							
							$("#droplocality").val(result.address2);
							//$("#dropcountry").html('<option value=' + result.country + '>' + result.country + '</option>');
							//$('#dropcountry').append('<option selected name=' + result.SortName + ' value=' + result.country + '>' + result.country + '</option>');
							//$("#dropstate").html('<option name=' + result.CountryStateId + ' value=' + result.state + '>' + result.state + '</option>');
							$("#dropcity").val(result.city);
							$("#droppostalcode").val(result.postcode);


							$('#dropcountry').select2('destroy');
							$('#dropstate').select2('destroy');

		$("#dropcountry option[value='"+result.country+"']").attr('selected','selected');

		

							
						//	var country = $('#dropcountry option:selected').attr('name');
							DropCountryStateList(result.country);
							$("#dropstate option[value='"+result.state+"']").attr('selected','selected');
							
						//	var state = $('#dropstate option:selected').attr('name');
						//	CityList(state);
						}
					}
				});
		});
	}
	
	$("#pickupaddress").on('change',function()
	{ 
		//$("#pickupname").val("");
		//$("#pickupphone").val("");
		$("#picklocality").val("");
		$("#pickcountry").html("");
		$("#pickstate").html("");
		$("#pickcity").val("");
		$("#pickpostalcode").val("");
		
		$.ajax({
				url : '<?php echo base_url(); ?>general/country_list_option',
				success : function(data)
				{ 
					$('#pickcountry').html(data);
				}
			}); 
	});
	
	$("#dropoffaddress").on('change',function()
	{ 
		$("#droplocality").val("");
		$("#dropcountry").html("");
		$("#dropstate").html("");
		$("#dropcity").val("");
		$("#droppostalcode").val("");
		
		$.ajax({
				url : '<?php echo base_url(); ?>general/country_list_option',
				success : function(data)
				{ 
					$('#dropcountry').append(data);
				}
			}); 
	});
	
/*** End F/n Autosuggest Address1 And Address2 fields ***/
	
	/*** Start Customer Name And Email Auto Suggestion Js  @ Krushna @***/
	
	$(function()
	{ 
		$("#Email").typeahead({ 
			
			source: function (query, result) 
			{
				$.ajax({
					url: baseurl+"jobhistory/Autofill_Email",
					dataType: "json",
					data:
					{
						query:query
					},
					type: "POST",
					success: function (data) 
					{
						result($.map(data, function (item) {
							return item;
						}));
					}
				});
			}
		});
		
		$("#pickupname,#dropoffname").typeahead({ 
			
			source: function (query, result) 
			{
				$.ajax({
					url: baseurl+"jobhistory/Autofill_CustomerName",
					dataType: "json",
					data:
					{
						query:query
					},
					type: "POST",
					success: function (data) 
					{
						result($.map(data, function (item) {
							return item;
						}));
					}
				});
			}
		});
		
	});
	
	
	function autofill_addrDetails()
	{
		$("#Email").bind("change", function() 
		{
			var Email = $("#Email").val();
			
			$.ajax({
					url: baseurl+"jobhistory/Dynamic_addressDetails/",
					data:
					{
						Email:Email
					},
					type:'post',
					success: function(response) 
					{
						if(response)
						{	
							var result = $.parseJSON(response);
							
							$("#pickupname").val(result.name);
							$("#pickupaddress").val(result.Building);
							$("#picklocality").val(result.Street);
							
							$('#pickcountry').append('<option selected name=' + result.SortName + '  value=' + result.Country + '>' + result.Country + '</option>');
							$('#pickstate').html('<option name=' + result.CountryStateId + ' value=' + result.State + '>' + result.State + '</option>');
							
							$("#pickcity").val(result.Suburb);
							$("#pickpostalcode").val(result.Postcode);
							$("#pickupphone").val(result.Phoneno);
							
							
							var country = $('#pickcountry option:selected').attr('name');
							PickCountryStateList(country);
							
							var state = $('#pickstate option:selected').attr('name');
							CityList(state);
						}
					}
				});
		});
		
		$("#pickupname").bind("change", function() 
		{
			//alert('SSSSSSS');return false;
			var Name = $("#pickupname").val();
			//alert(Name);return false;
			$.ajax({
					url: baseurl+"jobhistory/Dynamic_addressDetails/",
					data:
					{
						Name:Name
					},
					type:'post',
					success: function(response) 
					{
						//alert(response);return false;
						if(response)
						{
							var result = $.parseJSON(response);
							
							$("#pickupname").val(result.name);
							$("#pickupaddress").val(result.Building);
							$("#picklocality").val(result.Street);
							$("#pickcountry").append('<option selected name=' + result.SortName + ' value=' + result.Country + '>' + result.Country + '</option>');
							$("#pickstate").html('<option name=' + result.CountryStateId+ ' value=' + result.State + '>' + result.State + '</option>');
							
							 //$('#pickcountry').append('<option  name=' + result.SortName + ' selected value=' + result.country + '>' + result.country + '</option>');
							//$('#pickstate').append('<option selected value=' + result.state + '>' + result.state + '</option>');
							
							$("#pickcity").val(result.Suburb);
							$("#pickpostalcode").val(result.Postcode);
							$("#pickupphone").val(result.Phoneno);
							
							
							
							var country = $('#pickcountry option:selected').attr('name');
							PickCountryStateList(country);
							
							var state = $('#pickstate option:selected').attr('name');
							CityList(state);
						}
					}
				});
				
		});
		
		$("#dropoffname").bind("change", function() 
		{
			var Name = $("#dropoffname").val();
			
			$.ajax({
					url: baseurl+"jobhistory/Dynamic_addressDetails/",
					data:
					{
						Name:Name
					},
					type:'post',
					success: function(response) 
					{
						if(response)
						{
							var result = $.parseJSON(response);
							$("#dropoffname").val(result.name);
							$("#dropoffaddress").val(result.Building);
							$("#droplocality").val(result.Street);
							$("#dropcountry").append('<option selected name=' + result.SortName + ' value=' + result.Country + '>' + result.Country + '</option>');
							$("#dropstate").html('<option name=' + result.CountryStateId + ' value=' + result.State + '>' + result.State + '</option>');
							//$("#dropcountry").html('<option value=' + result.Country + '>' + result.Country + '</option>');
							//$("#dropstate").html('<option value=' + result.State + '>' + result.State + '</option>');
							$("#dropcity").val(result.Suburb);
							$("#droppostalcode").val(result.Postcode);
							$("#dropoffphone").val(result.Phoneno);
							
							var country = $('#dropcountry option:selected').attr('name');
							DropCountryStateList(country);
							
							var state = $('#dropstate option:selected').attr('name');
							CityList(state);
							
						}
					}
				});
		});
	}
	
	$("#pickupname,#Email").on('change',function()
	{ 
		//$("#pickupname").val("");
		$("#pickupphone").val("");
		$("#pickupaddress").val("");
		$("#picklocality").val("");
		$("#pickcountry").html("");
		$("#pickstate").html("");
		$("#pickcity").val("");
		$("#pickpostalcode").val("");
		
		
		$.ajax({
				url : '<?php echo base_url(); ?>general/country_list_option',
				success : function(data)
				{ 
					$('#pickcountry').html(data);
				}
			}); 
	});
	
	$("#dropoffname").on('change',function()
	{
		$("#dropoffphone").val("");
		$("#dropoffaddress").val("");
		$("#droplocality").val("");
		$("#dropcountry").html("");
		$("#dropstate").html("");
		$("#dropcity").val("");
		$("#droppostalcode").val("");
		
		$.ajax({
				url : '<?php echo base_url(); ?>general/country_list_option',
				success : function(data)
				{ 
					$('#dropcountry').html(data);
				}
			}); 
	});
	
	function PickCountryStateList(country)
	{
		if(country != '')
		{
			$.ajax({
				url: baseurl+"general/state_list",
				type:'post',
				data:{
					country:country
				},
				success:function(res)
				{
					var data = jQuery.parseJSON(res);
					$('#pickstate').append(data);
					
				}
			});
		}
	}
	
	function DropCountryStateList(country)
	{
		if(country != '')
		{
			$.ajax({
				url: baseurl+"general/state_list",
				type:'post',
				data:{
					country:country
				},
				success:function(res)
				{
					var data = jQuery.parseJSON(res);
					$('#dropstate').append(data);
				}
			});
		}
	}
	
	function CityList(state)
	{
		$('#pickcity').typeahead({
			
			source: function (query, result) 
			{
				$.ajax({
					url: baseurl+"general/key_city_list",
					data:{
					query:query,
					state:state
					},					
					dataType: "json",
					type: "POST",
					success: function (data) {
						result($.map(data, function (item) {
							return item;
						}));	
					}
				});
			}
		});
	}
	
</script>
   
	
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script>
   // var pickupaddress = document.getElementById('pickupaddress');
   // var autocomplete = new google.maps.places.Autocomplete(pickupaddress);
	
//	var dropoffaddress = document.getElementById('dropoffaddress');
   // var autocomplete1 = new google.maps.places.Autocomplete(dropoffaddress);
</script>