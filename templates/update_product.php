<!-- Modal -->
<div class="modal fade" id="product_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit products</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container" id ="mesg"></div>
            <form id="form_prod_update" onsubmit="return false">
            	<input type="hidden" name="pid" id="pid" value="">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Date</label>
                  <input type="text" class="form-control" id="date" name="up_date"
                  value = "<?php echo date('Y-m-d')?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="">Product Name</label>
                <input type="text" class="form-control" id="pName" name = "up_pName" placeholder="Product Names" required>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Category</label>
                  <select id="categ" name="up_cid" class="form-control" required>

                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="">Brand</label>
                  <select id="brand1" name="up_bid" class="form-control" required>

                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Product Price</label>
                  <input type="text" class="form-control" id="price" name="up_price" placeholder="Product price" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="">Quantity</label>
                  <input type="text" class="form-control" id="qty" name="up_qty" placeholder="Product quantity" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>