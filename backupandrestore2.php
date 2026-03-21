<?php
include 'headem.php';
include('insert_sales.php');
   
?>

    <!-- Main Content -->
     <div class="main-content" id="mainContent">

     <div class="card shadow-sm">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fas fa-database"></i> Database Management</h5>
    </div>
    <div class="card-body">
        <div class="mb-4">
            <label class="form-label fw-bold">System Backup</label><br>
            <button id="btn-backup" class="btn btn-success">
                <i class="fas fa-cloud-download-alt"></i> Download Backup
            </button>
        </div>

        <hr>

        <!-- <div class="mb-3">
            <label class="form-label fw-bold">Restore System Data</label>
            <div class="input-group">
                <input type="file" class="form-control" id="restoreFile" accept=".db">
                <button id="btn-restore" class="btn btn-danger">
                    <i class="fas fa-undo"></i> Restore
                </button>
            </div>
        </div> -->

        <div class="progress mb-3" style="display:none; height: 25px;">
            <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated bg-info" 
                 role="progressbar" style="width: 0%;">0%</div>
        </div>

        <div id="status" class="small fw-bold"></div>
    </div>
</div>



      
     </div>


<script>
   $(document).ready(function() {
    
    // --- BACKUP LOGIC ---
    $('#btn-backup').click(function() {
        if(swal("Do you want to download a copy of the current database?")) {
            $('#status').text('Preparing download...').css('color', 'green');
            window.location.href = 'backupage.php?action=backup';
            
            // Reset status after a few seconds
            setTimeout(() => { $('#status').text('Backup initiated.'); }, 3000);
        }
    });

    // --- RESTORE LOGIC ---
    $('#btn-restore').click(function() {
        const fileInput = $('#restoreFile')[0];
        
        if (fileInput.files.length === 0) {
            swal("Please select a .db file first!");
            return;
        }

        // DOUBLE CONFIRMATION
        const confirm1 = confirm("WARNING: This will delete ALL current sales and data. Are you absolutely sure?");
        if (!confirm1) return;
        
        const confirm2 = confirm("FINAL CHECK: Have you made a backup of your current data before doing this?");
        if (!confirm2) return;

        const formData = new FormData();
        formData.append('action', 'restore');
        formData.append('backup_file', fileInput.files[0]);

        // Show Progress Bar
        $('.progress').show();
        $('#progressBar').css('width', '0%').text('0%');
        $('#status').text('Uploading and restoring...').css('color', 'blue');

        $.ajax({
            url: 'backupage.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            // TRACK PROGRESS
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                        $('#progressBar').css('width', percentComplete + '%').text(percentComplete + '%');
                    }
                }, false);
                return xhr;
            },
            success: function(response) {
                try {
                    const res = JSON.parse(response);
                    if (res.status === 'success') {
                        $('#progressBar').addClass('bg-success').removeClass('bg-info');
                        $('#status').text(res.message).css('color', 'green');
                        swal("Success: System data has been replaced.");
                        location.reload(); 
                    } else {
                        $('#status').text(res.message).css('color', 'red');
                        $('.progress').hide();
                    }
                } catch (e) {
                    $('#status').text("Server error. Check PHP logs.").css('color', 'red');
                }
            },
            error: function() {
                swal("Error: Restore failed. Connection error.");
                $('.progress').hide();
            }
        });
    });
});






/*
$('#end_date').change(function(){

   location.replace('saleusermonth.php?page=payments_report&start_date = '+$(this).val())
})
$('#print').click(function(){
		var _c = $('#report-list').clone();
		var ns = $('noscript').clone();
            ns.append(_c)
		var nw = window.open('','_blank','width=900,height=600')
		nw.document.write('<p class="text-center"><b>Total Sale as at <?php echo date("F, Y",strtotime($month)) ?></b></p>')
		nw.document.write(ns.html())
		nw.document.close()
		nw.print()
		setTimeout(() => {
			nw.close()
		}, 500);
	})*/
</script>