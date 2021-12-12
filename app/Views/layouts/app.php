<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Blog Post</title>
</head>

<body>
    <?= $this->include('components/navigation'); ?>

    <div class="my-5">
        <?= $this->renderSection('content'); ?>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        function imgPreview() {
            const imagePreview = document.querySelector('.image-preview');
            const img = document.querySelector('#image');

            const imageFile = new FileReader();

            imageFile.readAsDataURL(img.files[0]);

            imageFile.onload = function(e) {
                imagePreview.src = e.target.result;
            }
        }
    </script>
</body>

</html>