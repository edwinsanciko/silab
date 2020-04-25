 <!-- Begin Page Content -->
 <div class="container-fluid">
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
     <div class="row">
         <div class="col-lg">
             <div class="content-wrapper">
                 <section class="content">
                     <form action="<?php echo base_url() . 'menu/newEditDataLokasi'; ?>" method="post">
                         <div class="form-group">
                             <input type="hidden" name="id_lokasi" class="form-control" value="<?= $dataLokasi->id_lokasi ?>">
                             <select name="id_prodi" id="form-control" class="form-control">
                                 <?php foreach ($dataProdi as $dp) :
                                        $idDL = $dataLokasi->id_prodi;
                                        $idDP = $dp->id_prodi;
                                        if ($idDL == $idDP) {
                                    ?>
                                     <?php } ?>
                                     <option value=<?php echo $dp->id_prodi ?>><?php echo $dp->nama_prodi ?></option>
                                 <?php endforeach; ?>
                             </select>
                         </div>
                         <div class="form-group">
                             <label for="">Nama Lab</label>
                             <input type="text" name="nama_lab" class="form-control" value="<?= $dataLokasi->nama_lab ?>">
                         </div>
                         <input type="submit" class="btn btn-primary" value="Update" />
                         <button type="reset" class="btn btn-danger" onclick="Cancel('cancel');">Cancel</button>
                     </form>
                 </section>
             </div>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->