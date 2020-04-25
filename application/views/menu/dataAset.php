            <!-- Begin Page Content -->
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                <!-- Page Heading -->
                <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Tambah Data Aset Baru</a>
                <div class="row">
                    <div class="col-lg">
                        <div class="dataTables_length" id="tabel-data_length">
                            <label>Show
                                <select name="tabel-data_length" aria-controls="tabel-data" class="form-control input-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </label>
                        </div>
                    </div>
                    <div class="navbar-form navbar-right row">
                        <?php echo form_open('menu/search') ?>
                        <label><br><input type="text" name="keyword" class="form-control input-sm" placeholder="Search"></label>
                        <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                        <?php echo form_close() ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg">

                        <?php if (validation_errors()) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors(); ?>
                            </div>
                        <?php endif; ?>
                        <?= $this->session->flashdata('message'); ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Spesifikasi</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Satuan</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($dataAset as $da) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $da['nama_lab']; ?></td>
                                        <td><?= $da['nama_barang']; ?></td>
                                        <td><?= $da['spesifikasi']; ?></td>
                                        <td><?= $da['jumlah']; ?></td>
                                        <td><?= $da['satuan']; ?></td>
                                        <td><?= $da['keterangan']; ?></td>
                                        <td><img src="<?php echo base_url() . 'assets/media/' . $da['foto']; ?>" width="150" height="100" /></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'menu/editDataAset/' . $da['kode_aset']; ?>" class="text-success"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url() . 'menu/deleteDataAset/' . $da['kode_aset']; ?>" class="text-danger"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="dataTables_info" id="tabel-data_info" role="status" aria-live="polite">Showing 1 to 10 of 213 entries</div>
                    </div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!--MODAL-->

            <!-- Modal -->
            <div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newSubMenuModalLabel">Tambah Data Aset Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('menu/dataAset'); ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <select name="id_lokasi" id="id_lokasi" class="form-control">
                                        <option value="">Pilih Lokasi Data Aset</option>
                                        <?php foreach ($lokasi as $lk) : ?>
                                            <option value="<?= $lk['id_lokasi']; ?>"><?= $lk['nama_lab']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="spesifikasi" name="spesifikasi" placeholder="Spesifikasi">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="jumlah" name="jumlah" placeholder="Jumlah">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Keterangan">
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" id="image" name="image" placeholder="Foto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">TUTUP</button>
                                <button type="submit" class="btn btn-success">TAMBAH</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>