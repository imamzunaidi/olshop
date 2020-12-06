<div class="col-md-12">
            <!-- general form elements disabled -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Form Input Add Barang</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php 
        echo validation_errors('<div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i>', '</h5></div>');


        if(isset($error_upload)){
          echo '<div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-info"></i>';
          echo $error_upload;
          echo '</h5></div>';
        }
      ?>
      <form method = "POST" action = "" enctype="multipart/form-data">
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" name = "nama_barang" class="form-control" placeholder="Nama Barang" value = "<?= set_value('nama_barang')?>">
        </div>
        <div class="row"> 
          <div class="col-sm-6">
            <div class="form-group">
              <label>Harga</label>
              <input type="text" name = "harga" class="form-control" placeholder="Harga" value = "<?= set_value('harga')?>">
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label>Kategori</label>
                <select name="id_kategori" class = "form-control" value = "<?= set_value('id_kategori')?>">
                  <option value="">--Pilih--</option>
                  <?php foreach($kategori as $key => $value){?>
                    <option value="<?= $value->id_kategori?>"><?= $value->nama_kategori?></option>
                  <?php }?>
                </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>Deskripsi Barang</label>
          <textarea name="deskripsi" class = "form-control" id="" cols="30" rows="5" placeholder="Deskripsi Barang" value = "<?= set_value('deskripsi')?>"></textarea>
        </div>
        <div class="form-group">
          <label>Gambar</label>
          <input type="file" name = "gambar" class="form-control" id="preview_gambar" value = "<?= set_value('gambar')?>" required>
        </div>
        <div class="form-group">
          <label>priview</label>
          <br>
          <img src="<?= base_url('assets/gambar/no_foto.jpg')?>" id="gambar_load" alt="no_foto" width = "20%">
        </div>
      
        
        <div class="form-group text-right">
          <button type = "submit" class = "btn btn-primary">Simpan</button>
          <a href="<?= base_url('barang')?>" class = "btn btn-danger">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  function bacaGambar(input){
    if(input.files && input.files[0]){
      var reader = new FileReader();
      reader.onload = function(e){
        $('#gambar_load').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#preview_gambar").change(function(){
    bacaGambar(this);
  });

</script>