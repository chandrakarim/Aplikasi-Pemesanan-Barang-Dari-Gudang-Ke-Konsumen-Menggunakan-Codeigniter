<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Tambah Gudang
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('gudang') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>
                <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="id_gudang">ID Gudang</label>
                    <div class="col-md-9">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-id-card"></i></span>
                    </div>
                        <input readonly value="<?= set_value('id_gudang', $id_gudang); ?>" name="id_gudang" id="id_gudang" type="text" class="form-control" placeholder="ID Barang...">
                        </div>
                        <?= form_error('id_gudang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_gudang">Nama Gudang</label>
                    <div class="col-md-9">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-warehouse"></i></span>
                    </div>
                        <input value="<?= set_value('nama_gudang'); ?>" name="nama_gudang" id="nama_gudang" type="text" class="form-control" placeholder="Nama Gudang...">
                        </div>
                        <?= form_error('nama_gudang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="alamat_gudang">Alamat</label>
                    <div class="col-md-9">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                    </div>
                    <textarea name="alamat_gudang" id="alamat_gudang" class="form-control" rows="4" placeholder="Alamat..."><?= set_value('alamat_gudang'); ?></textarea>
                          </div>
                        <?= form_error('alamat_gudang', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_tlp">Nomor Telepon</label>
                    <div class="col-md-9">
                    <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-phone"></i></span>
                    </div>
                        <input value="<?= set_value('no_tlp'); ?>" name="no_tlp" id="no_tlp" type="text" class="form-control" placeholder="Nomor Telepon">
                          </div>
                        <?= form_error('no_tlp', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-9 offset-md-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>