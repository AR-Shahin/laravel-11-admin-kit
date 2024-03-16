<?php
function rowEditModal($row,$route){
    echo '
    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#rowId_'.$row->id.'">
     <i class="fa fa-edit"></i>
    </button>
    <div class="modal fade" id="rowId_'.$row->id.'" tabindex="-1" role="dialog" aria-labelledby="rowId_'.$row['id'].'Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <form action="'.$route .'" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="rowId_'.$row->id.'Label">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="_token" value=" '. csrf_token() .'">
            <div class="form-group">
                <label for=""><b>Name</b></label>
                <input type="text" class="form-control" name="name" value="'. $row->name.'">
            </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
      </form>
    </div>
  </div>';

}
