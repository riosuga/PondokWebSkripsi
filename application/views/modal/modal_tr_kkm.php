<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Referensi KKM</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nilai</label>
                            <div class="col-sm-3">
                                <input name="nilai" placeholder="nilai" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                          <label class="col-sm-2 control-label">Pelajaran</label>
                            <div class="col-sm-10">
                              <select name="pelajaran" required id="pelajaran" class="form-control m-bot15">
                                <option value=""></option>
                                <?php foreach ($pelajaran as $data) {
                                   echo '<option value="'.$data['id_pelajaran'].'">'.$data['uraian'].'</option>';
                                } ?>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Uraian</label>
                            <div class="col-sm-10">
                              <select name="id_ta" required id="id_ta" class="form-control m-bot15">
                                <option value=""></option>
                                <?php foreach ($tahun_ajaran as $data) {
                                   echo '<option value="'.$data['id_ta'].'">'.$data['nama_kelas'].' - Semester : '.$data['semester'].' tahun : '.$data['tahun'].' dengan Wali kelas '.$data['nama'].'</option>';
                                } ?>
                              </select>
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