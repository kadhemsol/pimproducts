
	
<div class="wrapper">
	
<div class="container">
			
	<div class="col-lg-12">
		
		<?php if(isset($validation)) : ?>

            <div class="alert alert-danger" role="alert">
            	<strong><?= $validation->listErrors() ?></strong>
            </div>
        
		<?php endif; ?>   
		
		<form action="<?= base_url('products/new_attribute') ?>" method="post" class="form-horizontal">
				
			<div class="form-group">
			<label class="col-sm-3 control-label">Firstname</label>
			<div class="col-sm-6">
			<input type="text" name="att_name" id="txt_firstname" class="form-control" placeholder="enter firstname" />
			</div>
			</div>
					
			<div class="form-group">
			<label class="col-sm-3 control-label">Lastname</label>
			<div class="col-sm-6">
			<input type="text" name="att_label" id="txt_lastname" class="form-control" placeholder="enter lastname" />
			</div>
			</div>

			<div class="form-group">
			<label class="col-sm-3 control-label">Lastname</label>
			<div class="col-sm-6">
			<input type="text" name="att_required" id="txt_lastname" class="form-control" placeholder="enter lastname" />
			<input type="checkbox" name="att_required[]" value="1"></td> 
			</div>
			</div>

			<div class="form-group">
			<label class="col-sm-3 control-label">Lastname</label>
			<div class="col-sm-6">
			<input type="text" name="att_type" id="txt_lastname" class="form-control" placeholder="enter lastname" />
			<select name="att_type">

  <option value="varchar">Varchar</option>
  <option value="text">Text</option>
  <option value="select">Select</option>

</select>



			</div>
			</div>
											
			<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9 m-t-15">
			<button type="submit" class="btn btn-success">Insert</button>
			<a href="<?= base_url('/') ?>" class="btn btn-danger">Cancel</a>
			</div>
			</div>
					
		</form>
			
	</div>
		
</div>
			
</div>

