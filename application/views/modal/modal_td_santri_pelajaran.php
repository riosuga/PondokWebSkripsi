<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Pengisian Data Nilai <?php foreach ($data_santri as $data) {
                    echo $data['nama'];
                } ?></h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <input type="hidden" name="id_santri" value ="<?php foreach ($data_santri as $data) {
                    echo $data['id_santri']; }?>">
                    <div class="form-body">
                    <input type="hidden" name="id_kelas_nilai" value="">
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Pelajaran</label>
                            <div class="col-sm-10">
                              <select name="pelajaran" required id="pelajaran" class="form-control m-bot15">
                                <?php foreach ($pelajaran as $data) {
                                   echo '<option value="'.$data['id_pelajaran'].'">'.$data['uraian'].'</option>';
                                } ?>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Nama Guru</label>
                            <div class="col-sm-10">
                              <select name="guru" required id="guru" class="form-control m-bot15">
                                <?php foreach ($data_guru_pelajaran as $data) {
                                   echo '<option value="'.$data['id_guru'].'">'.$data['nama'].'</option>';
                                } ?>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Tahun Ajaran</label>
                            <div class="col-sm-10">
                              <select name="id_santri_kelas" required id="id_santri_kelas" class="form-control m-bot15">
                                <?php foreach ($tahun_ajaran as $data) {
                                   echo '<option value="'.$data['id_santri_kelas'].'">'.'Tahun '.$data['tahun'].' Semester '.$data['semester'].' Kelas '.$data['nama_kelas'].'</option>';
                                } ?>
                              </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label">Jenis Kegiatan</label>
                            <div class="col-sm-10">
                              <select name="jns_kegiatan" required id="jns_kegiatan" class="form-control m-bot15">
                                <?php foreach ($jenis_nilai as $data) {
                                   echo '<option value="'.$data['id_nilai'].'">'.$data['uraian'].'</option>';
                                } ?>
                              </select>
                          </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-sm-3">Tanggal Ujian</label>
                            <div class="col-sm-9">
                                <input name="tgl_ujian" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Tanggal Remidi</label>
                            <div class="col-sm-9">
                                <input name="tgl_remed" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nomor Bayanat</label>
                            <div class="col-sm-9">
                                <input name="nomor" placeholder="0" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nilai Awal</label>
                            <div class="col-sm-9">
                                <input name="nilai_awal" placeholder="0" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nilai Remed</label>
                            <div class="col-sm-9">
                                <input name="nilai_remed" placeholder="0" class="form-control" type="number">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3">Nilai Akhir</label>
                            <div class="col-sm-9">
                                <input name="nilai_akhir" placeholder="0" class="form-control" type="number">
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