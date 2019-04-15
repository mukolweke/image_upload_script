<!-- Modal -->
<div class="modal fade" id="addItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Shopping Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="itemNameInput">Item Name</label>
                        <input type="text" class="form-control" id="itemNameInput" name="item_name"
                               placeholder="Item Name">
                    </div>
                    <div class="form-group">
                        <label for="itemPriceInput">Item Price</label>
                        <input type="number" class="form-control" id="itemPriceInput" name="item_price"
                               placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="itemCountInput">Item Count</label>
                        <input type="number" class="form-control" id="itemCountInput" name="item_count"
                               placeholder="Count">
                    </div>

                    <div class="form-group">
                        <label for="itemImage">Item Image</label>
                        <input type="file" class="form-control-file" id="item_image" name="fileToUpload">
                    </div>

                    <input type="hidden" name="action" value="add-item">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Continue Shopping</button>
                    <button type="submit" class="btn btn-success">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>