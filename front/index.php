<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-content/plugins/BSBA/back/functions.php');
    
    $data = getAll();
	$picsPath = '/wp-content/plugins/BSBA/storage';
?>

<div class="div_all">
      <h1>Upload pictures</h1>
	<div class="">
		<div class="div_form">
            <form method="POST" action="/wp-content/plugins/BSBA/back/upload.php" enctype="multipart/form-data">
                <div class="div_label">
                    <label for="img1">Picture 'BEFORE'</label>
                    <input type="file" id="img1" name="before">
                </div>
                <div class="div_label">
                    <label for="img2">Picture 'AFTER'</label>
                    <input type="file" id="img2" name="after">
                </div>
                <div class="div_label"> 
                    <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" require>
				</div>
                <div class="div_label">
					<button type="submit" class="btn btn-success" name="submit">Save</button>
                </div>
			</form>
        </div>
	</div>
		<div class="table">
			<table id="customers">
				<thead>
					<tr>
						<th>Before</th>
						<th>After</th>
						<th>Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				<!-- Show blocks -->
				<?php if($data): ?>
					<?php foreach($data as $item): ?>
						<tr class="item-<?= $item->id; ?>">
							<td>
								<img src="<?= $picsPath . '/before/' . $item->pic_name ?>" alt="">
							</td>
							<td>
								<img src="<?= $picsPath . '/after/' . $item->pic_name ?>" alt="">
							</td>
							<td>
								<?= getBlockName($item->pic_name) ?>
							</td>
							<td style="text-align: center;" >
							    <input  type="hidden" class="id_all" value="<?= $item->id ?>">
							    <button type="button" data-toggle="modal" data-target="#ModalEdit" class="button_edit"><i class="fas fa-pen"></i></button>
							    <button type="button" data-toggle="modal" data-target="#ModalDelete" class="button_delete"><i class="fas fa-trash-alt"></i></button>
							</td>
						</tr>
					<?php endforeach; ?>
				<?php endif;?>
				<!-- end show blocks -->
				</tbody>
			</table>
		</div>
	</div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      	<div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Edit this pictures</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>
		<form id="modal-form" method="POST" action="/wp-content/plugins/BSBA/back/update.php" enctype="multipart/form-data">
      		<div class="modal-body">
      			<div class="item_form">
      				<label for="img1">Before</label>
      				<input type="file" name="before" id="img1">
				</div>
      			<div class="item_form">
      				<label for="img2">After</label>
      				<input type="file" name="after" id="img2">
      			</div>
      			<div class="item_form">
      				<label for="name">Name</label>
      				<input type="text" value="" name="name" class="name_edit form-control" id="name_edit">
      			</div>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        		<button type="submit" class="btn btn-success btn-edit-item">Save changes</button>
      		</div>
  		</form>
    </div>
  </div>
</div>

<!-- Modal Delete-->
<div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      	<div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Are you sure?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
      	</div>
		<div class="modal-footer">
        	<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        	<button type="button" class="btn btn-success btn-delete-item" data-dismiss="modal">Yes</button>
      	</div>
    </div>
  </div>
</div>