<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form Edit Konsumen
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('konsumen') ?>" class="btn btn-sm btn-secondary btn-icon-split">
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
                <?= form_open ('', [], ['id_konsumen' => $konsumen['id_konsumen']]); ?>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="nama_konsumen">Nama Konsumen</label>
                    <div class="col-md-9">
                         <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                        </div>
                        <input value="<?= set_value('nama_konsumen',$konsumen['nama_konsumen']); ?>" name="nama_konsumen" id="nama_konsumen" type="text" class="form-control" placeholder="Nama Konsumen...">
                    </div>
                        <?= form_error('nama_konsumen', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="alamat_konsumen">Alamat</label>
                    <div class="col-md-9">
                        <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                    </div>
                    <textarea name="alamat_konsumen" id="alamat_konsumen" class="form-control" rows="4" placeholder="Alamat Konsumen..."><?= set_value('alamat_konsumen',$konsumen['alamat_konsumen']); ?></textarea> 
                    </div>
                        <?= form_error('alamat_konsumen', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                 <div class="row form-group">
                    <label class="col-md-3 text-md-right" for="no_tlp">Nomor Telepon</label>
                    <div class="col-md-9">
                        <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-phone"></i></span>
                    </div>
                        <input value="<?= set_value('no_tlp',$konsumen['no_tlp']); ?>" name="no_tlp" id="no_tlp" type="text" class="form-control" placeholder="No Telepon...">
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