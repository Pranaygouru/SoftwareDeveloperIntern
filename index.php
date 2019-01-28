<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <title>Software Developer Intern</title>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-12">
      <button type="button" id="add-row" class="btn btn-primary">Add</button>
      <hr class="my-2">
      <table class="table table-striped">
        <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
          <th scope="col">Edit / Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        include('connect.php');
        $details = mysqli_query($conn, "SELECT * FROM person_details");
        while ($row = mysqli_fetch_array($details)) {
          ?>
          <tr id="row-<?php echo $row[0]; ?>">
            <th id="id-<?php echo $row[0]; ?>" scope="row"><?php echo $row[0]; ?></th>
            <td id="first-<?php echo $row[0]; ?>"><?php echo $row[1]; ?></td>
            <td id="last-<?php echo $row[0]; ?>"><?php echo $row[2]; ?></td>
            <td id="handle-<?php echo $row[0]; ?>"><?php echo $row[3]; ?></td>
            <td>
              <button class="btn btn-outline-secondary edit-btn" data-id="<?php echo $row[0]; ?>">
                <i class="fas fa-edit"></i>
              </button>
              <div class="btn-group mr-2">
                <button class="btn btn-outline-secondary delete-btn" data-id="<?php echo $row[0]; ?>">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </div>
            </td>
          </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="handler.php" method="post">
        <div class="modal-body">
          <p>Are you sure to delete this row?</p>
          <div class="d-none">
            <input type="hidden" id="delete-id-holder" name="delete-id-holder">
            <input type="hidden" id="operation" name="operation" value="delete">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="handler.php">
        <div class="modal-body">
          <input type="hidden" id="operation" name="operation" value="update">
          <div class="form-group row" id="id-edit-row">
            <label for="id-edit" class="col-4 col-form-label">ID</label>
            <div class="col-8">
              <input type="text" readonly class="form-control-plaintext" id="id-edit" name="id-edit">
            </div>
          </div>
          <div class="form-group row">
            <label for="first-edit" class="col-4 col-form-label">First Name</label>
            <div class="col-8">
              <input type="text" class="form-control" id="first-edit" name="first-edit" placeholder="First Name">
            </div>
          </div>
          <div class="form-group row">
            <label for="last-edit" class="col-4 col-form-label">Last Name</label>
            <div class="col-8">
              <input type="text" class="form-control" id="last-edit" name="last-edit" placeholder="Last Name">
            </div>
          </div>
          <div class="form-group row">
            <label for="handle-edit" class="col-4 col-form-label">Handle</label>
            <div class="col-8">
              <input type="text" class="form-control" id="handle-edit" name="handle-edit" placeholder="Handle">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="edit-submit-btn">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".edit-btn").click(function (e) {
            let id = $(this).attr("data-id");
            $("#id-edit").val($("#id-" + id).html());
            $("#first-edit").val($("#first-" + id).html());
            $("#last-edit").val($("#last-" + id).html());
            $("#handle-edit").val($("#handle-" + id).html());
            $("#edit_modal input[name=operation]").val('update');
            $("#edit-submit-btn").html("Update");
            $('#edit_modal').modal('show');
        });
        $('#edit_modal').on('hidden.bs.modal', function (e) {
            $("#id-edit").val("");
            $("#first-edit").val("");
            $("#last-edit").val("");
            $("#handle-edit").val("");
            $("#edit_modal input[name=operation]").val('');
            $('#id-edit-row').removeClass('d-none');
        });
        $('#delete_modal').on('hidden.bs.modal', function (e) {
            $('#delete-id-holder').val("");
        });
        $(".delete-btn").click(function (e) {
            $('#delete-id-holder').val($(this).attr("data-id"));
            $("#delete_modal").modal('show');
        });
        $("#add-row").click(function () {
            $("#edit_modal input[name=operation]").val('add');
            $("#edit-submit-btn").html("Add");
            $('#id-edit-row').addClass('d-none');
            $('#edit_modal').modal('show');
        });
    });
</script>
</body>
</html>