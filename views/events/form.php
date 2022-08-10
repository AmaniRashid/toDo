<?php  if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <?php foreach($errors as $error): ?>
            <div><?php echo $error ?></div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
<form method="POST" action="">
    <div class="form-group m-2">
        <label >Event Title</label>
        <input type="text" name="event" class="form-control" placeholder="" value="">
    </div>
    <div class="form-group m-2">
        <label >Description</label>
        <textarea  name="description" class="form-control" placeholder="" value=""> </textarea>
    </div>
    <div class="form-group m-2">
        <label >Deadline</label>
        <input type="datetime-local" name="deadline" class="form-control" placeholder="" value="">
    </div>
    <div class="form-group m-2">
        <label >completed</label>
        <div class="text-center inline-block">
            <span>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="completed" value="yes">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Yes
                    </label>
                 </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="completed" value="no" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        No
                    </label>
                </div>
            </span>


        </div>


    </div>

    <button type="submit" class="btn btn-primary">submit</button>
</form>
