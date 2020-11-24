<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
--><?php
$urlToRestApi = $this->Url->build('/api/topics', true);
echo $this->Html->scriptBlock('var urlToRestApi = "' . $urlToRestApi . '";', ['block' => true]);
echo $this->Html->script('Topics/index', ['block' => 'scriptBottom']);
?>

        <div class="container">
            <div class="row">
                <div class="col-md-12 head">
                    <h5>Topics</h5>
                    <!-- Add link -->
                    <div class="float-right">
                        <a href="javascript:void(0);" class="btn btn-success" data-type="add" data-toggle="modal" data-target="#modalTopicAddEdit"><i class="plus"></i> New Topic</a>
                    </div>
                </div>
                <div class="statusMsg"></div>
                <!-- List the users -->
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name of topic</th>
                            <th>Code</th>
                           
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="topicData">
                        <?php if (!empty($topics)) {
                            foreach ($topics as $row) { ?>
                                <tr>
                                    <td><?php echo '#' . $row['id']; ?></td>
                                    <td><?php echo $row['nom']; ?></td>
                                    <td><?php echo $row['code']; ?></td>
                                    
                                    <td>
                                        <a href="javascript:void(0);" class="btn btn-warning" rowID="<?php echo $row['id']; ?>" data-type="edit" data-toggle="modal" data-target="#modalTopicAddEdit">edit</a>
                                        <a href="javascript:void(0);" class="btn btn-danger" onclick="return confirm('Are you sure to delete data?') ? topicAction('delete', '<?php echo $row['id']; ?>') : false;">delete</a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr><td colspan="5">No user(s) found...</td></tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Modal Add and Edit Form -->
        <div class="modal fade" id="modalTopicAddEdit" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Topic</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="statusMsg"></div>
                        <form role="form">
                            <div class="form-group">
                                <label for="nom">Name</label>
                                <input type="text" class="form-control" name="nom" id="nom" placeholder="Enter the topic name">
                            </div>
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="code" class="form-control" name="code" id="code" placeholder="Enter the topic code">
                            </div>
                           
                            <input type="hidden" class="form-control" name="id" id="id"/>
                        </form>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success" id="topicSubmit">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
