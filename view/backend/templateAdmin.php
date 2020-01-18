<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
		<link href="public/css/awesome/all.css" rel="stylesheet" /> <!--load all styles fontawesome.com -->
        <link href="public/css/style.css" rel="stylesheet" /> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://cdn.tiny.cloud/1/3ztlr4a9ila1dt21uqsn3rfezzi5k63pbjxhxqw4hw6qzj99/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
		<script>
			tinymce.init({
			  selector: '#redaction',
			  language:   "fr_FR",
			  language_url : '../../public/langs/fr_FR.js',  // site absolute URL
			  mobile: {
				menubar: true
			  },
			});
		</script>
    </head>
        
    <body>
        <?= $content ?>
    </body>
</html>