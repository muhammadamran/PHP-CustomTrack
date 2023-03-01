<?php
// RECEIVE UPLOADS:
if (isset($_POST['submit'])) {
    $filePondArray = $_POST['filepond'];

    // $baseFileLocation = '/your/server/image/filepath/';
    $baseFileLocation = 'file/BUPBUE/';
    $numFilePondObjects = sizeof($filePondArray);
    if (!$numFilePondObjects) {
        die('No photos sent!');
    }

    echo '<b>You sent ' . $numFilePondObjects . ' pics. Each pic has 3 versions.</b><br>';

    // iterate through the objects...
    for ($xx = 0; $xx < $numFilePondObjects; $xx++) {

        $thisFilePondJSON_object = $filePondArray[$xx];

        $thisFilePondArray = json_decode($thisFilePondJSON_object, true);

        // isolate the encoded pics...
        $thisFilePondArray_picData = $thisFilePondArray['data'];
        $thisFilePondArray_numPics = sizeof($thisFilePondArray_picData);

        // iterate through pics in this object...
        for ($yy = 0; $yy < $thisFilePondArray_numPics; $yy++) {

            $thisPic_PhotoNumber = $xx + 1;

            $thisPic_version = $thisFilePondArray_picData[$yy]['name'];
            if (!$thisPic_version) {
                $thisPic_version = 'v1_50px';
            }
            $thisPic_name_temp = 'photo_' . $thisPic_PhotoNumber . '_' . $thisPic_version . '.jpg';

            $thisPic_encodedData = $thisFilePondArray_picData[$yy]['data'];
            $thisPic_decodedData = base64_decode($thisPic_encodedData);

            $thisPic_fullPathAndName = $baseFileLocation . $thisPic_name_temp;
            echo '<br>Photo will save as: <b>' . $thisPic_fullPathAndName . '</b>';
            //write the pic here
            //file_put_contents($thisPic_fullPathAndName, $thisPic_decodedData);

        }

        echo '<br>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>FilePond Test</title>
    <link rel='stylesheet' href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css' />
    <link rel='stylesheet' href='https://unpkg.com/filepond/dist/filepond.min.css' />
    <style>
        .fileBox {
            width: 80%;
            margin-left: auto;
            margin-right: auto;
            margin-top: 40px;
            background: #fbfbb8;
            padding: 20px;
            border: 3px solid black;
        }
    </style>
</head>

<body>
    <div class="fileBox">

        <form method="POST" action="sample.php" enctype="multipart/form-data">

            <input type="file" class="filepond" name="filepond[]" multiple data-max-file-size="6MB" data-max-files="5" />
            <!-- <input type="submit" value="Upload Photo(s)" name="B1" class="btn btn-info" /> -->
            <br>
            <!-- <input type="hidden" name="sentPhotos" value="1" /> -->
            <button type="submit" name="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                <i class="bx bx-check d-block d-sm-none"></i>
                <span class="d-none d-sm-block"><i class="iconly-boldUpload"></i> Upload</span>
            </button>

        </form>
    </div>
    <script src='https://unpkg.com/filepond-plugin-file-encode/dist/filepond-plugin-file-encode.min.js'></script>
    <script src='https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js'></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src='https://unpkg.com/filepond-plugin-image-exif-orientation/dist/filepond-plugin-image-exif-orientation.min.js'></script>
    <script src="https://unpkg.com/filepond-plugin-image-crop/dist/filepond-plugin-image-crop.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-resize/dist/filepond-plugin-image-resize.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-transform/dist/filepond-plugin-image-transform.js"></script>
    <script src='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js'></script>
    <script src='https://unpkg.com/filepond/dist/filepond.min.js'></script>
    <script>
        // register desired plugins...
        FilePond.registerPlugin(
            // encodes the file as base64 data...
            FilePondPluginFileEncode,
            // validates the size of the file...
            FilePondPluginFileValidateSize,

            // validates the file type...
            FilePondPluginFileValidateType,
            // corrects mobile image orientation...
            FilePondPluginImageExifOrientation,

            // calculates & dds cropping info based on the input image dimensions and the set crop ratio
            FilePondPluginImageCrop,

            //  calculates & adds resize information
            FilePondPluginImageResize,

            // applies the image modifications supplied by the Image crop and Image resize plugins before the image is uploaded
            FilePondPluginImageTransform,
            // previews dropped images...
            FilePondPluginImagePreview
        );
        // Select the file input and use create() to turn it into a pond
        FilePond.create(document.querySelector('.filepond'), {

            allowMultiple: true,
            allowFileEncode: true,
            maxFiles: 5,
            required: true,
            maxParallelUploads: 5,
            instantUpload: false,
            acceptedFileTypes: ['image/*'],
            imageResizeTargetWidth: 50,
            //imageResizeMode: 'contain',
            imageCropAspectRatio: '1:1',
            imageTransformVariants: {
                'v2_100px': transforms => {
                    transforms.resize.size.width = 100;
                    return transforms;
                },
                'v3_200px': transforms => {
                    transforms.resize.size.width = 200;
                    return transforms;
                }
            },
            imageTransformOutputQuality: 50,
            imageTransformOutputMimeType: 'image/jpeg',

            onaddfile: (err, fileItem) => {
                console.log(err, fileItem.getMetadata('resize'));
            },

            // alter the output property
            onpreparefile: (fileItem, outputFiles) => {
                // loop over the outputFiles array
                outputFiles.forEach(output => {
                    const img = new Image();
                    // output now is an object containing a `name` and a `file` property, we only need the `file`
                    img.src = URL.createObjectURL(output.file);
                    document.body.appendChild(img);
                })
            }

        });
    </script>
</body>

</html>