<?php
include("../controllers/Barang.php");

include("../lib/functions.php");
$obj = new BarangController();

if(isset($_GET["id"])){
    $id=$_GET["id"];
}


$rows = $obj->getBarang($id);
$theme=setTheme();
getHeader($theme);
?>


    <div class="header icon-and-heading">
    <i class="zmdi zmdi-view-dashboard zmdi-hc-4x custom-icon"></i>
    <h2><strong>Barang</strong> <small>Upload Data</small> </h2>
    </div>
    <hr/>
    <form name="uploadForm" id="uploadForm" enctype="multipart/form-data">
        <input type="hidden" class="form-control" name="submitted" value="1"/>
        <dl class="row mt-1">
        <?php foreach ($rows as $row): ?>
        
        
                            <dt class="col-sm-3">Id:</dt><dd class="col-sm-9"><?php echo $row['id']; ?></dd>
                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>" readonly />
            
                            <dt class="col-sm-3">ID Barang:</dt><dd class="col-sm-9"><?php echo $row['id']; ?></dd>
                            <dt class="col-sm-3">Kode Barang:</dt><dd class="col-sm-9"><?php echo $row['kode_barang']; ?></dd>
                            <dt class="col-sm-3">Nama:</dt><dd class="col-sm-9"><?php echo $row['nama_barang']; ?></dd>
                            <dt class="col-sm-3">Kategori:</dt><dd class="col-sm-9"><?php echo $row['kategori']; ?></dd>
                            <dt class="col-sm-3">Stok:</dt><dd class="col-sm-9"><?php echo $row['stok']; ?></dd>
                            <dt class="col-sm-3">Harga:</dt><dd class="col-sm-9"><?php echo $row['harga']; ?></dd> 
                
            
        </dl>
        <div id="uploadmessage"></div>
        <div class="form-group">
            <label>foto:</label>
            <input type="file" id="imageInput" name="foto" accept="image/*">
            <div class="preview-container">
                <img id="preview" src="" alt="Preview">
            </div>
        </div>
        <button class="save btn btn-large btn-info" type="submit">Upload</button>
        
        <?php endforeach; ?>
    </form>
    <script>
        const form = document.getElementById('uploadForm');
        const imageInput = document.getElementById('imageInput');
        const preview = document.getElementById('preview');
        const previewContainer = document.querySelector('.preview-container');
        const uploadmessage = document.getElementById('uploadmessage');

        // Preview image before upload
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        // Handle form submission
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData();
            formData.append('foto', imageInput.files[0]);
            const id = <?php echo json_encode($id); ?>; // Safely embed PHP variable
            const url = `../lib/uploadbarang.php?id=${id}`;
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    uploadmessage.textContent = 'Image uploaded successfully!';
                    uploadmessage.style.color = 'green';
                } else {
                    uploadmessage.textContent = 'Upload failed: ' + data.message;
                    uploadmessage.style.color = 'red';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                uploadmessage.textContent = 'Upload failed!';
                uploadmessage.style.color = 'red';
            });
        });
    </script>
                                       
<?php
getFooter($theme,"");
?>
