<!DOCTYPE html>
<html lang="en">
<head>
    <title>Members API</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <base href="{{url('/')}}/">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            var SITEURL = $('base').attr('href');
            $('#membersList').DataTable();
            $('body').on('click', '.editMemberButton', function () {
                var rowID=$(this).data("rowid");
                $.get(SITEURL +rowID+'/edit', function (data) {
                    $('#btn-save').val("create-member");
                    $('#MemberForm').trigger("reset"); 
                    $('#member_id').val(data.id);
                    $('#first_name').val(data.first_name);
                    $('#last_name').val(data.last_name);
                    $('#phone_number').val(data.phone_number);
                    $('#client_member_id').val(data.client_member_id);
                    $('#account_id').val(data.account_id);
                    $('#MemberForm .form-control').removeClass("error");
                    $('#MemberForm label.error').hide();
                    $('#memberCrudModal').html("Edit Member");
                    $('#createMember').html('Update Member');
                    $('#createForm').modal('show');
                })
            });
            $('#createMemberButton').click(function () {
                $('#btn-save').val("create-member");
                $('#memberForm').trigger("reset");    
                $('#memberForm .form-control').removeClass("error");
                $('#memberForm label.error').hide();
                $('#dispicon').html("");
                $('#member_id').val("");
                $('#iconimg').html("&nbsp;");  
                $('#memberCrudModal').html("Create Member");
                $('#createMember').html('Save Member');
                $('#createForm').modal('show');
            });
        });
    </script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12 text-right pb-20" style="padding-bottom: 15px;padding-top: 15px;">
                <a class="btn btn-success" href="javascript:void(0);" id="createMemberButton">Add Member </a>
            </div>
        </div>

        <div class="row row-xs">
            <div class="col-sm-12 col-lg-12">
                <table class="table" id="membersList" style="width:100%">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone Number</th>
                            <th>Client Member Id</th>
                            <th>Account Id</th>
                            <th>Updates On</th>
                            <th>Added On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tblmembers as $key => $value) {
                        ?>
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->first_name}}</td>
                            <td>{{$value->last_name}}</td>
                            <td>{{$value->phone_number}}</td>
                            <td>{{$value->client_member_id}}</td>
                            <td>{{$value->account_id}}</td>
                            <td>{{$value->created_at}}</td>
                            <td>{{$value->modified_at}}</td>
                            <td>
                                <a href="javascript:void(0);" title="Edit Member" data-rowid="{{$value->id}}"  class="editMemberButton"><span class="badge bg-info">EDIT</span></a>&nbsp;
                                <a href="{{route('memberdelete',[$value->id])}}" title="Delete Member" data-rowid="{{$value->id}}" onclick="return confirm('Are you sure want to delete?')"><span class="badge bg-danger">DELETE</span></a>
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
<div id="createForm" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="memberCrudModal">Create Member</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="MemberForm" action="{{route('memberstore')}}" method="post" name="MemberForm" class="form-horizontal">
                @csrf
                <input type="hidden" class="form-control" name="member_id" id="member_id" value="">
                <div class="modal-body">
                    <div class="row row-sm">
                        <div class="col-sm-12 mg-t-10">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required="required" name="first_name" id="first_name">
                        </div>
                        <div class="col-sm-12 mg-t-10">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required="required" name="last_name" id="last_name">
                        </div>
                        <div class="col-sm-12 mg-t-10">
                            <label>Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required="required" name="phone_number" id="phone_number">
                        </div>
                        <div class="col-sm-12 mg-t-10">
                            <label>Client Member Id <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required="required" name="client_member_id" id="client_member_id">
                        </div>
                        <div class="col-sm-12 mg-t-10">
                            <label>Account Id <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" required="required" name="account_id" id="account_id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="createMember" class="btn btn-success" id="btn-save" value="create">Save Member</button>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>