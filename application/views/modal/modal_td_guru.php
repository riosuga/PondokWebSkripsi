<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Pengisian Data Guru</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor Induk Pegawai</label>
                            <div class="col-md-9">
                                <input name="nip" placeholder="Nip Guru" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama</label>
                            <div class="col-md-9">
                                <input name="nama" placeholder="Nama" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Arab</label>
                            <div class="col-md-9">
                                <input name="nama_ar" placeholder="أسماء باللغة العربية" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                          <label class="col-sm-2 control-label">Kompentensi Guru</label>
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
                            <label class="control-label col-md-3">Kelamin</label>
                            <div class="col-md-9">
                                <div class="radio">
                                     <label><input type="radio" name="kelamin" id="laki" value="L">Laki Laki</label>
                                </div>
                                <div class="radio">
                                     <label><input type="radio" name="kelamin" id="Perempuan" value="P">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tempat Lahir</label>
                            <div class="col-md-9">
                                <input name="tempat_lahir" placeholder="tempat lahir" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tanggal Lahir</label>
                            <div class="col-md-9">
                                <input name="tgl_lahir" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nomor Telepon</label>
                            <div class="col-md-9">
                                <input name="no_hp" placeholder="Nomor Telepon" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="blabla@example.com" class="form-control" type="email">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3">Alamat</label>
                            <div class="col-md-9">
                                <input name="alamat" placeholder="Alamat" class="form-control" type="text">
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