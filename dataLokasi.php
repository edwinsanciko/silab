            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>



                <div class="row">
                    <div class="col-lg">

                        <?php if (validation_errors()) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors(); ?>
                            </div>
                        <?php endif; ?>


                        <?= $this->session->flashdata('message'); ?>

                        <a href="" class="btn btn-dark mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Data Location</a>
                        <div class="row">
                            <div class="col-sm-6">
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
                            <div class="col-sm-6 col-mb-4">
                                <div id="tabel-data_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="tabel-data"></label></div>
                            </div>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Prodi</th>
                                    <th scope="col">Nama Lab</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($dataLokasi as $dl) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $dl['nama_prodi']; ?></td>
                                        <td><?= $dl['nama_lab']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url() . 'menu/editDataLokasi/' . $dl['id_lokasi']; ?>" class="text-success"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="<?php echo base_url() . 'menu/deleteDataLokasi/' . $dl['id_lokasi']; ?>" class="text-danger"><i class="far fa-trash-alt"></i></a>
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
                            <h5 class="modal-title" id="newSubMenuModalLabel">Add New Data Location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('menu/dataLokasi'); ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <select name="id_prodi" id="id_prodi" class="form-control">
                                        <option value="">Select Aset Location</option>
                                        <?php foreach ($prodi as $p) : ?>
                                            <option value="<?= $p['id_prodi']; ?>"><?= $p['nama_prodi']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="nama_lab" name="nama_lab" placeholder="Nama Lab">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>