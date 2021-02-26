<!-- Modal -->
<div class="modal fade" id="category" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new categories</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <form id = "form_cat" onsubmit="return false">
                  <div class="form-group">
                    <label>Category</label>
                    <input type="text" class="form-control" id="cate" name="cate">
                    <small id="cate_error" class="form-text text-muted">.</small>
                  </div>
                  <div class="form-group">
                    <label>Parent Category</label>
                    <select id="parent" name="parent" class="form-control">
                        
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>