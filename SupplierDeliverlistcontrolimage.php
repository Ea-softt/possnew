<?php 
include 'server/config.php'; 
include 'easoftsql.php'; 


if(isset($_GET['id'])){
$qry = $conn->query("SELECT sc.*,su.*,sd.* FROM suppliercompany sc inner join supplier su on sc.companynameid = su.supplier_id inner join supplierdeliver sd on sc.id = sd.supplierid where id= ".$_GET['id']);
foreach($qry->fetch_array() as $k => $val){
    $$k=$val;
}
}
?>
<style>

/* Image Preview Container */
.image-preview-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 15px;
    border: 1px dashed #ced4da;
    padding: 15px;
    border-radius: 5px;
    min-height: 200px;
    background-color: #f8f9fa;
}

/* Individual Image Preview */
.image-preview {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 5px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #e9ecef;
}

/* Preview Image */
.preview-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 5px;
}

/* Remove Button for Images */
.remove-image {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: rgba(255, 255, 255, 0.8);
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.remove-image:hover {
    background-color: rgba(255, 0, 0, 0.8);
    color: white;
}


</style>

<div class="container-fluid p-4">
    <div class="card shadow-sm">
       
        <div class="card-body">
            <form action="" id="supplierlin" enctype="multipart/form-data">
                <div class="row">
                    <!-- Left Column: Input Fields -->
                    <div class="col-md-7">
                        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>"> 
                        <div class="form-group">
                            <label for="companyName" class="control-label">Company Name</label>
                            <select class="form-control select2" id="companyName" name="companyName" required>
                                <option value="" selected disabled>Select Company</option>
                                <?php
                                $companies = $conn->query("SELECT supplier_id, companyname FROM supplier");
                                while ($company = $companies->fetch_assoc()) {
                                    $selected = (isset($companynameid) && $companynameid == $company['supplier_id']) ? 'selected' : '';
                                    echo "<option value='{$company['supplier_id']}' $selected>{$company['companyname']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Add other input fields here -->
                       

                        
                        <div class="form-group">
                            <label for="description" class="control-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description"></textarea>
                        </div>
                    </div>

                    <!-- Right Column: Image Preview -->
                    <div class="col-md-5">
                        <h5 class="form-section-header">Product Images</h5>
                        <hr>
                        <div class="form-group">
                            <div class="image-preview-container p-3" id="imagePreviewContainer">
                                <!-- Existing images will be loaded here -->
                                <?php if (isset($meta['images'])): ?>
                                    <?php
                                    $existingImages = explode(',', $meta['images']);
                                    foreach ($existingImages as $image):
                                        if (!empty(trim($image))):
                                    ?>
                                        <div class="image-preview">
                                            <img src="<?php echo '../img/' . trim($image); ?>" alt="Product Image" class="preview-image">
                                            <input type="hidden" name="existing_images[]" value="<?php echo trim($image); ?>">
                                            <button type="button" class="remove-image" onclick="removeImage(this, '<?php echo trim($image); ?>')">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </div>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                <?php endif; ?>
                            </div>
                            <div class="custom-file mt-3">
                                <input type="file" class="custom-file-input form-control" name="images[]" id="images" multiple onchange="previewImages(this)">
                                <label class="custom-file-label" for="images">Choose file(s)</label>
                            </div>
                        </div>


                    </div>
                </div>

                <!-- Form Footer -->
                <div class="card-footer bg-light d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary mr-2">
                        <i class="fas fa-thumbs-up"></i> Save
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        <i class="fas fa-ban"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>




<script>
function previewImages(input) {
    const previewContainer = document.getElementById('imagePreviewContainer');

    if (input.files) {
        Array.from(input.files).forEach((file) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgContainer = document.createElement('div');
                imgContainer.className = 'image-preview';

                const img = document.createElement('img');
                img.className = 'preview-image';
                img.src = e.target.result;

                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.className = 'remove-image';
                removeBtn.innerHTML = '<i class="fa fa-times"></i>';
                removeBtn.onclick = function() {
                    imgContainer.remove();
                };

                imgContainer.appendChild(img);
                imgContainer.appendChild(removeBtn);
                previewContainer.appendChild(imgContainer);
            };

            reader.readAsDataURL(file);
        });
    }
}

function removeImage(element, imageName) {
    if (confirm("Are you sure you want to remove this image?")) {
        element.parentElement.remove();

        // If this is an existing image, you might want to send an AJAX request to remove it from the server
        if (imageName) {
            // Example AJAX call to remove the image from the server
            $.post('remove_image.php', { image: imageName }, function(response) {
                console.log(response);
            });
        }
    }
}

$(document).ready(function() {
    // Initialize Select2 for dropdowns
   
    // Handle form submission
    $(document).on('submit', '#supplierlin', function(e) {
        e.preventDefault();
       // alert(($(this).serialize())); // Log form data to the console
        start_load(); // Show loading indicator

        // Clear previous messages
        $('#msg').html('');

        // Create a FormData object to send form data
        var formData = new FormData(this);

        // Append existing images to FormData
        $('input[name="existing_images[]"]').each(function() {
            formData.append('existing_images[]', $(this).val());
            alert(formData);
        });

        // AJAX request to save data
        $.ajax({
            url: 'easoftfun.php?action=save_supplierdeliverin',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            success: function(resp) {
                if(resp == 1) {
                    alert_toast("Data successfully saved.", 'success');
                    setTimeout(function() {
                        location.reload(); // Reload the page after saving
                    }, 1000);
                } else if(resp == 2) {
                    $('#msg').html('<div class="alert alert-danger mx-2">Error: Data already exists.</div>');
                } else {
                    $('#msg').html('<div class="alert alert-danger mx-2">Error: ' + resp + '</div>');
                }
                end_load(); // Hide loading indicator
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert_toast("An error occurred while saving data.", 'danger');
                end_load(); // Hide loading indicator
            }
        });
    });

   
});



</script>
