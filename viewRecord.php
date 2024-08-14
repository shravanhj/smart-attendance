<?php include 'common/header.php';?>
<?php include 'config/config.php';?>

<?php
if(isset($_SESSION['Staff']) || isset($_SESSION['Admin'])){
    header('Location:staff/attendanceRecords.php');
}
elseif(isset($_SESSION['Student'])){
    $logged_in_user = $_SESSION['Student'];
    $select_student = $connection->prepare("SELECT * FROM `students` WHERE reg_no = ?");
    $select_student->execute([$logged_in_user]);
    $student_data = $select_student->fetch(PDO::FETCH_ASSOC);
}
else{
    header('Location:login.php');
}
?>


    <div class="container text-center mt-3 justify-content-center">
        <div class="mx-auto col-sm-3">
            
            <h3 class="text-center">View Attendance Records</h3>

            <div class="row">
                <form method="post" action="">
                    <div class="col-md mb-3">
                        <label>Select Subject</label>
                        <select name="subject"class="form-select form-select-sm p-1 shadow-sm bg-white rounded" required>
                            <option value="0">Select Subject</option>
                            <?php
                            $select_subject = $connection->prepare("SELECT * FROM `subjects` WHERE semester = ?");
                            $select_subject->execute([$student_data['current_semester']]);
                            while($select_sub = $select_subject->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?= $select_sub['subject_name'];?>"><?= $select_sub['subject_name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md mb-3">
                        <label>Select Batch</label>
                        <select name="batch" class="form-select form-select-sm p-1 shadow-sm bg-white rounded" required>
                            <option value="0">Select Batch</option>
                            <option value="1">Batch 1(Day 1)</option>
                            <option value="2">Batch 2(Day 1)</option>
                            <option value="3">Batch 3(Day 2)</option>
                            <option value="4">Batch 4(Day 2)</option>
                            <option value="5">Batch 5(Day 3)</option>
                            <option value="6">Batch 6(Day 3)</option>
                        </select>
                    </div>
                    <input  id="addBtn" type="submit" name="view_records" class="btn mb-2 btn-sm btn-warning" value="View Records">
                </form>

            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['view_records'])){
        $subject = $_POST['subject'];
        $batch = $_POST['batch'];
        
        $select_record = $connection->prepare("SELECT * FROM `attendance_history` WHERE subject = ? AND batch = ? AND student_reg_no = ?");
        $select_record->execute([$subject, $batch, $logged_in_user]);
        ?>
        <div class="container mt-5">
            <h4>Attendance records for <?= $subject;?> : Batch <?= $batch;?></h4>
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Subject</th>
                <th scope="col">Semester</th>
                <th scope="col">Student Name</th>
                <th scope="col">Captured by</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
        <?php
        if($select_record->rowCount() > 0){
            while($record = $select_record->fetch(PDO::FETCH_ASSOC)){
                $select_student = $connection->prepare("SELECT * FROM `students` WHERE reg_no = ?");
                $select_student->execute([$record['student_reg_no']]);
                $student_data = $select_student->fetch(PDO::FETCH_ASSOC);
                ?>
                <td><?= $record['subject'];?></td>
                <td><?= $record['semester'];?></td>
                <td><?= $student_data['name'];?></td>
                <td><?= $record['captured_by'];?></td>
                <td><?= $record['date'];?></td>
                <td><?= $record['status'];?></td>
                <td><input type="submit" name="change" class="btn btn-primary" value="Change" disabled></td>
                <?php
            }
        }
        else{
            echo 'No Records Exists';
        }
        ?>
            </tbody>
        </table>
    </div>
        <?php
    }
    ?>

<?php include 'common/footer.php';?>