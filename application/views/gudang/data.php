<?= $this->session->flashdata('pesan'); ?>
<div class="card shadow-sm border-bottom-primary">
    <div class="card-header bg-white py-3">
        <div class="row">
            <div class="col">
                <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                    Data Gudang
                </h4>
            </div>
            <div class="col-auto">
                <a href="<?= base_url('gudang/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">
                        Tambah Gudang
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped w-100 dt-responsive nowrap" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Gudang</th>
                    <th>Nama Gudang</th>
                    <th>Alamat</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($gudang) :
                    $no = 1;
                    foreach ($gudang as $g) :
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $g['id_gudang']; ?></td>
                            <td><?= $g['nama_gudang']; ?></td>
                            <td><?= $g['alamat_gudang']; ?></td>
                            <td><?= $g['no_tlp']; ?></td>
                            <th>
                                <a href="<?= base_url('gudang/edit/') . $g['id_gudang'] ?>" class="btn btn-circle btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                <a onclick="return confirm('Yakin ingin hapus?')" href="<?= base_url('gudang/delete/') . $g['id_gudang'] ?>" class="btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </th>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" class="text-center">
                            Data Kosong
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>