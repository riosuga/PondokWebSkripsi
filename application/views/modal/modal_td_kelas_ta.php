<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Pengisian Kelas Tahun Ajaran</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <input type="hidden" name="id_kelas" value="<?php foreach ($data_kelas as $kelas) {
                        echo $kelas['id_kelas'];
                    } ?>">
                    <div class="form-body">
                         <div class="form-group">
                          <label class="col-sm-2 control-label">Nama Guru</label>
                            <div class="col-sm-10">
                              <select name="id_guru" required id="id_guru" class="form-control m-bot15">
                                <?php foreach ($data_guru as $data) {
                                   echo '<option value="'.$data['id_guru'].'">'.$data['nama'].'</option>';
                                } ?>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Semester</label>
                            <div class="col-md-9">
                               <select name="semester" class="form-control m-bot15">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tahun</label>
                            <div class="col-md-9">
                                <input name="tahun" placeholder="20xx" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->