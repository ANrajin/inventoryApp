<!-- Modal -->
<div class="modal fade" id="products" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new products</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container" id ="mesg"></div>
            <form id="form_prod" onsubmit="return false" name="form_prod" enctype="multipart/form-data">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Date</label>
                  <input type="text" class="form-control" id="date" name="date"
                  value = "<?php echo date('Y-m-d')?>" readonly>
                </div>
              </div>
              <div class="form-group">
                <label for="">Product Name</label>
                <input type="text" class="form-control" id="pName" name = "pName" placeholder="Product Names" required>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Category</label>
                  <select id="categ" name="categ" class="form-control" required>

                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="">Brand</label>
                  <select id="brand1" name="brand1" class="form-control" required>

                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="">Product Price</label>
                  <input type="text" class="form-control" id="price" name="price" placeholder="Product price" required>
                </div>
                <div class="form-group col-md-6">
                  <label for="">Quantity</label>
                  <input type="text" class="form-control" id="qty" name="qty" placeholder="Product quantity" required>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>