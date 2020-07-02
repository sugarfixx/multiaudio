    <form method="post" action="index.php">
        <div class="form-group">
            <label for="exampleFormControlSelect1">Profile</label>
            <select name="file" class="form-control" id="exampleFormControlSelect1">
                <?php
                $di = new RecursiveDirectoryIterator('data');
                foreach (new RecursiveIteratorIterator($di) as $filename => $file) {
                    if (strpos($filename, '/.') === false) {
                        echo '<option>' . $filename . '</option>';
                    }

                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect2">Template</label>
            <select name="template" class="form-control" id="exampleFormControlSelect2">
                <option>1234</option>
                <option>1235</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
