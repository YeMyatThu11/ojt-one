<div>
    <div class="modal fade" id="promoteConfirmation" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered model-dialog-adm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Confirm</h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form class="user-promote-form" action="" method="post">
                        @csrf
                        @method('put')
                        <button type="button" class="btn btn-secondary action-promote-btn">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered model-dialog-adm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form class="del-icon-form " action="" method="post">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-secondary action-delete-btn">Yes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script>
        $(document).ready(() => {
            var dataId;
            var tableName;
            $(document).on("click", ".btn-promote", function() {
                dataId = $(this).attr('data-item');
                var username = $(this).attr('data-name');
                var userRole = $(this).attr('data-role') == 1 ? 'user' : 'admin';
                $('.modal-body').text(
                    `Are you sure about changing  ${username}'s role to ${userRole}?`);
            });
            $(document).on("click", ".action-promote-btn", () => {
                $('.user-promote-form').attr("action", `/user/${dataId}/changeRole`);
                $('.user-promote-form').submit();
            });
            $(document).on("click", ".btn-delete", function() {
                dataId = $(this).attr('data-item');
                var username = $(this).attr('data-name');
                tableName = $(this).attr('data-table');
                $('.modal-body').text(
                    `Are you sure about deleting ${tableName?"this post?":"user "+username+" ?"}`);
            });
            $(document).on("click", ".action-delete-btn", () => {
                $('.del-icon-form').attr("action", `${tableName ? "/posts/" +dataId : "/user/" +dataId}`);
                $('.del-icon-form').submit();
            });
        });
    </script>
@endsection
