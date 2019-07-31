
<?php echo "upload page";?>

<div class="container">

    <h1 class="jumbotron">Upload your work</h1>

    <form action="\uploadProductPost" method="POST" enctype="multipart/form-data">


        <div class="form-group">
            <label for="imageTitle" class="well well-sm">Image title</label>
            <input type="text" name="imageTitle" id="imageTitle" class="form-control" value="a">
        </div>

        <div class="form-group">
            <label for="imageDescription" class="well well-sm">Image description</label>
            <textarea name="imageDescription" id="imageDescription" rows="3" cols="20" class="form-control" value="a"></textarea>
        </div>

        <div class="form-group">
            <label for="artistEmail" class="well well-sm">Artist email</label>
            <input type="email" name="artistEmail" id="artistEmail" class="form-control" value="d@yahhoo.com">
        </div>

        <div class="form-group">
            <label for="artistName" class="well well-sm">Artist name</label>
            <input type="text" name="artistName" id="artistName" class="form-control" value="a">
        </div>

        <div class="form-group">
            <label for="cameraSpecs" class="well well-sm">Camera specifications</label>
            <input type="text" name="cameraSpecs" id="cameraSpecs" class="form-control" value="a">
        </div>

        <div class="form-group">
            <label for="price" class="well well-sm">Price</label>
            <input type="number" name="price" id="price" step="0.01" min="0" class="form-control" value="5">
        </div>

        <div class="form-group">
            <label for="captureDate" class="well well-sm">Capture date</label>
            <input type="date" name="captureDate" id="captureDate" class="form-control" value="2017-05-07">
        </div>

        <div class="form-group">
            <label for="tags" class="well well-sm">Tags</label>
            <select id="tags" name="tags[]" multiple="multiple" class="form-control">
                <option value="nature">Nature</option>
                <option value="animal">Animal</option>
                <option value="urban">Urban</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image" class="well well-sm">Select a file</label>
            <input type="file" name="image" id="image"class="">
        </div>

        <input type="submit" name="submit" value="Submit" class="btn btn-default">
        <input type="reset" value="Reset" class="btn btn-default">

    </form>

</div></br>

