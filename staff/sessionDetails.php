<?php include '../config/config.php'; ?>
<?php include 'common/header.php';?>

<?php
if(!isset($_SESSION['Staff'])){
    header('Location:../index.php');
}
$select_logged_in_user = $connection->prepare("SELECT * FROM `staff_admin` WHERE unique_id = ?");
$select_logged_in_user->execute([$_SESSION['Staff']]);
$logged_in_data = $select_logged_in_user->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['addSub'])){
    $semester = $_POST['semester'];
    $subject = $_POST['subject_name'];
    
    $insert_subject = $connection->prepare("INSERT INTO `subjects` (subject_name, semester, added_by) VALUES (?, ?, ?)");
    if($insert_subject->execute([$subject, $semester, $logged_in_data['staff_name']])){
        $message = $subject.' '. 'Subject Added Successfully for Semester'.' '. $semester;
    }
}
?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Message from Smart-Attendance</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?= $message; ?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn m-0 btn-secondary" data-bs-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<?php
?>
        <?php
        if(isset($message)){
            ?>
            <script>
            var myModal = new bootstrap.Modal(document.getElementById("exampleModal"));
            myModal.show();
            </script>
            <?php
            }
        
        ?>
<div class="container text-center mt-3 justify-content-center">
    <div class="mx-auto col-sm-3">
        
        <h3 class="text-center">Add new</h3>
        <form method="post" id="addSub" style="display:none;">


            <div class="row">
                <div class="col-md mb-3">
                    <label>Semester</label>
                    <select name="semester" class="form-select form-select-sm p-1 shadow-sm bg-white rounded" required>
                        <option value="0">Select Semester</option>
                        <option value="1">I</option>
                        <option value="2">II</option>
                        <option value="3">III</option>
                        <option value="4">IV</option>
                        <option value="5">V</option>
                        <option value="6">VI</option>
                    </select>
                </div>
                <div class="col-md mb-3">
                    <label>Subject Name</label>
                    <input  id="subjectadd" type="text" placeholder="Subject Name" name="subject_name" class="form-control mb-2 form-control-sm" required>
                    </select>
                </div>
            </div>
            <input  id="addBtn" type="submit" name="addSub" class="btn mb-2 btn-sm btn-success">
        </form>
        <button  onclick="showAddSubject()" type="submit" id="changeBtn" class="btn mb-2 btn-sm btn-primary">Add Subject</button> 
    </div>
</div>

<div class="container text-center mt-3 justify-content-center">
    <div class="mx-auto col-sm-3">
        
        <h3 class="text-center">Enter Session Details</h3>

        <div class="row">
            <form method="post" onclick="this.form.submit()">
                    <div class="col-md mb-3">
                        <label>Semester</label>
                        <select name="session_semester" onchange='this.form.submit()' class="form-select form-select-sm p-1 shadow-sm bg-white rounded" required>
                            <option value="0">Select Semester</option>
                            <option value="1">I</option>
                            <option value="2">II</option>
                            <option value="3">III</option>
                            <option value="4">IV</option>
                            <option value="5">V</option>
                            <option value="6">VI</option>
                        </select>
                    </div>
                </form>
                <form method="post" action="captureAttendance.php">
                    <div class="col-md mb-3">
                        <label>Select Subject</label>
                        <select name="session_subject"class="form-select form-select-sm p-1 shadow-sm bg-white rounded" required>
                            <option value="0">Select Subject</option>
                            <?php
                            $select_subject = $connection->prepare("SELECT * FROM `subjects` WHERE semester = ?");
                            $select_subject->execute([$_POST['session_semester']]);
                            while($select_sub = $select_subject->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?= $select_sub['subject_name'];?>"><?= $select_sub['subject_name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="logged_user" value="<?= $logged_in_data['staff_name']; ?>">
                    <input  id="addBtn" type="submit" name="start_session" class="btn mb-2 btn-sm btn-warning" value="Start Session">
                </form>

            </div>
        </div>
    </div>


<script>
    function showAddSubject(){
        var add_sub = document.getElementById("addSub");
        var changeBtn =document.getElementById('changeBtn');
        if(add_sub.style.display == 'block'){
            add_sub.style.display = 'none';
            changeBtn.setAttribute('class', 'btn mb-2 btn-sm btn-primary');
            changeBtn.textContent = 'Add Subject';
        }
        else{
            add_sub.style.display = 'block';
            changeBtn.setAttribute('class', 'btn mb-2 btn-sm btn-danger');
            changeBtn.textContent = 'Cancel';
        }
}
</script>
<?php include 'common/footer.php';?>