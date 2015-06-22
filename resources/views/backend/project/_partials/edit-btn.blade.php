<!-- TODO:Add option for user to always select one method over the other -->
<button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#Edit-Project-{{$project->id}}">
    <i class="fa fa-edit"></i>
</button>
<div class="modal fade" id="Edit-Project-{{$project->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Project: {{$project->slug}}</h4>
            </div>
            <div class="modal-body">
                <div class="callout callout-info">
                    <p>Use the table below to choose an Editing Method</p>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td></td>
                            <td><b>Inline Edit</b></td>
                            <td><b>Admin Edit</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>WYSIWYG</td>
                            <td>Yes</td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td>Drag And Drop</td>
                            <td>Yes</td>
                            <td>No</td>
                        </tr>
                        <tr>
                            <td>Edit Raw HTML</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <td>Edit Project Details</td>
                            <td>Yes</td>
                            <td>Yes</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <a href="{{URL::route('admin.projects.edit.inline',$project)}}" type="button" class="btn btn-success">Inline Edit</a>
                <a href="{{URL::route('admin.projects.edit',$project)}}" type="button" class="btn btn-danger">Admin Edit</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>