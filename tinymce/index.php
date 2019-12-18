<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hello, world!</title>
    <script src="https://cdn.tiny.cloud/1/025xofj46i1b9zewxh4sch9vk9advj0rsqyexmicbvba3r19/tinymce/5/tinymce.min.js"></script>
    <script>
      tinymce.init({
        selector: '#mytextarea',
        height: 400,
        menubar: "format",
        branding: false,
        plugins: "image code media imagetools",
        toolbar: 'undo redo | image media | styleselect | bold italic | alignleft alignright alignjustify| outdent indent | code',
        media_live_embeds: true,
        images_upload_url: 'postAcceptor.php',
      });
    </script>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col-sm-12"> 
          <h1>Test Test</h1>
        <form method="post">
            <textarea id="mytextarea">Hello, World!</textarea>
          </form>
      </div>
    </div>
  </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>